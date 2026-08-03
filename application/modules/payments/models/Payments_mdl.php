<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payments_mdl extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->dbforge();
        $this->ensure_payment_table();
        $this->ensure_booking_columns();
    }

    public function find_package($packageId = 0, $slug = '', $categorySlug = '')
    {
        if (! $this->db->table_exists('packages')) {
            return null;
        }

        if ($packageId > 0) {
            $this->db->where('p_id', $packageId);
            $this->db->where('status', 1);
            $row = $this->db->get('packages')->row_array();

            if ($row) {
                if ($slug !== '' && isset($row['slug']) && $row['slug'] !== $slug) {
                    return null;
                }
                if ($categorySlug !== '' && isset($row['category_slug']) && $row['category_slug'] !== $categorySlug) {
                    return null;
                }

                return $row;
            }
        }

        if ($slug === '') {
            return null;
        }

        $this->db->where('slug', $slug);
        if ($categorySlug !== '') {
            $this->db->where('category_slug', $categorySlug);
        }
        $this->db->where('status', 1);

        return $this->db->get('packages')->row_array();
    }

    public function normalize_price_to_rupees($price)
    {
        $digits = preg_replace('/[^\d]/', '', (string) $price);
        if ($digits === '') {
            return 0;
        }

        return (int) $digits;
    }

    public function is_payable_package(array $package)
    {
        if (!empty($package['price_on_request'])) {
            return false;
        }

        return $this->normalize_price_to_rupees(isset($package['price']) ? $package['price'] : '') > 0;
    }

    public function create_payment_order(array $package, array $customer, array $razorpayOrder, $currency = 'INR', array $booking = array())
    {
        $now          = date('Y-m-d H:i:s');
        $advanceRupees = isset($razorpayOrder['amount']) ? (int) round((int) $razorpayOrder['amount'] / 100) : 0;
        $data = array(
            'package_id'            => !empty($package['p_id']) ? (int) $package['p_id'] : null,
            'package_title'         => isset($package['title']) ? $package['title'] : '',
            'package_slug'          => isset($package['slug']) ? $package['slug'] : '',
            'package_category_slug' => isset($package['category_slug']) ? $package['category_slug'] : '',
            'customer_name'         => isset($customer['name']) ? $customer['name'] : '',
            'customer_email'        => isset($customer['email']) ? $customer['email'] : '',
            'customer_phone'        => isset($customer['phone']) ? $customer['phone'] : '',
            'amount_rupees'         => $advanceRupees,
            'amount_subunits'       => isset($razorpayOrder['amount']) ? (int) $razorpayOrder['amount'] : ($advanceRupees * 100),
            'currency'              => $currency,
            'receipt'               => isset($razorpayOrder['receipt']) ? $razorpayOrder['receipt'] : '',
            'local_status'          => 'created',
            'razorpay_order_id'     => isset($razorpayOrder['id']) ? $razorpayOrder['id'] : '',
            'api_response'          => $this->encode_json($razorpayOrder),
            'travel_date'           => !empty($booking['travel_date']) ? $booking['travel_date'] : null,
            'num_days'              => !empty($booking['num_days']) ? (int) $booking['num_days'] : 1,
            'num_adults'            => !empty($booking['num_adults']) ? (int) $booking['num_adults'] : 1,
            'num_kids'              => isset($booking['num_kids']) ? (int) $booking['num_kids'] : 0,
            'advance_percent'       => !empty($booking['advance_percent']) ? (int) $booking['advance_percent'] : 0,
            'base_amount'           => !empty($booking['base_amount']) ? (int) $booking['base_amount'] : 0,
            'sdf_amount'            => !empty($booking['sdf_amount'])   ? (int) $booking['sdf_amount']   : 0,
            'guide_amount'          => !empty($booking['guide_amount']) ? (int) $booking['guide_amount'] : 0,
            'gst_amount'            => !empty($booking['gst_amount'])   ? (int) $booking['gst_amount']   : 0,
            'total_amount'          => !empty($booking['total_amount']) ? (int) $booking['total_amount'] : 0,
            'balance_due'           => isset($booking['balance_due'])      ? (int)    $booking['balance_due']      : 0,
            'coupon_code'           => !empty($booking['coupon_code'])     ? (string) $booking['coupon_code']     : null,
            'offer_id'              => !empty($booking['offer_id'])        ? (int)    $booking['offer_id']        : null,
            'discount_percent'      => !empty($booking['discount_percent'])? (int)    $booking['discount_percent']: 0,
            'discount_amount'       => !empty($booking['discount_amount']) ? (int)    $booking['discount_amount'] : 0,
            'created_at'            => $now,
            'updated_at'            => $now,
        );

        $this->db->insert('package_payments', $data);
        if ($this->db->affected_rows() < 1) {
            $dbError = $this->db->error();
            log_message('error', 'Package payment insert failed: ' . (!empty($dbError['message']) ? $dbError['message'] : 'unknown error'));
            return 0;
        }

        return $this->db->insert_id();
    }

    public function find_valid_coupon($code, $packageId = 0)
    {
        if (!$this->db->table_exists('offers')) return null;

        $today = date('Y-m-d');
        $row   = $this->db->query(
            "SELECT * FROM `offers` WHERE UPPER(`code`) = UPPER(?) AND `discount_percent` > 0 AND (`end_date` IS NULL OR `end_date` >= ?) LIMIT 1",
            array($code, $today)
        )->row_array();

        if (!$row) return null;

        // If coupon is restricted to specific packages, check the requested package is in the list
        if (!empty($row['package_ids'])) {
            $allowed = array_map('intval', array_filter(explode(',', $row['package_ids'])));
            if (!empty($allowed) && $packageId > 0 && !in_array((int) $packageId, $allowed, true)) {
                return null;
            }
        }

        return $row;
    }

    public function find_by_order_id($razorpayOrderId)
    {
        return $this->db
            ->where('razorpay_order_id', $razorpayOrderId)
            ->get('package_payments')
            ->row_array();
    }

    public function update_payment($id, array $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', (int) $id);
        return $this->db->update('package_payments', $data);
    }

    public function generate_receipt($packageId = 0)
    {
        $prefix = $packageId > 0 ? 'pkg' . $packageId : 'pkg';
        $seed = $prefix . '-' . date('ymdHis') . '-' . substr(md5(uniqid((string) mt_rand(), true)), 0, 10);
        return substr($seed, 0, 40);
    }

    private function ensure_booking_columns()
    {
        if (!$this->db->table_exists('package_payments')) {
            return;
        }

        $newCols = array(
            'travel_date'     => "ALTER TABLE `package_payments` ADD COLUMN `travel_date` DATE NULL AFTER `updated_at`",
            'num_days'        => "ALTER TABLE `package_payments` ADD COLUMN `num_days` TINYINT(3) UNSIGNED NOT NULL DEFAULT 1 AFTER `travel_date`",
            'num_adults'      => "ALTER TABLE `package_payments` ADD COLUMN `num_adults` TINYINT(3) UNSIGNED NOT NULL DEFAULT 1 AFTER `num_days`",
            'num_kids'        => "ALTER TABLE `package_payments` ADD COLUMN `num_kids` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0 AFTER `num_adults`",
            'advance_percent' => "ALTER TABLE `package_payments` ADD COLUMN `advance_percent` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0 AFTER `num_kids`",
            'base_amount'     => "ALTER TABLE `package_payments` ADD COLUMN `base_amount` INT(11) UNSIGNED NOT NULL DEFAULT 0 AFTER `advance_percent`",
            'sdf_amount'      => "ALTER TABLE `package_payments` ADD COLUMN `sdf_amount` INT(11) UNSIGNED NOT NULL DEFAULT 0 AFTER `base_amount`",
            'guide_amount'    => "ALTER TABLE `package_payments` ADD COLUMN `guide_amount` INT(11) UNSIGNED NOT NULL DEFAULT 0 AFTER `sdf_amount`",
            'gst_amount'      => "ALTER TABLE `package_payments` ADD COLUMN `gst_amount` INT(11) UNSIGNED NOT NULL DEFAULT 0 AFTER `guide_amount`",
            'total_amount'    => "ALTER TABLE `package_payments` ADD COLUMN `total_amount` INT(11) UNSIGNED NOT NULL DEFAULT 0 AFTER `gst_amount`",
            'balance_due'      => "ALTER TABLE `package_payments` ADD COLUMN `balance_due` INT(11) UNSIGNED NOT NULL DEFAULT 0 AFTER `total_amount`",
            'coupon_code'      => "ALTER TABLE `package_payments` ADD COLUMN `coupon_code` VARCHAR(50) NULL AFTER `balance_due`",
            'offer_id'         => "ALTER TABLE `package_payments` ADD COLUMN `offer_id` INT(11) NULL AFTER `coupon_code`",
            'discount_percent' => "ALTER TABLE `package_payments` ADD COLUMN `discount_percent` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0 AFTER `offer_id`",
            'discount_amount'  => "ALTER TABLE `package_payments` ADD COLUMN `discount_amount` INT(11) UNSIGNED NOT NULL DEFAULT 0 AFTER `discount_percent`",
        );

        foreach ($newCols as $col => $sql) {
            if (!$this->db->field_exists($col, 'package_payments')) {
                $this->db->query($sql);
            }
        }
    }

    private function ensure_payment_table()
    {
        if ($this->db->table_exists('package_payments')) {
            return;
        }

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'package_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ),
            'package_title' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'package_slug' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ),
            'package_category_slug' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ),
            'customer_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 150,
            ),
            'customer_email' => array(
                'type' => 'VARCHAR',
                'constraint' => 150,
            ),
            'customer_phone' => array(
                'type' => 'VARCHAR',
                'constraint' => 30,
            ),
            'amount_rupees' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'default' => 0,
            ),
            'amount_subunits' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'default' => 0,
            ),
            'currency' => array(
                'type' => 'VARCHAR',
                'constraint' => 10,
                'default' => 'INR',
            ),
            'receipt' => array(
                'type' => 'VARCHAR',
                'constraint' => 40,
            ),
            'local_status' => array(
                'type' => 'VARCHAR',
                'constraint' => 30,
                'default' => 'created',
            ),
            'razorpay_order_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 40,
            ),
            'razorpay_payment_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 40,
                'null' => true,
            ),
            'razorpay_signature' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ),
            'gateway_status' => array(
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
            ),
            'payment_method' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ),
            'captured' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ),
            'api_response' => array(
                'type' => 'MEDIUMTEXT',
                'null' => true,
            ),
            'verified_at' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),
            'created_at' => array(
                'type' => 'DATETIME',
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
            ),
        ));

        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('package_payments', true);
    }

    private function encode_json($value)
    {
        $json = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return $json !== false ? $json : null;
    }
}
