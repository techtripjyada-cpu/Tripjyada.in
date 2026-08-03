<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Chatbot extends MX_Controller
{
    private $cfg = [];
    private $apiUrl = 'https://api.anthropic.com/v1/messages';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->config('tripjyada_chatbot', true);
        $this->cfg = (array) $this->config->item('tripjyada_chatbot');
    }

    public function reply()
    {
        $this->output->set_content_type('application/json');

        if (!$this->input->post()) {
            return $this->err('Invalid request.', 405);
        }

        $key = $this->cfg_val('anthropic_api_key');
        if (!$key) {
            return $this->err('Chatbot is not configured yet.', 503);
        }

        $message = trim((string) $this->input->post('message', true));
        if ($message === '') {
            return $this->err('Message cannot be empty.', 422);
        }

        $historyJson = $this->input->post('history', true);
        $history = [];
        if ($historyJson) {
            $decoded = json_decode($historyJson, true);
            if (is_array($decoded)) {
                foreach ($decoded as $h) {
                    if (isset($h['role'], $h['content']) && in_array($h['role'], ['user', 'assistant'], true)) {
                        $history[] = [
                            'role'    => $h['role'],
                            'content' => substr((string) $h['content'], 0, 2000),
                        ];
                    }
                }
            }
        }

        $this->load->model('packages/packages_mdl');
        $packages = $this->packages_mdl->get_packages();

        $messages   = $history;
        $messages[] = ['role' => 'user', 'content' => $message];

        $payload = [
            'model'      => $this->cfg_val('model', 'claude-haiku-4-5-20251001'),
            'max_tokens' => (int) $this->cfg_val('max_tokens', 800),
            'system'     => $this->system_prompt($packages),
            'messages'   => $messages,
        ];

        $result = $this->call_api($key, $payload);
        if (!$result['ok']) {
            return $this->err($result['message']);
        }

        $raw  = trim($result['content']);
        $data = json_decode($raw, true);
        if (!is_array($data) || !isset($data['message'])) {
            $data = ['message' => $raw, 'action' => null];
        }

        return $this->output->set_output(json_encode([
            'ok'      => true,
            'message' => (string) $data['message'],
            'action'  => (isset($data['action']) && is_array($data['action'])) ? $data['action'] : null,
        ]));
    }

    private function system_prompt($packages)
    {
        $pkgLines = '';
        foreach ($packages as $p) {
            $raw   = isset($p['price']) ? preg_replace('/[^0-9.]/', '', $p['price']) : '';
            $price = ($raw !== '' && (float) $raw > 0) ? 'Rs ' . number_format((float) $raw) : 'Contact for price';
            $cat   = isset($p['category_slug']) ? $p['category_slug'] : '';
            $slug  = isset($p['slug']) ? $p['slug'] : '';
            $url   = rtrim(base_url(), '/') . '/' . $cat . '/' . $slug;
            $pkgLines .= "• ID:{$p['p_id']} | {$p['title']} | {$price} | slug:{$slug} | cat:{$cat} | URL:{$url}\n";
        }
        if ($pkgLines === '') {
            $pkgLines = "No packages currently listed — direct users to " . base_url('tour-package') . "\n";
        }

        return <<<PROMPT
You are TripBot, a friendly and knowledgeable travel assistant for Tripjyada Pvt Ltd — a trusted travel agency in India.

COMPANY INFO:
- Name: Tripjyada Pvt Ltd | GSTIN: 19AATFT6367Q1ZS
- Registered Office: Shivmandir, Siliguri, Darjeeling – 734011
- Corporate Office: 197, Jodhpur Gardens, Kolkata – 700045
- Branch: Kachari Basti Rd, opposite Barbeque Nation, Ulubari, Guwahati – 781007
- Website: https://tripjyada.in

AVAILABLE PACKAGES:
{$pkgLines}

FAQS:
- Customized trips? Yes, we offer fully customized travel planning.
- Booking process: Browse packages → Choose one → Fill your details → Pay securely via Razorpay (cards, UPI, net banking, wallets).
- Visa assistance? Yes, we help with all visa documentation.
- Are hotels included? Yes, accommodation is included in most packages.
- Is transport included? Yes, sightseeing transport is included in tour packages.
- Best time for Bhutan? October–December and March–May are ideal.
- Group tours available? Yes, we have group tour packages.
- Cancellation policy? Please contact us directly for cancellation and refund terms.
- Is online payment safe? Yes, all payments are SSL-encrypted and processed by Razorpay.
- Can I pay in EMI? Razorpay supports EMI on select cards.

RESPONSE FORMAT:
ALWAYS respond with valid JSON only. No text before or after the JSON object.
{"message": "your reply here", "action": null}

When the user clearly and specifically wants to book a named package, ask once to confirm. Once confirmed, respond:
{"message": "Opening the secure payment form for [Package Name]!", "action": {"type": "open_payment", "package_id": <number>, "package_slug": "<slug>", "package_category_slug": "<cat_slug>", "package_title": "<title>", "amount_display": "<e.g. Rs 45,000>"}}

RULES:
- Be warm, concise, and helpful. Use a friendly tone.
- Share package URLs when the user asks about a specific package.
- For anything you are not sure about, say to contact the Tripjyada team directly.
- Use ₹ or Rs for prices.
- Only trigger "open_payment" when the user explicitly confirms they want to book a specific package.
- Do NOT trigger "open_payment" if the price is "Contact for price".
PROMPT;
    }

    private function call_api($key, $payload)
    {
        if (!function_exists('curl_init')) {
            return ['ok' => false, 'message' => 'cURL is not available on this server.'];
        }

        $ch = curl_init($this->apiUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'x-api-key: ' . $key,
                'anthropic-version: 2023-06-01',
            ],
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_CONNECTTIMEOUT => 10,
        ]);

        $body = curl_exec($ch);
        if ($body === false) {
            $error = curl_error($ch);
            curl_close($ch);
            log_message('error', '[TripBot] cURL error: ' . $error);
            return ['ok' => false, 'message' => 'Could not reach the AI service. Please try again.'];
        }

        $statusCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $decoded = json_decode($body, true);
        if ($statusCode >= 400) {
            $msg = isset($decoded['error']['message']) ? $decoded['error']['message'] : 'AI service returned an error.';
            log_message('error', '[TripBot] API error ' . $statusCode . ': ' . $body);
            return ['ok' => false, 'message' => $msg];
        }

        $content = isset($decoded['content'][0]['text']) ? $decoded['content'][0]['text'] : '';
        return ['ok' => true, 'content' => $content];
    }

    private function cfg_val($key, $default = '')
    {
        return (isset($this->cfg[$key]) && $this->cfg[$key] !== '') ? $this->cfg[$key] : $default;
    }

    private function err($msg, $code = 500)
    {
        return $this->output
            ->set_status_header($code)
            ->set_output(json_encode(['ok' => false, 'message' => $msg]));
    }
}
