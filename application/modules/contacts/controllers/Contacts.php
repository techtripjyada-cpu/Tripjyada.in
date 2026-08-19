<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Contacts extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function index()
    {
        $data['title'] = "Contact Us | TripJyada – Book Your Tour Today";
        $data['description'] = "Contact TripJyada to book your dream tour. Call, WhatsApp or fill our enquiry form for Bhutan & international travel packages at best prices.";
        $data['keywords'] = "contact TripJyada, book tour, travel enquiry, Bhutan tour booking, holiday booking";
        $data['module'] = "contacts";
        $data['view_file'] = "contacts";
        echo Modules::run('template/layout2', $data);
    }

    /**
     * Render the standalone Bhutan campaign page.
     *
     * The view intentionally contains all of its own HTML, CSS and JavaScript.
     */
    public function landing_page()
    {
        $this->output->set_content_type('text/html', 'UTF-8');
        $this->load->view('landing-page.html');
    }

    /**
     * Render the standalone Sikkim & Darjeeling campaign page.
     */
    public function sdt_landing_page()
    {
        $this->output->set_content_type('text/html', 'UTF-8');
        $this->load->view('sdt-landing-page.html');
    }

    /**
     * The Sikkim & Darjeeling page previously lived at sdt-landing-page and a
     * mistyped "sikkiim" (double-i) variant was briefly tested; send both to
     * the current URL with a permanent redirect instead of 404ing.
     */
    public function sdt_landing_page_moved()
    {
        redirect(site_url('sikkim-darjeeling-tour-package'), 'location', 301);
    }

    /**
     * Receive landing-page leads, save them for the admin panel and trigger mail.
     */
    public function landing_submit()
    {
        return $this->handle_landing_submission(
            $this->landing_package_prices(),
            array('Deluxe' => 0, 'Super Deluxe' => 8500, 'Premium' => 17500),
            'Bhutan',
            'Please select a valid Bhutan package.',
            'bhutan'
        );
    }

    /**
     * Receive Sikkim & Darjeeling landing-page leads, save them for the admin panel and trigger mail.
     */
    public function sdt_landing_submit()
    {
        return $this->handle_landing_submission(
            $this->sdt_landing_package_prices(),
            array('Deluxe' => 0, 'Super Deluxe' => 3500, 'Premium' => 7000),
            'Sikkim & Darjeeling',
            'Please select a valid Sikkim & Darjeeling package.',
            'std'
        );
    }

    private function handle_landing_submission(array $packagePrices, array $tierAdditions, $campaignLabel, $invalidPackageMessage, $crmSlug)
    {
        if ($this->input->method(true) !== 'POST') {
            return $this->landing_json(array(
                'ok' => false,
                'message' => 'Only form submissions are accepted.',
            ), 405);
        }

        if (! $this->is_landing_ajax_request() || ! $this->is_same_origin_request()) {
            return $this->landing_json(array(
                'ok' => false,
                'message' => 'This form submission could not be verified.',
            ), 403);
        }

        // Bots commonly populate this field; return a neutral response so they
        // cannot use the endpoint response to tune their submissions.
        if ($this->landing_post_value('website') !== '') {
            return $this->landing_json(array(
                'ok' => true,
                'message' => 'Thank you. Your enquiry has been received.',
                'confirmation_email_sent' => false,
            ), 200);
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|trim|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|max_length[190]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim|max_length[24]');
        $this->form_validation->set_rules('city', 'City', 'trim|max_length[80]');
        $this->form_validation->set_rules('travel_month', 'Travel month', 'trim|max_length[40]');
        $this->form_validation->set_rules('travel_date', 'Travel date', 'trim|max_length[10]');
        $this->form_validation->set_rules('travellers', 'Traveller count', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('hotel_category', 'Hotel category', 'required|trim|max_length[40]');
        $this->form_validation->set_rules('package_name', 'Package', 'required|trim|max_length[150]');
        $this->form_validation->set_rules('message', 'Message', 'trim|max_length[1000]');
        $this->form_validation->set_rules('source', 'Source', 'trim|max_length[20]');
        $this->form_validation->set_rules('privacy_consent', 'Contact consent', 'required');

        if (! $this->form_validation->run()) {
            $message = trim(strip_tags(validation_errors(' ', ' ')));
            return $this->landing_json(array(
                'ok' => false,
                'message' => $message !== '' ? $message : 'Please check the highlighted form fields.',
            ), 422);
        }

        if ($this->landing_post_value('privacy_consent') !== '1') {
            return $this->landing_json(array(
                'ok' => false,
                'message' => 'Please confirm that we may contact you about this enquiry.',
            ), 422);
        }

        $phone = $this->normalise_indian_mobile($this->landing_post_value('phone'));
        if ($phone === '') {
            return $this->landing_json(array(
                'ok' => false,
                'message' => 'Please enter a valid 10-digit Indian mobile number.',
            ), 422);
        }

        $travelMonth = $this->landing_post_value('travel_month');
        $allowedMonths = array('August 2026', 'September 2026', 'October 2026');
        if ($travelMonth !== '' && ! in_array($travelMonth, $allowedMonths, true)) {
            return $this->landing_json(array('ok' => false, 'message' => 'Please select a valid travel month.'), 422);
        }

        $travelDate = $this->landing_post_value('travel_date');
        if ($travelDate !== '' && ! $this->is_valid_landing_date($travelDate)) {
            return $this->landing_json(array('ok' => false, 'message' => 'Please select a valid travel date.'), 422);
        }

        $travellers = $this->landing_post_value('travellers');
        $allowedTravellers = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10+');
        if (! in_array($travellers, $allowedTravellers, true)) {
            return $this->landing_json(array('ok' => false, 'message' => 'Please select a valid traveller count.'), 422);
        }

        $hotelCategory = $this->landing_post_value('hotel_category');
        $allowedHotelCategories = array('Deluxe', 'Super Deluxe', 'Premium');
        if (! in_array($hotelCategory, $allowedHotelCategories, true)) {
            return $this->landing_json(array('ok' => false, 'message' => 'Please select a valid hotel category.'), 422);
        }

        $packageName = $this->landing_post_value('package_name');
        if (! array_key_exists($packageName, $packagePrices)) {
            return $this->landing_json(array('ok' => false, 'message' => $invalidPackageMessage), 422);
        }

        $source = $this->landing_post_value('source', 'landing-page');
        if (! in_array($source, array('hero', 'modal', 'landing-page'), true)) {
            $source = 'landing-page';
        }

        $this->load->library('session');
        $lastSubmission = (int) $this->session->userdata('landing_page_last_submit');
        if ($lastSubmission > 0 && (time() - $lastSubmission) < 20) {
            return $this->landing_json(array(
                'ok' => false,
                'message' => 'Please wait a few seconds before sending another enquiry.',
            ), 429);
        }
        $this->session->set_userdata('landing_page_last_submit', time());

        $estimatedPrice = '';
        if ($packagePrices[$packageName] !== null) {
            $estimatedPrice = 'INR ' . number_format($packagePrices[$packageName] + $tierAdditions[$hotelCategory]) . ' per person';
        }

        $lead = array(
            'name' => $this->landing_post_value('name'),
            'email' => strtolower($this->landing_post_value('email')),
            'phone' => $phone,
            'city' => $this->landing_post_value('city'),
            'travel_month' => $travelMonth,
            'travel_date' => $travelDate,
            'travellers' => $travellers,
            'hotel_category' => $hotelCategory,
            'package_name' => $packageName,
            'estimated_price' => $estimatedPrice,
            'message' => $this->landing_post_value('message'),
            'source' => $source,
        );

        $this->load->model('contacts_mdl');
        $result = $this->contacts_mdl->landing_booking($lead, $campaignLabel, $crmSlug);

        if (empty($result['stored'])) {
            return $this->landing_json(array(
                'ok' => false,
                'message' => 'We could not save your enquiry right now. Please call or WhatsApp us instead.',
            ), 500);
        }

        $confirmationSent = ! empty($result['user_email_sent']);
        return $this->landing_json(array(
            'ok' => true,
            'message' => $confirmationSent
                ? "Thank you! Your {$campaignLabel} enquiry is saved and a confirmation email is on its way."
                : "Thank you! Your {$campaignLabel} enquiry is saved. Our team will contact you shortly.",
            'confirmation_email_sent' => $confirmationSent,
        ), 201);
    }


    function booking()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('phone', 'Mobile', 'required|trim|min_length[4]|max_length[15]');
        $this->form_validation->set_rules('email', "Email", 'trim|valid_email');
        $this->form_validation->set_rules('message', 'Message', 'trim');
        if ($this->form_validation->run() == true) {
            $this->load->model('contacts_mdl');
            $check = $this->contacts_mdl->bookings();
            if ($check == true) {
                echo "1";
            }
        } else {
            echo "<div class='alert alert-danger'>" . validation_errors() . "</div>";
        }
    }
    function faq()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('phone', 'Mobile', 'required|trim|min_length[4]|max_length[15]');
        if ($this->form_validation->run() == true) {
            $this->load->model('contacts_mdl');
            $check = $this->contacts_mdl->faq();
            if ($check == true) {
                echo "1";
            }
        } else {
            echo "<div class='alert alert-danger'>" . validation_errors() . "</div>";
        }
    }
    function contact()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name',    'Name',    'required|trim');
        $this->form_validation->set_rules('phone',   'Mobile',  'required|trim|min_length[4]|max_length[15]');
        $this->form_validation->set_rules('email',   'Email',   'trim|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'trim');
        $this->form_validation->set_rules('message', 'Message', 'trim');

        if ($this->form_validation->run() == true) {
            $this->load->model('contacts_mdl');
            $check = $this->contacts_mdl->contact();
            if ($check == true) {
                echo "1";
            }
        } else {
            echo "<div class='alert alert-danger'>" . validation_errors() . "</div>";
        }
    }

    function slider_enquiry()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name',  'Name',  'required|trim');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim|numeric|exact_length[10]');
        $this->form_validation->set_rules('address',         'Address',         'trim');
        $this->form_validation->set_rules('destination',     'Destination',     'trim');
        $this->form_validation->set_rules('date_of_arrival', 'Date of Arrival', 'trim');

        if ($this->form_validation->run() == true) {
            $this->load->model('contacts_mdl');
            if ($this->contacts_mdl->slider_enquiry()) {
                echo "1";
            }
        } else {
            echo validation_errors();
        }
    }

    function newsletter()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run() == true) {
            $this->load->model('contacts_mdl');
            $check = $this->contacts_mdl->newsletter();
            if ($check == true) {
                echo "1";
            }
        } else {
            echo "<div style='background:red !important;'>" . validation_errors() . "</div>";
        }
    }

    function test_mail()
    {
        $this->output->set_content_type('application/json');
        $this->load->config('tripjyada_mail');
        $mailConfig = (array) $this->config->item('tripjyada_mail');

        $configuredToken = isset($mailConfig['mail_test_token']) ? (string) $mailConfig['mail_test_token'] : '';
        $providedToken = trim((string) $this->input->get_post('token', true));

        if (! $this->is_mail_test_allowed($configuredToken, $providedToken)) {
            return $this->output
                ->set_status_header(403)
                ->set_output(json_encode(array(
                    'ok' => false,
                    'message' => 'Mail test access denied.',
                )));
        }

        $to = trim((string) $this->input->get_post('to', true));
        if ($to === '') {
            $to = ! empty($mailConfig['mail_test_default_recipient'])
                ? $mailConfig['mail_test_default_recipient']
                : (! empty($mailConfig['support_email']) ? $mailConfig['support_email'] : '');
        }

        if (! filter_var($to, FILTER_VALIDATE_EMAIL)) {
            return $this->output
                ->set_status_header(422)
                ->set_output(json_encode(array(
                    'ok' => false,
                    'message' => 'A valid recipient email is required.',
                )));
        }

        $requestedBy = 'IP: ' . $this->input->ip_address();

        $this->load->model('contacts_mdl');
        $sent = $this->contacts_mdl->send_test_mail($to, $requestedBy);

        if (! $sent) {
            return $this->output
                ->set_status_header(500)
                ->set_output(json_encode(array(
                    'ok' => false,
                    'message' => 'SMTP test failed. Check your SMTP credentials and error logs.',
                )));
        }

        return $this->output->set_output(json_encode(array(
            'ok' => true,
            'message' => 'SMTP test email sent successfully.',
            'to' => $to,
        )));
    }

    private function is_mail_test_allowed($configuredToken, $providedToken)
    {
        if ($configuredToken !== '') {
            return $providedToken !== '' && hash_equals($configuredToken, $providedToken);
        }

        if (php_sapi_name() === 'cli') {
            return true;
        }

        return $this->is_local_request();
    }

    private function is_local_request()
    {
        $ip = $this->input->ip_address();
        return in_array($ip, array('127.0.0.1', '::1'), true);
    }

    private function landing_json(array $payload, $statusCode)
    {
        return $this->output
            ->set_content_type('application/json', 'UTF-8')
            ->set_status_header($statusCode)
            ->set_output(json_encode($payload));
    }

    private function is_landing_ajax_request()
    {
        return strtolower((string) $this->input->server('HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest';
    }

    private function is_same_origin_request()
    {
        $origin = trim((string) $this->input->server('HTTP_ORIGIN'));
        if ($origin === '') {
            // X-Requested-With causes a cross-origin preflight, so an absent
            // Origin is still safe for older same-origin browsers and proxies.
            return true;
        }

        $originHost = parse_url($origin, PHP_URL_HOST);
        $requestHost = preg_replace('/:\d+$/', '', (string) $this->input->server('HTTP_HOST'));
        if (! is_string($originHost) || $originHost === '' || $requestHost === '') {
            return false;
        }

        return hash_equals(strtolower($requestHost), strtolower($originHost));
    }

    private function normalise_indian_mobile($phone)
    {
        $digits = preg_replace('/\D+/', '', (string) $phone);
        if (strlen($digits) === 12 && substr($digits, 0, 2) === '91') {
            $digits = substr($digits, 2);
        } elseif (strlen($digits) === 11 && substr($digits, 0, 1) === '0') {
            $digits = substr($digits, 1);
        }

        return preg_match('/^[6-9][0-9]{9}$/', $digits) ? $digits : '';
    }

    private function is_valid_landing_date($value)
    {
        $date = DateTime::createFromFormat('!Y-m-d', $value);
        return $date instanceof DateTime && $date->format('Y-m-d') === $value;
    }

    private function landing_package_prices()
    {
        return array(
            'Bhutan Independence Day Offer' => 29749,
            'Bhutan Quick Escape' => 29749,
            'Classic Bhutan Discovery' => 36549,
            'Bhutan Family Holiday' => 42499,
            'Complete Bhutan Circuit' => 50999,
            'Fly-In Bhutan Getaway' => 39099,
            'Senior-Friendly Bhutan' => 46749,
            'Romantic Bhutan Retreat' => 40799,
            'Bhutan Festival Journey' => 55249,
            'Bhutan Grand Experience' => 63749,
            'Custom Bhutan Trip' => null,
        );
    }

    private function sdt_landing_package_prices()
    {
        return array(
            'Sikkim Darjeeling Special Offer' => 14999,
            'Sikkim Darjeeling Quick Escape' => 14999,
            'Classic Sikkim Darjeeling Discovery' => 18499,
            'Sikkim Darjeeling Family Holiday' => 21999,
            'Complete Sikkim Darjeeling Circuit' => 26999,
            'North Sikkim Explorer' => 20499,
            'Darjeeling Tea & Toy Train Special' => 12999,
            'Romantic Sikkim Darjeeling Retreat' => 19499,
            'Sikkim Darjeeling Festival Journey' => 22999,
            'Grand Sikkim Darjeeling Experience' => 29999,
            'Custom Sikkim Darjeeling Trip' => null,
        );
    }

    private function landing_post_value($key, $default = '')
    {
        $value = $this->input->post($key, true);
        if ($value === null || is_array($value)) {
            return $default;
        }

        $value = trim((string) $value);
        return $value === '' ? $default : $value;
    }
}
