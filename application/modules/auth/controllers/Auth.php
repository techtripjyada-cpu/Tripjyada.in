<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('auth/auth_mdl');
    }

    private function json($data)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    private function clean_phone($raw)
    {
        $p = preg_replace('/[^\d]/', '', $raw);
        if (strlen($p) === 10) return $p;
        if (strlen($p) === 12 && substr($p, 0, 2) === '91') return substr($p, 2);
        return false;
    }

    public function send_otp()
    {
        $this->output->set_content_type('application/json');
        $raw   = (string) $this->input->post('phone', true);
        $phone = $this->clean_phone($raw);

        if (!$phone) {
            return $this->json(array('ok' => false, 'message' => 'Enter a valid 10-digit mobile number.'));
        }

        if (!$this->auth_mdl->can_send_otp($phone)) {
            return $this->json(array('ok' => false, 'message' => 'Please wait before requesting another OTP.'));
        }

        $sent = $this->auth_mdl->create_and_send_otp($phone);
        if (!$sent) {
            return $this->json(array('ok' => false, 'message' => 'Could not send OTP. Please try again.'));
        }

        $msg = 'OTP sent to your WhatsApp number.';
        // In test mode expose OTP so it can be verified without a real WhatsApp connection
        if (is_array($sent) && !empty($sent['test_otp'])) {
            $msg = '[TEST MODE] Your OTP is: ' . $sent['test_otp'];
        }

        return $this->json(array('ok' => true, 'message' => $msg, 'phone' => $phone));
    }

    public function verify_otp()
    {
        $this->output->set_content_type('application/json');
        $raw   = (string) $this->input->post('phone', true);
        $otp   = preg_replace('/\D/', '', (string) $this->input->post('otp', true));
        $phone = $this->clean_phone($raw);

        if (!$phone || !$otp) {
            return $this->json(array('ok' => false, 'message' => 'Phone and OTP are required.'));
        }

        $result = $this->auth_mdl->verify_otp($phone, $otp);
        if (!$result['ok']) {
            return $this->json($result);
        }

        $user = $this->auth_mdl->find_or_create_user($phone);
        $this->session->set_userdata(array(
            'tj_user_id'    => $user['id'],
            'tj_user_phone' => $user['phone'],
            'tj_user_name'  => $user['name'] ?: '',
        ));

        $redirect = site_url('user');
        return $this->json(array('ok' => true, 'message' => 'Login successful.', 'redirect' => $redirect));
    }

    public function logout()
    {
        $this->session->unset_userdata(array('tj_user_id', 'tj_user_phone', 'tj_user_name'));
        redirect(site_url());
    }
}
