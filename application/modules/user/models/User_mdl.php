<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_mdl extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->_migrate_phone_formats();
    }

    private function _migrate_phone_formats()
    {
        if (!$this->db->table_exists('package_payments')) return;
        // Fetch rows where phone isn't already a clean 10-digit number
        $rows = $this->db->query(
            "SELECT id, customer_phone FROM package_payments WHERE customer_phone NOT REGEXP '^[0-9]{10}$' LIMIT 500"
        )->result_array();
        foreach ($rows as $row) {
            $normalized = $this->_normalise_phone($row['customer_phone']);
            if ($normalized && $normalized !== $row['customer_phone']) {
                $this->db->where('id', $row['id'])->update('package_payments', array('customer_phone' => $normalized));
            }
        }
    }

    /* ── User profile ── */

    public function get_user($id)
    {
        return $this->db->where('id', (int) $id)->get('users')->row_array();
    }

    public function update_profile($id, array $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', (int) $id)->update('users', $data);
    }

    /* ── Bookings: match by phone ── */

    private function _normalise_phone($phone)
    {
        $digits = preg_replace('/\D/', '', (string) $phone);
        return strlen($digits) > 10 ? substr($digits, -10) : $digits;
    }

    public function get_bookings($phone, $page = 1, $per = 10)
    {
        $phone = $this->_normalise_phone($phone);
        $this->db->where('customer_phone', $phone)
                 ->order_by('id', 'desc')
                 ->limit($per, ($page - 1) * $per);
        return $this->db->get('package_payments')->result_array();
    }

    public function count_bookings($phone)
    {
        $phone = $this->_normalise_phone($phone);
        return $this->db->where('customer_phone', $phone)->count_all_results('package_payments');
    }

    public function get_booking($id, $phone)
    {
        $phone = $this->_normalise_phone($phone);
        return $this->db->where('id', (int) $id)->where('customer_phone', $phone)
                        ->get('package_payments')->row_array();
    }

    public function get_next_trip($phone)
    {
        $phone = $this->_normalise_phone($phone);
        return $this->db->where('customer_phone', $phone)
                        ->where('travel_date >=', date('Y-m-d'))
                        ->where_in('local_status', array('paid', 'captured'))
                        ->order_by('travel_date', 'asc')
                        ->limit(1)
                        ->get('package_payments')->row_array();
    }

    public function get_bookings_with_packages($phone, $page = 1, $per = 10)
    {
        $bookings = $this->get_bookings($phone, $page, $per);
        if (empty($bookings) || !$this->db->table_exists('packages')) {
            return $bookings;
        }
        $pkg_ids = array_filter(array_unique(array_column($bookings, 'package_id')));
        if ($pkg_ids) {
            $packages = $this->db->where_in('p_id', $pkg_ids)->get('packages')->result_array();
            $pkg_map = array();
            foreach ($packages as $p) { $pkg_map[$p['p_id']] = $p; }
            foreach ($bookings as &$b) {
                $b['_package'] = (!empty($b['package_id']) && isset($pkg_map[$b['package_id']])) ? $pkg_map[$b['package_id']] : null;
            }
            unset($b);
        }
        return $bookings;
    }

    public function get_booking_with_package($id, $phone)
    {
        $b = $this->get_booking((int) $id, $phone);
        if (!$b) return null;
        if (!empty($b['package_id']) && $this->db->table_exists('packages')) {
            $pkg = $this->db->where('p_id', (int) $b['package_id'])->get('packages')->row_array();
            $b['_package'] = $pkg ?: null;
        }
        return $b;
    }

    public function get_completed_trips($phone)
    {
        $phone = $this->_normalise_phone($phone);
        return $this->db->where('customer_phone', $phone)
                        ->where('travel_date <', date('Y-m-d'))
                        ->where('travel_date IS NOT NULL', null, false)
                        ->where_in('local_status', array('paid', 'captured'))
                        ->order_by('travel_date', 'desc')
                        ->get('package_payments')->result_array();
    }

    public function count_completed_trips($phone)
    {
        $phone = $this->_normalise_phone($phone);
        return $this->db->where('customer_phone', $phone)
                        ->where('travel_date <', date('Y-m-d'))
                        ->where('travel_date IS NOT NULL', null, false)
                        ->where_in('local_status', array('paid', 'captured'))
                        ->count_all_results('package_payments');
    }

    /* ── Dashboard stats ── */

    public function get_stats($phone)
    {
        $phone = $this->_normalise_phone($phone);
        $total = $this->db->where('customer_phone', $phone)
                          ->where_in('local_status', array('paid', 'captured'))
                          ->count_all_results('package_payments');
        $completed = $this->count_completed_trips($phone);
        $next  = $this->get_next_trip($phone);
        return array('total_bookings' => $total, 'next_trip' => $next, 'completed_trips' => $completed);
    }

    /* ── Cancellation requests ── */

    public function get_cancellations($user_id)
    {
        return $this->db->where('user_id', (int) $user_id)
                        ->order_by('id', 'desc')
                        ->get('cancellation_requests')->result_array();
    }

    public function submit_cancellation($user_id, array $data)
    {
        $data['user_id']    = (int) $user_id;
        $data['status']     = 'pending';
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('cancellation_requests', $data);
        return $this->db->insert_id();
    }

    /* ── Batch change requests ── */

    public function get_batch_changes($user_id)
    {
        return $this->db->where('user_id', (int) $user_id)
                        ->order_by('id', 'desc')
                        ->get('batch_change_requests')->result_array();
    }

    public function submit_batch_change($user_id, array $data)
    {
        $data['user_id']    = (int) $user_id;
        $data['status']     = 'pending';
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('batch_change_requests', $data);
        return $this->db->insert_id();
    }
}
