<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payments extends MX_Controller
{
    private $gatewayConfig = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('payments_mdl');
        $this->load->config('tripjyada_razorpay');
        $this->gatewayConfig = (array) $this->config->item('tripjyada_razorpay');
    }

    public function create_order()
    {
        $this->output->set_content_type('application/json');

        if (!$this->input->post()) {
            return $this->json_error('Invalid request method.', 405);
        }

        if (!$this->is_gateway_ready()) {
            return $this->json_error('Razorpay is not configured yet. Please add your API keys first.', 503);
        }

        $customerName  = $this->post_value('name');
        $customerEmail = $this->post_value('email');
        $customerPhone = $this->_normalise_phone($this->post_value('phone'));
        $packageId     = (int) $this->post_value('package_id', '0');
        $packageSlug   = $this->post_value('package_slug');
        $categorySlug  = $this->post_value('package_category_slug');

        $travelDate     = $this->post_value('travel_date');
        $numDays        = max(1, (int) $this->post_value('num_days', '1'));
        $numAdults      = max(1, (int) $this->post_value('num_adults', '1'));
        $numKids        = max(0, (int) $this->post_value('num_kids', '0'));
        $childAgesRaw   = $this->post_value('child_ages', '[]');
        $childAges      = json_decode($childAgesRaw, true);
        if (!is_array($childAges)) $childAges = array();
        $advancePercent = (int) $this->post_value('advance_percent', '10');

        if ($customerName === '') {
            return $this->json_error('Please enter your full name.', 422);
        }
        if (!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
            return $this->json_error('Please enter a valid email address.', 422);
        }
        if (strlen(preg_replace('/\D/', '', $customerPhone)) < 6) {
            return $this->json_error('Please enter a valid phone number.', 422);
        }
        if ($packageId <= 0 && $packageSlug === '') {
            return $this->json_error('Package information is missing. Please refresh and try again.', 422);
        }
        if (empty($travelDate) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $travelDate)) {
            return $this->json_error('Please select a valid travel date.', 422);
        }
        if ($numDays < 1) {
            return $this->json_error('Please enter a valid number of days.', 422);
        }
        if (!in_array($advancePercent, array(20, 30, 40, 100), true)) {
            return $this->json_error('Please select a valid advance payment option.', 422);
        }

        // Validate advance percent against travel date gap
        $travelDt = DateTime::createFromFormat('Y-m-d', $travelDate);
        $todayDt  = new DateTime('today');
        $gapDays  = ($travelDt && $travelDt >= $todayDt) ? (int) $todayDt->diff($travelDt)->days : -1;

        if ($gapDays < 0) {
            return $this->json_error('Travel date must be a future date.', 422);
        }

        if ($gapDays >= 90) {
            $gapAllowed = array(20, 30, 40, 100);
        } elseif ($gapDays >= 60) {
            $gapAllowed = array(30, 40, 100);
        } elseif ($gapDays >= 30) {
            $gapAllowed = array(40, 100);
        } else {
            $gapAllowed = array(100);
        }

        if (!in_array($advancePercent, $gapAllowed, true)) {
            $available = implode('%, ', $gapAllowed) . '%';
            return $this->json_error(
                'The selected advance option is not available for your travel date. Available options: ' . $available . '.',
                422
            );
        }

        $package = $this->payments_mdl->find_package($packageId, $packageSlug, $categorySlug);
        if (!$package) {
            return $this->json_error('This package could not be found for payment.', 404);
        }
        if (!$this->payments_mdl->is_payable_package($package)) {
            return $this->json_error('This package is currently available only on enquiry.', 422);
        }

        $ratePerPerson = $this->payments_mdl->normalize_price_to_rupees(isset($package['price']) ? $package['price'] : '');
        $totalPersons  = $numAdults + $numKids;
        $baseAmount    = $ratePerPerson * $totalPersons;

        // Bhutan SDF: detect from package text + itinerary
        $pkgText = strtolower(
            (isset($package['title'])       ? $package['title']       : '') . ' ' .
            (isset($package['description']) ? $package['description'] : '') . ' ' .
            (isset($package['details'])     ? $package['details']     : '') . ' ' .
            (isset($package['highlights'])  ? (is_array($package['highlights']) ? implode(' ', $package['highlights']) : (string) $package['highlights']) : '')
        );
        if (!empty($package['itinerary_json'])) {
            $itnData = json_decode($package['itinerary_json'], true);
            if (is_array($itnData)) {
                foreach ($itnData as $itnDay) {
                    $pkgText .= ' ' . strtolower(isset($itnDay['title']) ? $itnDay['title'] : '')
                              . ' ' . strtolower(isset($itnDay['desc'])  ? $itnDay['desc']  : '');
                }
            }
        }
        $isBhutan = strpos($pkgText, 'bhutan') !== false;

        // Count Phuentsholing nights from itinerary stay field — those specific nights are SDF-free
        $phuentsholingNights = 0;
        if (!empty($package['itinerary_json'])) {
            $itnFull = json_decode($package['itinerary_json'], true);
            if (is_array($itnFull)) {
                foreach ($itnFull as $day) {
                    $stay = strtolower(isset($day['stay']) ? $day['stay'] : '');
                    if (strpos($stay, 'phuentsholing') !== false || strpos($stay, 'phuntsholing') !== false) {
                        $phuentsholingNights++;
                    }
                }
            }
        }
        // Fallback: if itinerary has no stay data but text mentions Phuentsholing, assume 1 free night
        if ($phuentsholingNights === 0 && (strpos($pkgText, 'phuentsholing') !== false || strpos($pkgText, 'phuntsholing') !== false)) {
            $phuentsholingNights = 1;
        }

        // SDF: chargeable nights = total nights − Phuentsholing free nights
        $numNights        = max(0, $numDays - 1);
        $chargeableNights = max(0, $numNights - $phuentsholingNights);
        $adultSdf         = 1200 * $numAdults * $chargeableNights;
        $childSdf         = 0;
        foreach ($childAges as $cAge) {
            $cAge = (int) $cAge;
            if      ($cAge > 12) $childSdf += 1200 * $chargeableNights;
            elseif  ($cAge >= 6) $childSdf += 600  * $chargeableNights;
            // < 6 yrs: free
        }
        $sdfAmount = $isBhutan ? ($adultSdf + $childSdf) : 0;

        // Guide: ₹3,000 per day (flat per group)
        $guideAmount = 3000 * $numDays;

        $subTotal    = $baseAmount + $sdfAmount + $guideAmount;
        $gstAmount   = (int) ceil($subTotal * 0.05);
        $grossTotal  = $subTotal + $gstAmount;

        // Coupon discount (applied to gross total after GST)
        $couponCode     = strtoupper(trim($this->post_value('coupon_code')));
        $couponOfferId  = 0;
        $discountPct    = 0;
        $discountAmount = 0;

        if ($couponCode !== '') {
            $offer = $this->payments_mdl->find_valid_coupon($couponCode, $packageId);
            if ($offer) {
                $discountPct    = (int) $offer['discount_percent'];
                $couponOfferId  = (int) $offer['id'];
                $discountAmount = (int) floor($grossTotal * $discountPct / 100);
            }
        }

        $totalAmount   = $grossTotal - $discountAmount;
        $advanceAmount = (int) ceil($totalAmount * $advancePercent / 100);
        $balanceDue    = $totalAmount - $advanceAmount;

        $amountSubunits = $advanceAmount * 100;
        $receipt        = $this->payments_mdl->generate_receipt(!empty($package['p_id']) ? (int) $package['p_id'] : 0);
        $currency       = $this->gateway_setting('currency', 'INR');

        $payload = array(
            'amount'   => $amountSubunits,
            'currency' => $currency,
            'receipt'  => $receipt,
            'notes'    => array(
                'package_id'     => (string) (!empty($package['p_id']) ? $package['p_id'] : ''),
                'package_title'  => substr((string) $package['title'], 0, 255),
                'customer_name'  => substr($customerName, 0, 255),
                'customer_phone' => substr($customerPhone, 0, 255),
                'advance_pct'    => (string) $advancePercent . '%',
                'travel_date'    => $travelDate,
            ),
        );

        $orderResponse = $this->razorpay_request('POST', 'orders', $payload);
        if (!$orderResponse['ok']) {
            $errMsg = $orderResponse['message'];
            if (stripos($errMsg, 'amount') !== false && stripos($errMsg, 'exceed') !== false) {
                $errMsg = 'This amount exceeds the payment gateway limit of ₹5,00,000 per transaction. Please select a partial advance payment option (e.g. 20% advance) from the sidebar, or contact us directly to arrange this booking.';
            }
            return $this->json_error($errMsg, $orderResponse['status_code']);
        }

        $bookingData = array(
            'travel_date'     => $travelDate,
            'num_days'        => $numDays,
            'num_adults'      => $numAdults,
            'num_kids'        => $numKids,
            'advance_percent' => $advancePercent,
            'base_amount'     => $baseAmount,
            'sdf_amount'      => $sdfAmount,
            'guide_amount'     => $guideAmount,
            'gst_amount'       => $gstAmount,
            'total_amount'     => $totalAmount,
            'balance_due'      => $balanceDue,
            'coupon_code'      => $couponCode !== '' ? $couponCode : null,
            'offer_id'         => $couponOfferId > 0  ? $couponOfferId  : null,
            'discount_percent' => $discountPct,
            'discount_amount'  => $discountAmount,
        );

        $localPaymentId = $this->payments_mdl->create_payment_order(
            $package,
            array(
                'name'  => $customerName,
                'email' => $customerEmail,
                'phone' => $customerPhone,
            ),
            $orderResponse['data'],
            $currency,
            $bookingData
        );

        if ($localPaymentId < 1) {
            return $this->json_error('Could not save the local payment order. Please try again.', 500);
        }

        return $this->json_success(array(
            'message'         => 'Order created successfully.',
            'key'             => $this->gateway_setting('key_id'),
            'order_id'        => $orderResponse['data']['id'],
            'amount'          => $amountSubunits,
            'currency'        => $currency,
            'name'            => $this->gateway_setting('company_name', 'Tripjyada'),
            'description'     => $this->gateway_setting('description_prefix', 'Trip advance payment') . ' - ' . $package['title'],
            'image'           => base_url('assets/images/logo.png'),
            'theme_color'     => $this->gateway_setting('theme_color', '#f97316'),
            'package_title'   => $package['title'],
            'amount_display'  => 'Rs ' . number_format($advanceAmount),
            'balance_display' => 'Rs ' . number_format($balanceDue),
            'prefill'         => array(
                'name'    => $customerName,
                'email'   => $customerEmail,
                'contact' => $customerPhone,
            ),
        ));
    }

    public function apply_coupon()
    {
        $this->output->set_content_type('application/json');

        if (!$this->input->post()) {
            return $this->json_error('Invalid request method.', 405);
        }

        $code      = trim($this->input->post('coupon_code', true));
        $packageId = (int) $this->input->post('package_id', true);

        if ($code === '') {
            return $this->json_error('Please enter a coupon code.', 422);
        }

        $offer = $this->payments_mdl->find_valid_coupon($code, $packageId);
        if (!$offer) {
            return $this->json_error('Invalid or expired coupon code.', 422);
        }

        return $this->json_success(array(
            'message'          => 'Coupon applied! ' . $offer['discount_percent'] . '% discount.',
            'discount_percent' => (int) $offer['discount_percent'],
            'offer_id'         => (int) $offer['id'],
            'offer_title'      => $offer['title'],
        ));
    }

    public function webhook()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        $rawBody = file_get_contents('php://input');
        $webhookSecret = $this->gateway_setting('webhook_secret');

        if ($webhookSecret !== '') {
            $receivedSig = isset($_SERVER['HTTP_X_RAZORPAY_SIGNATURE'])
                ? $_SERVER['HTTP_X_RAZORPAY_SIGNATURE']
                : '';
            $expectedSig = hash_hmac('sha256', $rawBody, $webhookSecret);
            if (!hash_equals($expectedSig, $receivedSig)) {
                log_message('error', 'Razorpay webhook: invalid signature received');
                http_response_code(401);
                echo json_encode(array('ok' => false, 'message' => 'Invalid signature'));
                exit;
            }
        }

        $payload = json_decode($rawBody, true);
        if (!is_array($payload)) {
            http_response_code(400);
            exit;
        }

        $event = isset($payload['event']) ? $payload['event'] : '';
        switch ($event) {
            case 'payment.captured':
                $this->webhook_payment_captured($payload);
                break;
            case 'payment.failed':
                $this->webhook_payment_failed($payload);
                break;
            case 'order.paid':
                $this->webhook_order_paid($payload);
                break;
        }

        http_response_code(200);
        echo json_encode(array('ok' => true));
        exit;
    }

    private function webhook_payment_captured(array $payload)
    {
        $payment   = isset($payload['payload']['payment']['entity']) ? $payload['payload']['payment']['entity'] : array();
        $paymentId = isset($payment['id'])       ? $payment['id']       : '';
        $orderId   = isset($payment['order_id']) ? $payment['order_id'] : '';
        if (!$paymentId || !$orderId) return;

        $local = $this->payments_mdl->find_by_order_id($orderId);
        if (!$local) return;

        if (in_array($local['local_status'], array('paid', 'captured'), true)) return;

        $this->payments_mdl->update_payment($local['id'], array(
            'local_status'        => 'captured',
            'razorpay_payment_id' => $paymentId,
            'gateway_status'      => 'captured',
            'captured'            => 1,
            'payment_method'      => isset($payment['method']) ? $payment['method'] : null,
            'api_response'        => $this->encode_json($payment),
            'verified_at'         => date('Y-m-d H:i:s'),
        ));
        log_message('info', 'Webhook payment.captured: ' . $paymentId);
    }

    private function webhook_payment_failed(array $payload)
    {
        $payment   = isset($payload['payload']['payment']['entity']) ? $payload['payload']['payment']['entity'] : array();
        $paymentId = isset($payment['id'])       ? $payment['id']       : '';
        $orderId   = isset($payment['order_id']) ? $payment['order_id'] : '';
        if (!$orderId) return;

        $local = $this->payments_mdl->find_by_order_id($orderId);
        if (!$local) return;

        if (in_array($local['local_status'], array('paid', 'captured'), true)) return;

        $this->payments_mdl->update_payment($local['id'], array(
            'local_status'        => 'failed',
            'gateway_status'      => 'failed',
            'razorpay_payment_id' => $paymentId,
            'api_response'        => $this->encode_json($payment),
        ));
        log_message('info', 'Webhook payment.failed: order ' . $orderId);
    }

    private function webhook_order_paid(array $payload)
    {
        $order     = isset($payload['payload']['order']['entity'])   ? $payload['payload']['order']['entity']   : array();
        $payment   = isset($payload['payload']['payment']['entity']) ? $payload['payload']['payment']['entity'] : array();
        $orderId   = isset($order['id'])   ? $order['id']   : '';
        $paymentId = isset($payment['id']) ? $payment['id'] : '';
        if (!$orderId) return;

        $local = $this->payments_mdl->find_by_order_id($orderId);
        if (!$local) return;

        if (in_array($local['local_status'], array('paid', 'captured'), true)) return;

        // Server-side amount validation
        if (!empty($order['amount_paid']) && (int)$order['amount_paid'] !== (int)$local['amount_subunits']) {
            log_message('error', 'Webhook order.paid amount mismatch for order ' . $orderId);
            return;
        }

        $this->payments_mdl->update_payment($local['id'], array(
            'local_status'        => 'paid',
            'gateway_status'      => 'captured',
            'razorpay_payment_id' => $paymentId,
            'captured'            => 1,
            'payment_method'      => isset($payment['method']) ? $payment['method'] : null,
            'api_response'        => $this->encode_json($payment),
            'verified_at'         => date('Y-m-d H:i:s'),
        ));
        log_message('info', 'Webhook order.paid: ' . $orderId . ' / ' . $paymentId);
    }

    public function verify()
    {
        $this->output->set_content_type('application/json');

        if (!$this->input->post()) {
            return $this->json_error('Invalid request method.', 405);
        }

        if (!$this->is_gateway_ready()) {
            return $this->json_error('Razorpay is not configured yet. Please add your API keys first.', 503);
        }

        $paymentId = $this->post_value('razorpay_payment_id');
        $orderId = $this->post_value('razorpay_order_id');
        $signature = $this->post_value('razorpay_signature');

        if ($paymentId === '' || $orderId === '' || $signature === '') {
            return $this->json_error('Payment verification details are incomplete.', 422);
        }

        $localOrder = $this->payments_mdl->find_by_order_id($orderId);
        if (!$localOrder) {
            return $this->json_error('No matching local payment order was found.', 404);
        }

        $generatedSignature = hash_hmac('sha256', $localOrder['razorpay_order_id'] . '|' . $paymentId, $this->gateway_setting('key_secret'));
        if (!hash_equals($generatedSignature, $signature)) {
            $this->payments_mdl->update_payment($localOrder['id'], array(
                'local_status' => 'signature_failed',
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature,
                'gateway_status' => 'signature_failed',
            ));

            return $this->json_error('Payment signature verification failed.', 422);
        }

        $paymentResponse = $this->razorpay_request('GET', 'payments/' . rawurlencode($paymentId));
        if (!$paymentResponse['ok']) {
            $this->payments_mdl->update_payment($localOrder['id'], array(
                'local_status' => 'verified',
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature,
                'gateway_status' => 'verification_pending',
                'verified_at' => date('Y-m-d H:i:s'),
            ));

            return $this->json_success(array(
                'message' => 'Payment signature verified. Final gateway confirmation could not be fetched right now.',
                'status' => 'verified',
                'captured' => false,
                'payment_id' => $paymentId,
                'package_title' => $localOrder['package_title'],
            ));
        }

        $payment = $paymentResponse['data'];
        if ((isset($payment['order_id']) ? $payment['order_id'] : '') !== $localOrder['razorpay_order_id']) {
            return $this->json_error('The payment does not belong to this order.', 422);
        }
        if (!empty($payment['amount']) && (int) $payment['amount'] !== (int) $localOrder['amount_subunits']) {
            return $this->json_error('The paid amount does not match the package price.', 422);
        }
        if (!empty($payment['currency']) && strtoupper($payment['currency']) !== strtoupper($localOrder['currency'])) {
            return $this->json_error('The payment currency does not match this order.', 422);
        }

        $gatewayStatus = isset($payment['status']) ? strtolower((string) $payment['status']) : 'verified';
        $captured = !empty($payment['captured']) || $gatewayStatus === 'captured';
        $localStatus = $captured ? 'paid' : $gatewayStatus;
        $verifiedAt = date('Y-m-d H:i:s');

        $this->payments_mdl->update_payment($localOrder['id'], array(
            'local_status' => $localStatus,
            'razorpay_payment_id' => $paymentId,
            'razorpay_signature' => $signature,
            'gateway_status' => $gatewayStatus,
            'payment_method' => !empty($payment['method']) ? $payment['method'] : null,
            'captured' => $captured ? 1 : 0,
            'api_response' => $this->encode_json($payment),
            'verified_at' => $verifiedAt,
        ));

        $message = $captured
            ? 'Payment completed successfully.'
            : 'Payment was received successfully. Final capture is pending on Razorpay.';

        $balanceDue = isset($localOrder['balance_due']) ? (int) $localOrder['balance_due'] : 0;

        return $this->json_success(array(
            'message'         => $message,
            'status'          => $localStatus,
            'captured'        => $captured,
            'payment_id'      => $paymentId,
            'local_id'        => (int) $localOrder['id'],
            'package_title'   => $localOrder['package_title'],
            'amount_display'  => 'Rs ' . number_format((int) $localOrder['amount_rupees']),
            'balance_display' => $balanceDue > 0 ? 'Rs ' . number_format($balanceDue) : '',
        ));
    }

    private function razorpay_request($method, $resource, array $payload = array())
    {
        if (!function_exists('curl_init')) {
            return array(
                'ok' => false,
                'status_code' => 500,
                'message' => 'cURL is not enabled on this server.',
            );
        }

        $url = 'https://api.razorpay.com/v1/' . ltrim($resource, '/');
        $ch = curl_init($url);
        $headers = array('Accept: application/json');
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERPWD => $this->gateway_setting('key_id') . ':' . $this->gateway_setting('key_secret'),
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_HTTPHEADER => $headers,
        );

        if (strtoupper($method) !== 'GET') {
            $headers[] = 'Content-Type: application/json';
            $options[CURLOPT_HTTPHEADER] = $headers;
            $options[CURLOPT_POSTFIELDS] = json_encode($payload);
        }

        curl_setopt_array($ch, $options);
        $body = curl_exec($ch);

        if ($body === false) {
            $error = curl_error($ch);
            curl_close($ch);
            log_message('error', 'Razorpay cURL request failed: ' . $error);

            return array(
                'ok' => false,
                'status_code' => 502,
                'message' => 'Could not connect to Razorpay. Please try again.',
            );
        }

        $statusCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $decoded = json_decode($body, true);
        if ($statusCode >= 400) {
            $message = !empty($decoded['error']['description'])
                ? $decoded['error']['description']
                : 'Razorpay request failed.';

            log_message('error', 'Razorpay API error (' . $statusCode . '): ' . $body);

            return array(
                'ok' => false,
                'status_code' => $statusCode,
                'message' => $message,
                'data' => is_array($decoded) ? $decoded : array(),
            );
        }

        if (!is_array($decoded)) {
            return array(
                'ok' => false,
                'status_code' => 502,
                'message' => 'Unexpected response received from Razorpay.',
            );
        }

        return array(
            'ok' => true,
            'status_code' => $statusCode,
            'message' => 'ok',
            'data' => $decoded,
        );
    }

    private function gateway_setting($key, $default = '')
    {
        return isset($this->gatewayConfig[$key]) && $this->gatewayConfig[$key] !== ''
            ? $this->gatewayConfig[$key]
            : $default;
    }

    private function is_gateway_ready()
    {
        return $this->gateway_setting('key_id') !== '' && $this->gateway_setting('key_secret') !== '';
    }

    private function post_value($key, $default = '')
    {
        $value = $this->input->post($key, true);
        if ($value === null) {
            return $default;
        }

        $value = trim((string) $value);
        return $value === '' ? $default : $value;
    }

    private function _normalise_phone($phone)
    {
        $digits = preg_replace('/\D/', '', (string) $phone);
        return strlen($digits) > 10 ? substr($digits, -10) : $digits;
    }

    private function json_error($message, $statusCode = 400)
    {
        return $this->output
            ->set_status_header($statusCode)
            ->set_output(json_encode(array(
                'ok' => false,
                'message' => $message,
            )));
    }

    private function json_success(array $payload)
    {
        $payload['ok'] = true;
        return $this->output->set_output(json_encode($payload));
    }

    private function encode_json($value)
    {
        $json = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return $json !== false ? $json : null;
    }
}
