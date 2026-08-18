<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts_mdl extends CI_Model
{
    private $smtpConfig = array();
    private $mailConfig = array();
    private $crmConfig = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->config('tripjyada_smtp');
        $this->load->config('tripjyada_mail');
        $this->load->config('tripjyada_crm');

        $this->smtpConfig = (array) $this->config->item('tripjyada_smtp');
        $this->mailConfig = (array) $this->config->item('tripjyada_mail');
        $this->crmConfig = (array) $this->config->item('tripjyada_crm');
    }

    public function insert()
    {
        $name = $this->postValue('name');
        $email = $this->postValue('email');
        $message = $this->postValue('message');
        $phone = $this->postValue('phone');
        $travellingFrom = $this->postValue('mfrom');
        $category = $this->postValue('category');

        $inserted = $this->insertIntoTable('contacts', array(
            'name' => $name,
            'email' => $email,
            'mfrom' => $travellingFrom,
            'phone' => $phone,
            'message' => $message,
            'category' => $category,
        ));

        if (! $inserted) {
            return false;
        }

        $adminMessage = $this->buildEmailCard(
            'New Contact Message Received',
            array(
                'Category' => $category,
                'Name' => $name,
                'Phone' => $phone,
                'Travelling From' => $travellingFrom,
                'Email' => $email,
                'Message' => $message,
            )
        );

        $this->sendAdminNotification(
            $this->notificationRecipient('contact_notification_email'),
            $this->subjectLine('New Contact Message Received'),
            $adminMessage,
            $email,
            $name
        );

        if ($email !== '' && $this->mailFlag('send_contact_auto_reply', true)) {
            $clientMessage = $this->buildEmailCard(
                'Thank You For Contacting Us',
                array(
                    'Name' => $name,
                    'Phone' => $phone,
                    'Travelling From' => $travellingFrom,
                    'Category' => $category,
                ),
                'We have received your enquiry and our team will get back to you shortly.'
            );

            $this->sendEmail($email, 'Thank You for Contacting Tripjyada!', $clientMessage, array(
                'reply_to_email' => $this->mailSetting('reply_to_email', $this->resolveFromEmail()),
                'reply_to_name' => $this->mailSetting('company_name', 'Tripjyada'),
            ));
        }

        return true;
    }

    public function bookings()
    {
        $firstName = $this->postValue('name');
        $lastName = $this->postValue('lastname');
        $name = trim($firstName . ' ' . $lastName);
        $email = $this->postValue('email');
        $countryCode = $this->postValue('countrycode', '+91');
        $phoneNumber = $this->postValue('phone');
        $phone = trim($countryCode . ' ' . $phoneNumber);
        $travellingFrom = $this->postValue('mfrom');
        $destination = $this->postValue('mto');
        $message = $this->postValue('message');
        $marketingOptIn = $this->input->post('marketing') ? 'Yes' : 'No';

        $inserted = $this->insertIntoTable('bookings', array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'mfrom' => $travellingFrom,
            'mto' => $destination,
            'msg' => $message,
        ));

        if (! $inserted) {
            return false;
        }

        $adminMessage = $this->buildEmailCard(
            'New Booking Enquiry Received',
            array(
                'Name' => $name,
                'Phone' => $phone,
                'Email' => $email,
                'Travelling From' => $travellingFrom,
                'Destination' => $destination,
                'Client Message' => $message,
                'Marketing Consent' => $marketingOptIn,
            )
        );

        $this->sendAdminNotification(
            $this->notificationRecipient('booking_notification_email'),
            $this->subjectLine('New Booking Enquiry Received'),
            $adminMessage,
            $email,
            $name
        );

        if ($email !== '' && $this->mailFlag('send_booking_auto_reply', true)) {
            $clientMessage = $this->buildEmailCard(
                'Thank You For Your Booking Enquiry',
                array(
                    'Traveller Name' => $name,
                    'Travelling From' => $travellingFrom,
                    'Destination' => $destination,
                ),
                'We have received your enquiry and our team will get back to you shortly with the next steps.'
            );

            $this->sendEmail($email, 'Thank You for Your Booking Inquiry!', $clientMessage, array(
                'reply_to_email' => $this->mailSetting('reply_to_email', $this->resolveFromEmail()),
                'reply_to_name' => $this->mailSetting('company_name', 'Tripjyada'),
            ));
        }

        return true;
    }

    public function slider_enquiry()
    {
        $name = $this->postValue('name');
        $phone = $this->postValue('phone');
        $address = $this->postValue('address');
        $destination = $this->postValue('destination');
        $dateOfArrival = $this->postValue('date_of_arrival');
        $message = $dateOfArrival !== '' ? 'Date of Arrival: ' . $dateOfArrival : '';

        $inserted = $this->insertIntoTable('bookings', array(
            'name' => $name,
            'email' => '',
            'phone' => $phone,
            'mfrom' => $address,
            'mto' => $destination,
            'msg' => $message,
        ));

        if (! $inserted) {
            return false;
        }

        $adminMessage = $this->buildEmailCard(
            'New Slider Enquiry Received',
            array(
                'Name' => $name,
                'Phone' => $phone,
                'Address' => $address,
                'Destination' => $destination,
                'Date of Arrival' => $dateOfArrival,
            )
        );

        $this->sendAdminNotification(
            $this->notificationRecipient('slider_notification_email'),
            $this->subjectLine('New Slider Enquiry Received'),
            $adminMessage,
            '',
            $name
        );

        return true;
    }

    public function newsletter()
    {
        $email = $this->postValue('email');

        $inserted = $this->insertIntoTable('newsletter', array(
            'email' => $email,
        ));

        if (! $inserted) {
            return false;
        }

        $adminMessage = $this->buildEmailCard(
            'New Newsletter Subscription',
            array(
                'Email' => $email,
            )
        );

        $this->sendAdminNotification(
            $this->notificationRecipient('newsletter_notification_email'),
            $this->subjectLine('New Newsletter Subscription'),
            $adminMessage,
            $email,
            'Newsletter Subscriber'
        );

        return true;
    }

    public function faq()
    {
        $name = $this->postValue('name');
        $phone = $this->postValue('phone');
        $question = $this->postValue('question');

        $inserted = $this->insertIntoTable('faq', array(
            'phone' => $phone,
            'name' => $name,
            'question' => $question,
        ));

        if (! $inserted) {
            return false;
        }

        $adminMessage = $this->buildEmailCard(
            'New FAQ Question Received',
            array(
                'Name' => $name,
                'Phone' => $phone,
                'Question' => $question,
            )
        );

        $this->sendAdminNotification(
            $this->notificationRecipient('faq_notification_email'),
            $this->subjectLine('New FAQ Question Received'),
            $adminMessage,
            '',
            $name
        );

        return true;
    }

    public function contact()
    {
        $name = $this->postValue('name');
        $email = $this->postValue('email');
        $phone = $this->postValue('phone');
        $subject = $this->postValue('subject');
        $message = $this->postValue('message');

        $dbMessage = $subject !== '' ? "Subject: {$subject}\n\n{$message}" : $message;
        $insert = array(
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'message' => $dbMessage,
        );

        $fields = $this->db->list_fields('contacts');
        if (in_array('subject', $fields, true)) {
            $insert['subject'] = $subject;
        }

        $inserted = $this->insertIntoTable('contacts', $insert);
        if (! $inserted) {
            return false;
        }

        $adminMessage = $this->buildEmailCard(
            'New Contact Enquiry',
            array(
                'Name' => $name,
                'Phone' => $phone,
                'Email' => $email,
                'Subject' => $subject,
                'Message' => $message,
            )
        );

        $subjectLine = $subject !== ''
            ? 'Contact Enquiry: ' . $subject
            : 'New Contact Enquiry';

        $this->sendAdminNotification(
            $this->notificationRecipient('contact_notification_email'),
            $this->subjectLine($subjectLine),
            $adminMessage,
            $email,
            $name
        );

        if ($email !== '' && $this->mailFlag('send_contact_auto_reply', true)) {
            $clientMessage = $this->buildEmailCard(
                'Thank You For Contacting Us',
                array(
                    'Name' => $name,
                    'Phone' => $phone,
                    'Subject' => $subject,
                ),
                'We have received your enquiry and our team will get back to you shortly.'
            );

            $this->sendEmail($email, 'Thank You for Contacting Tripjyada!', $clientMessage, array(
                'reply_to_email' => $this->mailSetting('reply_to_email', $this->resolveFromEmail()),
                'reply_to_name' => $this->mailSetting('company_name', 'Tripjyada'),
            ));
        }

        return true;
    }

    /**
     * Persist a campaign lead, notify the admin and acknowledge the traveller.
     * Mail failures are reported separately so a temporary SMTP outage never
     * causes a successfully stored lead to be lost or submitted repeatedly.
     */
    public function landing_booking(array $lead, $campaignLabel = 'Bhutan', $crmSlug = '')
    {
        $phoneDisplay = '+91 ' . $lead['phone'];
        $travelTiming = $lead['travel_date'] !== '' ? $lead['travel_date'] : $lead['travel_month'];

        $messageParts = array(
            'Landing-page enquiry',
            'Travellers: ' . $lead['travellers'],
            'Hotel: ' . $lead['hotel_category'],
        );
        if ($lead['estimated_price'] !== '') {
            $messageParts[] = 'Displayed price: ' . $lead['estimated_price'];
        }
        if ($lead['message'] !== '') {
            $messageParts[] = 'Message: ' . $lead['message'];
        }

        // The current production-compatible schema uses VARCHAR(300) for msg.
        $databaseMessage = $this->truncateText(implode(' | ', $messageParts), 300);
        $inserted = $this->insertIntoTable('bookings', array(
            'name' => $lead['name'],
            'email' => $lead['email'],
            // Store ten digits so legacy VARCHAR(11) installations do not truncate it.
            'phone' => $lead['phone'],
            'mfrom' => 'Landing Page' . ($travelTiming !== '' ? ' - ' . $travelTiming : ''),
            'mto' => $lead['package_name'],
            'msg' => $databaseMessage,
            'category' => 'landing-page',
            'date' => $lead['travel_date'] !== '' ? $lead['travel_date'] : null,
            'transportation' => $lead['travellers'],
            'configuration' => $lead['hotel_category'],
        ));

        if (! $inserted) {
            return array(
                'stored' => false,
                'admin_email_sent' => false,
                'user_email_sent' => false,
            );
        }

        // Only the admin is notified here (no traveller auto-reply): a single
        // reliable send to the inbox that actually needs to act on the lead.
        $adminMessage = $this->buildEmailCard(
            "New Lead Received – {$campaignLabel}",
            array(
                'Name' => $lead['name'],
                'Phone' => $phoneDisplay,
                'Email' => $lead['email'],
                'Package' => $lead['package_name'],
                'Travel Month' => $lead['travel_month'],
                'Travel Date' => $lead['travel_date'],
                'Travellers' => $lead['travellers'],
                'Hotel Category' => $lead['hotel_category'],
                'Displayed Price' => $lead['estimated_price'],
                'Client Message' => $lead['message'],
                'Form Location' => $lead['source'],
            ),
            'The enquiry is saved in the Bookings section of the admin panel.'
        );

        $adminEmailSent = $this->sendAdminNotification(
            $this->notificationRecipient('booking_notification_email'),
            $this->subjectLine("New Lead Received – {$campaignLabel}"),
            $adminMessage,
            $lead['email'],
            $lead['name']
        );

        // Best-effort push to the partner CRM: the lead is already saved and the
        // admin already notified above, so a slow or unreachable CRM API must
        // never turn a successfully captured lead into a failed submission.
        $crmSynced = $this->pushLeadToCrm($lead, $crmSlug);

        return array(
            'stored' => true,
            'admin_email_sent' => $adminEmailSent,
            'user_email_sent' => false,
            'crm_synced' => $crmSynced,
        );
    }

    private function pushLeadToCrm(array $lead, $crmSlug)
    {
        $endpointKey = $crmSlug === 'std' ? 'lead_api_std' : 'lead_api_bhutan';
        $endpoint = isset($this->crmConfig[$endpointKey]) ? (string) $this->crmConfig[$endpointKey] : '';

        if ($endpoint === '' || $crmSlug === '') {
            return false;
        }

        $payload = array(
            'name' => $lead['name'],
            'email' => $lead['email'],
            'phone' => $lead['phone'],
            'travellers' => $lead['travellers'],
            'source' => $lead['source'],
            'package_name' => $lead['package_name'],
            'hotel_category' => $lead['hotel_category'],
            'travel_month' => $lead['travel_month'] !== '' ? $lead['travel_month'] : null,
            // The landing form only accepts submissions with consent already
            // checked, so a lead reaching this point always implies consent.
            'privacy_consent' => 1,
        );

        $ch = curl_init($endpoint);
        curl_setopt_array($ch, array(
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Accept: application/json'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => isset($this->crmConfig['lead_api_timeout']) ? (int) $this->crmConfig['lead_api_timeout'] : 8,
            CURLOPT_CONNECTTIMEOUT => 5,
        ));

        $response = curl_exec($ch);
        $curlError = curl_error($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false || $statusCode < 200 || $statusCode >= 300) {
            log_message(
                'error',
                "CRM lead push failed for {$crmSlug} (status {$statusCode}): " . ($curlError !== '' ? $curlError : $response)
            );
            return false;
        }

        return true;
    }

    public function send_test_mail($toEmail, $requestedBy = 'manual test')
    {
        $adminMessage = $this->buildEmailCard(
            'SMTP Test Email',
            array(
                'Sent To' => $toEmail,
                'Requested By' => $requestedBy,
                'Mailer Host' => $this->smtpSetting('smtp_host', 'not configured'),
                'Mailer User' => $this->smtpSetting('smtp_user', 'not configured'),
                'Environment' => defined('ENVIRONMENT') ? ENVIRONMENT : 'unknown',
            ),
            'If you received this message, your TripJyada website SMTP configuration is working.'
        );

        return $this->sendEmail($toEmail, $this->subjectLine('TripJyada SMTP Test Email'), $adminMessage, array(
            'reply_to_email' => $this->mailSetting('reply_to_email', $this->resolveFromEmail()),
            'reply_to_name' => $this->mailSetting('company_name', 'Tripjyada'),
        ));
    }

    private function createEmailClient()
    {
        $this->load->library('email');
        $this->email->clear(true);
        $this->email->initialize($this->smtpConfig);
        $this->email->set_newline($this->smtpSetting('newline', "\r\n"));
        $this->email->set_crlf($this->smtpSetting('crlf', "\r\n"));

        return $this->email;
    }

    private function sendAdminNotification($recipient, $subject, $message, $replyToEmail = '', $replyToName = '')
    {
        $options = array();

        if ($replyToEmail !== '') {
            $options['reply_to_email'] = $replyToEmail;
            $options['reply_to_name'] = $replyToName;
        }

        return $this->sendEmail($recipient, $subject, $message, $options);
    }

    private function sendEmail($to, $subject, $message, array $options = array())
    {
        $fromEmail = $this->resolveFromEmail();
        if ($fromEmail === '' || empty($to)) {
            log_message('error', 'Email skipped because sender or recipient is missing for subject: ' . $subject);
            return false;
        }

        $email = $this->createEmailClient();
        $fromName = isset($options['from_name'])
            ? $options['from_name']
            : $this->mailSetting('company_name', 'Tripjyada');

        $email->from($fromEmail, $fromName);
        $email->to($to);

        if (! empty($options['reply_to_email'])) {
            $email->reply_to($options['reply_to_email'], isset($options['reply_to_name']) ? $options['reply_to_name'] : '');
        }

        $email->subject($subject);
        $email->message($message);

        if (! $email->send()) {
            log_message(
                'error',
                'Email send failed for subject "' . $subject . '": ' . strip_tags($email->print_debugger(array('headers', 'subject')))
            );
            return false;
        }

        return true;
    }

    private function insertIntoTable($table, array $data)
    {
        $inserted = $this->db->insert($table, $data);
        if (! $inserted) {
            $dbError = $this->db->error();
            log_message('error', 'Database insert failed for table "' . $table . '": ' . $dbError['message']);
            return false;
        }

        return true;
    }

    private function buildEmailCard($title, array $fields, $intro = '')
    {
        $rows = array();
        foreach ($fields as $label => $value) {
            if ($value === '' || $value === null) {
                continue;
            }

            $rows[] = '<p style="margin:0 0 12px;"><strong>' . $this->escape($label) . ':</strong> ' . $this->formatEmailValue($label, $value) . '</p>';
        }

        $introHtml = $intro !== ''
            ? '<p style="margin:0 0 16px;">' . $this->escape($intro) . '</p>'
            : '';

        return '<div style="padding:24px;background:#f3f4f6;color:#111827;font-size:15px;line-height:1.7;">'
            . '<h2 style="margin:0 0 16px;font-size:20px;color:#f97316;">' . $this->escape($title) . '</h2>'
            . $introHtml
            . implode('', $rows)
            . '</div>';
    }

    private function formatEmailValue($label, $value)
    {
        $value = (string) $value;
        $escapedValue = nl2br($this->escape($value));
        $label = strtolower($label);

        if (strpos($label, 'email') !== false && filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return '<a href="mailto:' . $this->escape($value) . '">' . $this->escape($value) . '</a>';
        }

        if (strpos($label, 'phone') !== false) {
            $tel = preg_replace('/[^0-9\+]/', '', $value);
            if ($tel !== '') {
                return '<a href="tel:' . $this->escape($tel) . '">' . $escapedValue . '</a>';
            }
        }

        return $escapedValue;
    }

    private function subjectLine($subject)
    {
        $companyDomain = $this->mailSetting('company_domain');
        return $companyDomain !== '' ? $subject . ' | ' . $companyDomain : $subject;
    }

    private function notificationRecipient($key)
    {
        return $this->mailSetting($key, $this->mailSetting('support_email', ''));
    }

    private function resolveFromEmail()
    {
        $smtpUser = $this->smtpSetting('smtp_user');
        if ($smtpUser !== '') {
            return $smtpUser;
        }

        return $this->mailSetting('support_email', '');
    }

    private function mailSetting($key, $default = '')
    {
        return isset($this->mailConfig[$key]) && $this->mailConfig[$key] !== ''
            ? $this->mailConfig[$key]
            : $default;
    }

    private function mailFlag($key, $default = false)
    {
        if (! array_key_exists($key, $this->mailConfig)) {
            return $default;
        }

        return (bool) $this->mailConfig[$key];
    }

    private function smtpSetting($key, $default = '')
    {
        return isset($this->smtpConfig[$key]) && $this->smtpConfig[$key] !== ''
            ? $this->smtpConfig[$key]
            : $default;
    }

    private function postValue($key, $default = '')
    {
        $value = $this->input->post($key, true);
        if ($value === null) {
            return $default;
        }

        $value = trim((string) $value);
        return $value === '' ? $default : $value;
    }

    private function truncateText($value, $length)
    {
        if (function_exists('mb_substr')) {
            return mb_substr((string) $value, 0, $length, 'UTF-8');
        }

        return substr((string) $value, 0, $length);
    }

    private function escape($value)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}
