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
        $this->load->config('tripjyada_mail', true);
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
}
