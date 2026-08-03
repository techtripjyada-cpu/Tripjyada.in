<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_payments extends CI_Model
{
    private $table = 'package_payments';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_transactions($search = '', $dateFrom = '', $dateTo = '')
    {
        if (!$this->db->table_exists($this->table)) {
            return array();
        }

        $this->db->select('id, package_id, package_title, customer_name, customer_email, customer_phone,
            travel_date, num_days, num_adults, num_kids, advance_percent,
            base_amount, sdf_amount, gst_amount, total_amount, amount_rupees, balance_due,
            local_status, razorpay_payment_id, payment_method, captured, verified_at, created_at');
        $this->db->from($this->table);
        $this->db->where_in('local_status', array('paid', 'captured'));
        $this->db->where('captured', 1);

        if (!empty($search)) {
            $s = $this->db->escape_like_str($search);
            $this->db->group_start();
            $this->db->like('customer_name', $s, 'both');
            $this->db->or_like('customer_email', $s, 'both');
            $this->db->or_like('customer_phone', $s, 'both');
            $this->db->or_like('package_title', $s, 'both');
            $this->db->or_like('razorpay_payment_id', $s, 'both');
            $this->db->group_end();
        }

        if (!empty($dateFrom)) {
            $this->db->where('DATE(created_at) >=', $dateFrom);
        }
        if (!empty($dateTo)) {
            $this->db->where('DATE(created_at) <=', $dateTo);
        }

        $this->db->order_by('id', 'DESC');

        return $this->db->get()->result_array();
    }
}
