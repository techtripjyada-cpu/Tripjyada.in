<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller
{
    private $adminCfg = array();
    private $rzpCfg   = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->config('tripjyada_admin');
        $this->load->config('tripjyada_razorpay');
        $this->adminCfg = (array) $this->config->item('tripjyada_admin');
        $this->rzpCfg   = (array) $this->config->item('tripjyada_razorpay');
        $this->load->model('admin/admin_mdl');
    }

    private function auth_check()
    {
        if (!$this->session->userdata('tripjyada_admin_auth')) {
            redirect('admin/login');
        }
    }

    public function index()
    {
        redirect('admin/payments');
    }

    public function login()
    {
        if ($this->session->userdata('tripjyada_admin_auth')) {
            redirect('admin/payments');
            return;
        }
        $error = '';
        if ($this->input->post()) {
            $pw = $this->input->post('password', true);
            if ($pw === $this->adminCfg['password']) {
                $this->session->set_userdata('tripjyada_admin_auth', true);
                redirect('admin/payments');
                return;
            }
            $error = 'Incorrect password. Please try again.';
        }
        $this->load->view('admin/login', array('error' => $error));
    }

    public function logout()
    {
        $this->session->unset_userdata('tripjyada_admin_auth');
        redirect('admin/login');
    }

    public function payments()
    {
        $this->auth_check();
        $status  = (string) $this->input->get('status', true);
        $search  = (string) $this->input->get('q', true);
        $page    = max(1, (int) $this->input->get('page', true));
        $perPage = 20;

        $this->load->view('admin/payments', array(
            'payments'    => $this->admin_mdl->get_payments($status, $search, $page, $perPage),
            'total'       => $this->admin_mdl->count_payments($status, $search),
            'summary'     => $this->admin_mdl->get_summary(),
            'admin_stats' => $this->admin_mdl->get_admin_stats(),
            'page'        => $page,
            'per_page'    => $perPage,
            'status'      => $status,
            'search'      => $search,
        ));
    }

    public function users()
    {
        $this->auth_check();
        $search  = (string) $this->input->get('q', true);
        $page    = max(1, (int) $this->input->get('page', true));
        $perPage = 20;
        $this->load->view('admin/users', array(
            'users'       => $this->admin_mdl->get_users($search, $page, $perPage),
            'total'       => $this->admin_mdl->count_users($search),
            'admin_stats' => $this->admin_mdl->get_admin_stats(),
            'page'        => $page,
            'per_page'    => $perPage,
            'search'      => $search,
        ));
    }

    public function user_detail($id)
    {
        $this->auth_check();
        $user = $this->admin_mdl->get_user((int) $id);
        if (!$user) show_404();
        $bookings = $this->admin_mdl->get_user_bookings($user['phone']);
        $this->load->view('admin/user_detail', array('user' => $user, 'bookings' => $bookings));
    }

    public function cancellations()
    {
        $this->auth_check();
        $status  = (string) $this->input->get('status', true);
        $page    = max(1, (int) $this->input->get('page', true));
        $perPage = 20;
        $this->load->view('admin/cancellations', array(
            'requests'    => $this->admin_mdl->get_cancellations($status, $page, $perPage),
            'total'       => $this->admin_mdl->count_cancellations($status),
            'admin_stats' => $this->admin_mdl->get_admin_stats(),
            'page'        => $page,
            'per_page'    => $perPage,
            'status'      => $status,
        ));
    }

    public function update_cancellation($id)
    {
        $this->auth_check();
        $this->output->set_content_type('application/json');
        $status = (string) $this->input->post('status', true);
        $note   = (string) $this->input->post('note', true);
        $allowed = array('pending', 'approved', 'rejected');
        if (!in_array($status, $allowed, true)) {
            return $this->output->set_output(json_encode(array('ok' => false, 'message' => 'Invalid status.')));
        }
        $data = array('status' => $status);
        if ($note !== '') $data['admin_note'] = $note;
        $this->admin_mdl->update_cancellation((int) $id, $data);
        return $this->output->set_output(json_encode(array('ok' => true, 'message' => 'Updated.')));
    }

    public function batch_changes()
    {
        $this->auth_check();
        $status  = (string) $this->input->get('status', true);
        $page    = max(1, (int) $this->input->get('page', true));
        $perPage = 20;
        $this->load->view('admin/batch_changes', array(
            'requests'    => $this->admin_mdl->get_batch_changes($status, $page, $perPage),
            'total'       => $this->admin_mdl->count_batch_changes($status),
            'admin_stats' => $this->admin_mdl->get_admin_stats(),
            'page'        => $page,
            'per_page'    => $perPage,
            'status'      => $status,
        ));
    }

    public function update_batch_change($id)
    {
        $this->auth_check();
        $this->output->set_content_type('application/json');
        $status = (string) $this->input->post('status', true);
        $note   = (string) $this->input->post('note', true);
        $allowed = array('pending', 'approved', 'rejected');
        if (!in_array($status, $allowed, true)) {
            return $this->output->set_output(json_encode(array('ok' => false, 'message' => 'Invalid status.')));
        }
        $data = array('status' => $status);
        if ($note !== '') $data['admin_note'] = $note;
        $this->admin_mdl->update_batch_change((int) $id, $data);
        return $this->output->set_output(json_encode(array('ok' => true, 'message' => 'Updated.')));
    }

    public function payment_detail($id)
    {
        $this->auth_check();
        $payment = $this->admin_mdl->get_payment((int) $id);
        if (!$payment) {
            show_404();
        }
        $this->load->view('admin/payment_detail', array('payment' => $payment));
    }

    public function refund($id)
    {
        $this->auth_check();
        $this->output->set_content_type('application/json');

        $payment = $this->admin_mdl->get_payment((int) $id);
        if (!$payment) {
            return $this->output->set_status_header(404)
                ->set_output(json_encode(array('ok' => false, 'message' => 'Payment not found.')));
        }
        if (!in_array($payment['local_status'], array('paid', 'captured'), true)) {
            return $this->output->set_output(json_encode(array(
                'ok' => false, 'message' => 'Only paid/captured payments can be refunded.'
            )));
        }
        if (empty($payment['razorpay_payment_id'])) {
            return $this->output->set_output(json_encode(array(
                'ok' => false, 'message' => 'No Razorpay payment ID found. Use manual status update instead.'
            )));
        }

        $amountSubunits = (int) $this->input->post('amount_subunits', true);
        if ($amountSubunits <= 0) {
            $amountSubunits = (int) $payment['amount_subunits'];
        }

        $result = $this->call_razorpay_refund($payment['razorpay_payment_id'], $amountSubunits);
        if (!$result['ok']) {
            return $this->output->set_output(json_encode(array('ok' => false, 'message' => $result['message'])));
        }

        $this->admin_mdl->update_payment((int) $id, array(
            'local_status'   => 'refunded',
            'gateway_status' => 'refunded',
            'refund_id'      => isset($result['data']['id']) ? $result['data']['id'] : '',
            'refund_amount'  => $amountSubunits,
            'refunded_at'    => date('Y-m-d H:i:s'),
        ));

        return $this->output->set_output(json_encode(array(
            'ok'        => true,
            'message'   => 'Refund initiated successfully via Razorpay.',
            'refund_id' => isset($result['data']['id']) ? $result['data']['id'] : '',
        )));
    }

    public function update_status($id)
    {
        $this->auth_check();
        $this->output->set_content_type('application/json');

        $payment = $this->admin_mdl->get_payment((int) $id);
        if (!$payment) {
            return $this->output->set_status_header(404)
                ->set_output(json_encode(array('ok' => false, 'message' => 'Payment not found.')));
        }

        $allowed   = array('created', 'paid', 'captured', 'refunded', 'failed', 'cancelled', 'pending_review');
        $newStatus = (string) $this->input->post('status', true);
        $note      = (string) $this->input->post('note', true);

        if (!in_array($newStatus, $allowed, true)) {
            return $this->output->set_output(json_encode(array('ok' => false, 'message' => 'Invalid status.')));
        }

        $update = array('local_status' => $newStatus);
        if ($note !== '') {
            $update['admin_note'] = $note;
        }

        $this->admin_mdl->update_payment((int) $id, $update);
        return $this->output->set_output(json_encode(array('ok' => true, 'message' => 'Status updated.')));
    }

    public function cardpage()
    {
        $this->auth_check();
        $page_slug = trim((string) $this->input->get('slug', true)) ?: 'all';
        $msg       = (string) $this->input->get('msg', true);
        $edit_id   = (int) $this->input->get('edit', true);
        $edit_tab  = $edit_id ? $this->admin_mdl->get_cardpage_tab($edit_id) : null;

        $this->load->view('admin/cardpage', array(
            'tabs'        => $this->admin_mdl->get_cardpage_tabs($page_slug),
            'desc'        => $this->admin_mdl->get_cardpage_desc($page_slug),
            'page_slug'   => $page_slug,
            'msg'         => $msg,
            'edit_tab'    => $edit_tab,
            'admin_stats' => $this->admin_mdl->get_admin_stats(),
        ));
    }

    public function cardpage_save_tab()
    {
        $this->auth_check();
        $id        = (int) $this->input->post('id', true);
        $page_slug = trim((string) $this->input->post('page_slug', true)) ?: 'all';

        $data = array(
            'page_slug'            => $page_slug,
            'days_label'           => trim((string) $this->input->post('days_label', true)),
            'tab_title'            => trim((string) $this->input->post('tab_title', true)),
            'itinerary_heading'    => trim((string) $this->input->post('itinerary_heading', true)),
            'itinerary_subheading' => trim((string) $this->input->post('itinerary_subheading', true)),
            'day_data'             => trim((string) $this->input->post('day_data', true)),
            'sort_order'           => (int) $this->input->post('sort_order', true),
            'active'               => $this->input->post('active') ? 1 : 0,
        );

        if (!empty($_FILES['hero_image']['name'])) {
            $upload_path = FCPATH . 'assets/uploads/cardpage/';
            if (!is_dir($upload_path)) mkdir($upload_path, 0755, true);
            $this->load->library('upload', array(
                'upload_path'   => $upload_path,
                'allowed_types' => 'gif|jpg|jpeg|png|webp',
                'max_size'      => 5120,
                'encrypt_name'  => true,
            ));
            if ($this->upload->do_upload('hero_image')) {
                $data['hero_image'] = $this->upload->data('file_name');
            }
        }

        $this->admin_mdl->save_cardpage_tab($data, $id);
        redirect(site_url('admin/cardpage?slug=' . $page_slug . '&msg=tab_saved'));
    }

    public function cardpage_delete_tab($id)
    {
        $this->auth_check();
        $tab = $this->admin_mdl->get_cardpage_tab((int) $id);
        $page_slug = ($tab && !empty($tab['page_slug'])) ? $tab['page_slug'] : 'all';
        $this->admin_mdl->delete_cardpage_tab((int) $id);
        redirect(site_url('admin/cardpage?slug=' . $page_slug . '&msg=tab_deleted'));
    }

    public function cardpage_save_desc()
    {
        $this->auth_check();
        $page_slug = trim((string) $this->input->post('page_slug', true)) ?: 'all';
        $data = array(
            'heading' => trim((string) $this->input->post('heading', true)),
            'body'    => trim((string) $this->input->post('body', true)),
            'active'  => $this->input->post('active') ? 1 : 0,
        );
        $this->admin_mdl->save_cardpage_desc($page_slug, $data);
        redirect(site_url('admin/cardpage?slug=' . $page_slug . '&msg=desc_saved'));
    }

    private function call_razorpay_refund($paymentId, $amountSubunits)
    {
        if (!function_exists('curl_init')) {
            return array('ok' => false, 'message' => 'cURL is not available on this server.');
        }
        $keyId     = isset($this->rzpCfg['key_id'])     ? $this->rzpCfg['key_id']     : '';
        $keySecret = isset($this->rzpCfg['key_secret']) ? $this->rzpCfg['key_secret'] : '';
        if (!$keyId || !$keySecret) {
            return array('ok' => false, 'message' => 'Razorpay API keys are not configured.');
        }

        $url = 'https://api.razorpay.com/v1/payments/' . rawurlencode($paymentId) . '/refund';
        $ch  = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode(array('amount' => $amountSubunits, 'speed' => 'normal')),
            CURLOPT_USERPWD        => $keyId . ':' . $keySecret,
            CURLOPT_HTTPHEADER     => array('Content-Type: application/json', 'Accept: application/json'),
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_CONNECTTIMEOUT => 10,
        ));

        $body = curl_exec($ch);
        $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $decoded = json_decode($body, true);
        if ($code >= 400) {
            $msg = isset($decoded['error']['description']) ? $decoded['error']['description'] : 'Razorpay refund failed.';
            return array('ok' => false, 'message' => $msg);
        }
        return array('ok' => true, 'data' => is_array($decoded) ? $decoded : array());
    }
}
