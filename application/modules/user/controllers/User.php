<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller
{
    private $uid;
    private $uphone;
    private $uname;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('user/user_mdl');

        $this->uid    = $this->session->userdata('tj_user_id');
        $this->uphone = $this->session->userdata('tj_user_phone');
        $this->uname  = $this->session->userdata('tj_user_name');

        if (!$this->uid) {
            redirect(site_url('?login=1'));
        }
    }

    private function render($view, $data = array())
    {
        $user = $this->user_mdl->get_user($this->uid);
        $data['user']        = $user;
        $data['active_page'] = isset($data['active_page']) ? $data['active_page'] : 'dashboard';
        $this->load->view('user/layout', $data + array('content_view' => $view));
    }

    public function dashboard()
    {
        $stats = $this->user_mdl->get_stats($this->uphone);
        $this->render('user/dashboard', array(
            'active_page'    => 'dashboard',
            'total_bookings' => $stats['total_bookings'],
            'next_trip'      => $stats['next_trip'],
        ));
    }

    public function profile()
    {
        $this->render('user/profile', array('active_page' => 'profile'));
    }

    public function update_profile()
    {
        if (!$this->input->post()) { redirect(site_url('user/profile')); return; }

        $allowed = array('name', 'email', 'gender', 'dob', 'instagram', 'hometown', 'current_town', 'address', 'about');
        $data = array();
        foreach ($allowed as $f) {
            $v = $this->input->post($f, true);
            if ($v !== null && $v !== '') $data[$f] = $v;
        }

        // Upload library — initialize() must be called before each do_upload()
        $this->load->library('upload');

        // Profile picture upload
        if (!empty($_FILES['profile_pic']['name'])) {
            $this->upload->initialize(array(
                'upload_path'   => FCPATH . 'assets/uploads/avatars/',
                'allowed_types' => 'jpg|jpeg|png|webp',
                'max_size'      => 2048,
                'file_name'     => 'avatar_' . $this->uid,
                'overwrite'     => TRUE,
            ));
            if ($this->upload->do_upload('profile_pic')) {
                $info = $this->upload->data();
                $data['profile_pic'] = 'assets/uploads/avatars/' . $info['file_name'];
            }
        }

        // ID proof upload
        if (!empty($_FILES['id_proof']['name'])) {
            $this->upload->initialize(array(
                'upload_path'   => FCPATH . 'assets/uploads/id_proofs/',
                'allowed_types' => 'jpg|jpeg|png|webp|pdf',
                'max_size'      => 2048,
                'file_name'     => 'id_' . $this->uid,
                'overwrite'     => TRUE,
            ));
            if ($this->upload->do_upload('id_proof')) {
                $info = $this->upload->data();
                $data['id_proof'] = 'assets/uploads/id_proofs/' . $info['file_name'];
            }
        }

        if ($data) {
            $this->user_mdl->update_profile($this->uid, $data);
            if (!empty($data['name'])) {
                $this->session->set_userdata('tj_user_name', $data['name']);
            }
        }

        redirect(site_url('user/profile') . '?saved=1');
    }

    public function bookings()
    {
        $page   = max(1, (int) $this->input->get('page'));
        $per    = 10;
        $items  = $this->user_mdl->get_bookings_with_packages($this->uphone, $page, $per);
        $total  = $this->user_mdl->count_bookings($this->uphone);
        $this->render('user/bookings', array(
            'active_page' => 'bookings',
            'bookings'    => $items,
            'total'       => $total,
            'page'        => $page,
            'per_page'    => $per,
        ));
    }

    public function my_trips()
    {
        $completed = $this->user_mdl->get_completed_trips($this->uphone);
        $this->render('user/my_trips', array(
            'active_page'      => 'my_trips',
            'completed_trips'  => $completed,
            'completed_count'  => count($completed),
        ));
    }

    public function invoice($id)
    {
        $booking = $this->user_mdl->get_booking_with_package((int) $id, $this->uphone);
        if (!$booking) { redirect(site_url('user/bookings')); return; }
        if (!in_array($booking['local_status'], array('paid', 'captured', 'verified'), true)) {
            redirect(site_url('user/bookings')); return;
        }
        $user = $this->user_mdl->get_user($this->uid);
        $this->load->view('user/invoice', array('booking' => $booking, 'user' => $user));
    }

    public function cancellation()
    {
        $success = false;
        if ($this->input->post()) {
            $bid    = (string) $this->input->post('booking_ref', true);
            $reason = (string) $this->input->post('reason', true);
            if ($bid && $reason) {
                $pid = 0;
                if (is_numeric($bid)) {
                    $bk = $this->user_mdl->get_booking((int) $bid, $this->uphone);
                    if ($bk) $pid = $bk['id'];
                }
                $this->user_mdl->submit_cancellation($this->uid, array(
                    'payment_id'  => $pid ?: null,
                    'booking_ref' => $bid,
                    'reason'      => $reason,
                ));
                $success = true;
            }
        }
        $requests = $this->user_mdl->get_cancellations($this->uid);
        $bookings = $this->user_mdl->get_bookings($this->uphone, 1, 100);
        $this->render('user/cancellation', array(
            'active_page' => 'cancellation',
            'requests'    => $requests,
            'bookings'    => $bookings,
            'success'     => $success,
        ));
    }

    public function batch_change()
    {
        $success = false;
        if ($this->input->post()) {
            $bid     = (string) $this->input->post('booking_ref', true);
            $current = (string) $this->input->post('current_batch', true);
            $wanted  = (string) $this->input->post('requested_batch', true);
            $reason  = (string) $this->input->post('reason', true);
            if ($bid && $wanted) {
                $pid = 0;
                if (is_numeric($bid)) {
                    $bk = $this->user_mdl->get_booking((int) $bid, $this->uphone);
                    if ($bk) $pid = $bk['id'];
                }
                $this->user_mdl->submit_batch_change($this->uid, array(
                    'payment_id'      => $pid ?: null,
                    'booking_ref'     => $bid,
                    'current_batch'   => $current,
                    'requested_batch' => $wanted,
                    'reason'          => $reason,
                ));
                $success = true;
            }
        }
        $requests = $this->user_mdl->get_batch_changes($this->uid);
        $bookings = $this->user_mdl->get_bookings($this->uphone, 1, 100);
        $this->render('user/batch_change', array(
            'active_page' => 'batch_change',
            'requests'    => $requests,
            'bookings'    => $bookings,
            'success'     => $success,
        ));
    }

    public function payment_options()
    {
        $this->render('user/payment_options', array('active_page' => 'payment_options'));
    }

    public function terms()
    {
        $this->render('user/terms', array('active_page' => 'terms'));
    }
}
