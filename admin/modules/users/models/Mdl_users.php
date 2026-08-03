<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_users extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_users($search = '')
    {
        if (!$this->db->table_exists('users')) return array();

        if ($search) {
            $this->db->group_start();
            $this->db->like('phone', $search);
            $this->db->or_like('name', $search);
            $this->db->or_like('email', $search);
            $this->db->group_end();
        }
        $this->db->order_by('last_login_at', 'desc');
        return $this->db->get('users')->result_array();
    }

    public function get_otp_logs($phone = '')
    {
        if (!$this->db->table_exists('user_otp')) return array();

        if ($phone) $this->db->where('phone', $phone);
        $this->db->order_by('id', 'desc')->limit(200);
        return $this->db->get('user_otp')->result_array();
    }

    public function get_stats()
    {
        $total    = $this->db->table_exists('users')   ? $this->db->count_all('users')   : 0;
        $today    = 0;
        $week     = 0;

        if ($this->db->table_exists('users')) {
            $today = $this->db->where('DATE(last_login_at)', date('Y-m-d'))->count_all_results('users');
            $week  = $this->db->where('last_login_at >=', date('Y-m-d H:i:s', strtotime('-7 days')))->count_all_results('users');
        }

        $pending_cancel = 0;
        $pending_batch  = 0;
        if ($this->db->table_exists('cancellation_requests')) {
            $pending_cancel = $this->db->where('status', 'pending')->count_all_results('cancellation_requests');
        }
        if ($this->db->table_exists('batch_change_requests')) {
            $pending_batch = $this->db->where('status', 'pending')->count_all_results('batch_change_requests');
        }

        return array(
            'total'          => $total,
            'logged_today'   => $today,
            'logged_week'    => $week,
            'cancel_pending' => $pending_cancel,
            'batch_pending'  => $pending_batch,
        );
    }
}
