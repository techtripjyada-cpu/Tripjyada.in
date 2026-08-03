<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_mdl extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->dbforge();
        $this->ensure_refund_columns();
    }

    private function ensure_refund_columns()
    {
        if (!$this->db->table_exists('package_payments')) {
            return;
        }
        $extra = array(
            'refund_id'     => array('type' => 'VARCHAR', 'constraint' => 60,  'null' => true),
            'refund_amount' => array('type' => 'INT',     'constraint' => 11,  'null' => true, 'unsigned' => true),
            'refunded_at'   => array('type' => 'DATETIME','null' => true),
            'admin_note'    => array('type' => 'TEXT',    'null' => true),
        );
        foreach ($extra as $col => $def) {
            if (!$this->db->field_exists($col, 'package_payments')) {
                $this->dbforge->add_column('package_payments', array($col => $def));
            }
        }
    }

    public function get_payments($status = '', $search = '', $page = 1, $perPage = 20)
    {
        if ($status) {
            $this->db->where('local_status', $status);
        }
        if ($search) {
            $this->db->group_start();
            $this->db->like('customer_name', $search);
            $this->db->or_like('customer_email', $search);
            $this->db->or_like('customer_phone', $search);
            $this->db->or_like('package_title', $search);
            $this->db->or_like('razorpay_order_id', $search);
            $this->db->or_like('razorpay_payment_id', $search);
            $this->db->group_end();
        }
        $this->db->order_by('id', 'desc');
        $this->db->limit($perPage, ($page - 1) * $perPage);
        return $this->db->get('package_payments')->result_array();
    }

    public function count_payments($status = '', $search = '')
    {
        if ($status) {
            $this->db->where('local_status', $status);
        }
        if ($search) {
            $this->db->group_start();
            $this->db->like('customer_name', $search);
            $this->db->or_like('customer_email', $search);
            $this->db->or_like('customer_phone', $search);
            $this->db->or_like('package_title', $search);
            $this->db->or_like('razorpay_order_id', $search);
            $this->db->or_like('razorpay_payment_id', $search);
            $this->db->group_end();
        }
        return $this->db->count_all_results('package_payments');
    }

    public function get_payment($id)
    {
        return $this->db->where('id', (int) $id)->get('package_payments')->row_array();
    }

    public function update_payment($id, array $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', (int) $id)->update('package_payments', $data);
    }

    public function get_summary()
    {
        $result = array('total' => 0, 'paid' => 0, 'refunded' => 0, 'failed' => 0, 'revenue' => 0);
        if (!$this->db->table_exists('package_payments')) {
            return $result;
        }
        $rows = $this->db->select('local_status, COUNT(*) as cnt, SUM(amount_rupees) as total_amount', false)
                         ->group_by('local_status')
                         ->get('package_payments')->result_array();
        foreach ($rows as $row) {
            $result['total'] += (int) $row['cnt'];
            if (in_array($row['local_status'], array('paid', 'captured'), true)) {
                $result['paid'] += (int) $row['cnt'];
                $result['revenue'] += (int) $row['total_amount'];
            } elseif ($row['local_status'] === 'refunded') {
                $result['refunded'] += (int) $row['cnt'];
            } elseif ($row['local_status'] === 'failed') {
                $result['failed'] += (int) $row['cnt'];
            }
        }
        return $result;
    }

    /* ── Users ── */

    public function get_users($search = '', $page = 1, $per = 20)
    {
        if ($search) {
            $this->db->group_start();
            $this->db->like('phone', $search);
            $this->db->or_like('name', $search);
            $this->db->or_like('email', $search);
            $this->db->group_end();
        }
        $this->db->order_by('id', 'desc')->limit($per, ($page - 1) * $per);
        return $this->db->get('users')->result_array();
    }

    public function count_users($search = '')
    {
        if ($search) {
            $this->db->group_start();
            $this->db->like('phone', $search);
            $this->db->or_like('name', $search);
            $this->db->or_like('email', $search);
            $this->db->group_end();
        }
        return $this->db->count_all_results('users');
    }

    public function get_user($id)
    {
        return $this->db->where('id', (int) $id)->get('users')->row_array();
    }

    public function get_user_bookings($phone)
    {
        return $this->db->where('customer_phone', $phone)->order_by('id', 'desc')->get('package_payments')->result_array();
    }

    /* ── Cancellations ── */

    public function get_cancellations($status = '', $page = 1, $per = 20)
    {
        $this->db->select('cr.*, u.name as user_name, u.phone as user_phone', false);
        $this->db->from('cancellation_requests cr');
        $this->db->join('users u', 'u.id = cr.user_id', 'left');
        if ($status) $this->db->where('cr.status', $status);
        $this->db->order_by('cr.id', 'desc')->limit($per, ($page - 1) * $per);
        return $this->db->get()->result_array();
    }

    public function count_cancellations($status = '')
    {
        $this->db->from('cancellation_requests');
        if ($status) $this->db->where('status', $status);
        return $this->db->count_all_results();
    }

    public function update_cancellation($id, array $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', (int) $id)->update('cancellation_requests', $data);
    }

    /* ── Batch changes ── */

    public function get_batch_changes($status = '', $page = 1, $per = 20)
    {
        $this->db->select('bcr.*, u.name as user_name, u.phone as user_phone', false);
        $this->db->from('batch_change_requests bcr');
        $this->db->join('users u', 'u.id = bcr.user_id', 'left');
        if ($status) $this->db->where('bcr.status', $status);
        $this->db->order_by('bcr.id', 'desc')->limit($per, ($page - 1) * $per);
        return $this->db->get()->result_array();
    }

    public function count_batch_changes($status = '')
    {
        $this->db->from('batch_change_requests');
        if ($status) $this->db->where('status', $status);
        return $this->db->count_all_results();
    }

    public function update_batch_change($id, array $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', (int) $id)->update('batch_change_requests', $data);
    }

    public function get_admin_stats()
    {
        $users       = $this->db->count_all('users');
        $cancel_pend = $this->db->where('status', 'pending')->count_all_results('cancellation_requests');
        $batch_pend  = $this->db->where('status', 'pending')->count_all_results('batch_change_requests');
        return array('users' => $users, 'cancel_pending' => $cancel_pend, 'batch_pending' => $batch_pend);
    }

    /* ── Cardpage ── */

    public function ensure_cardpage_tables()
    {
        if (!$this->db->table_exists('cardpage_tabs')) {
            $this->db->query("CREATE TABLE `cardpage_tabs` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `page_slug` VARCHAR(100) NOT NULL DEFAULT 'all',
                `days_label` VARCHAR(50) NOT NULL DEFAULT '',
                `tab_title` VARCHAR(200) NOT NULL DEFAULT '',
                `hero_image` VARCHAR(255) NULL DEFAULT NULL,
                `itinerary_heading` VARCHAR(200) NULL DEFAULT NULL,
                `itinerary_subheading` VARCHAR(200) NULL DEFAULT NULL,
                `day_data` TEXT NULL DEFAULT NULL,
                `sort_order` INT(11) NOT NULL DEFAULT 0,
                `active` TINYINT(1) NOT NULL DEFAULT 1,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                KEY `idx_page_slug` (`page_slug`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        }
        if (!$this->db->table_exists('cardpage_desc')) {
            $this->db->query("CREATE TABLE `cardpage_desc` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `page_slug` VARCHAR(100) NOT NULL DEFAULT 'all',
                `heading` VARCHAR(200) NULL DEFAULT NULL,
                `body` TEXT NULL DEFAULT NULL,
                `active` TINYINT(1) NOT NULL DEFAULT 1,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE KEY `uniq_page_slug` (`page_slug`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        }
    }

    public function get_cardpage_tabs($page_slug = 'all')
    {
        $this->ensure_cardpage_tables();
        return $this->db->where('page_slug', $page_slug)
            ->order_by('sort_order', 'asc')->order_by('id', 'asc')
            ->get('cardpage_tabs')->result_array();
    }

    public function get_cardpage_tab($id)
    {
        $this->ensure_cardpage_tables();
        return $this->db->where('id', (int) $id)->get('cardpage_tabs')->row_array();
    }

    public function save_cardpage_tab(array $data, $id = 0)
    {
        $this->ensure_cardpage_tables();
        if ($id) {
            $this->db->where('id', (int) $id)->update('cardpage_tabs', $data);
            return (int) $id;
        }
        $this->db->insert('cardpage_tabs', $data);
        return (int) $this->db->insert_id();
    }

    public function delete_cardpage_tab($id)
    {
        $this->ensure_cardpage_tables();
        $this->db->where('id', (int) $id)->delete('cardpage_tabs');
    }

    public function get_cardpage_desc($page_slug = 'all')
    {
        $this->ensure_cardpage_tables();
        return $this->db->where('page_slug', $page_slug)->get('cardpage_desc')->row_array();
    }

    public function save_cardpage_desc($page_slug, array $data)
    {
        $this->ensure_cardpage_tables();
        $existing = $this->get_cardpage_desc($page_slug);
        if ($existing) {
            $this->db->where('page_slug', $page_slug)->update('cardpage_desc', $data);
        } else {
            $data['page_slug'] = $page_slug;
            $this->db->insert('cardpage_desc', $data);
        }
    }
}
