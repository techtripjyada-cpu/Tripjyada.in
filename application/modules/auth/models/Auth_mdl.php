<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_mdl extends CI_Model
{
    private $cfg = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->config('tripjyada_whatsapp');
        $this->cfg = (array) $this->config->item('tripjyada_whatsapp');
        $this->_ensure_tables();
    }

    private function _ensure_tables()
    {
        if (!$this->db->table_exists('users')) {
            $this->db->query("CREATE TABLE `users` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `phone` VARCHAR(15) NOT NULL,
                `name` VARCHAR(120) NULL DEFAULT NULL,
                `email` VARCHAR(150) NULL DEFAULT NULL,
                `gender` VARCHAR(10) NULL DEFAULT NULL,
                `dob` DATE NULL DEFAULT NULL,
                `instagram` VARCHAR(100) NULL DEFAULT NULL,
                `hometown` VARCHAR(100) NULL DEFAULT NULL,
                `current_town` VARCHAR(100) NULL DEFAULT NULL,
                `address` TEXT NULL DEFAULT NULL,
                `about` TEXT NULL DEFAULT NULL,
                `profile_pic` VARCHAR(255) NULL DEFAULT NULL,
                `id_proof` VARCHAR(255) NULL DEFAULT NULL,
                `last_login_at` DATETIME NULL DEFAULT NULL,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE KEY `uniq_phone` (`phone`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        } else {
            if (!$this->db->field_exists('last_login_at', 'users')) {
                $this->db->query("ALTER TABLE `users` ADD `last_login_at` DATETIME NULL DEFAULT NULL");
            }
        }

        if (!$this->db->table_exists('user_otp')) {
            $this->db->query("CREATE TABLE `user_otp` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `phone` VARCHAR(15) NOT NULL,
                `otp` VARCHAR(10) NOT NULL,
                `expires_at` DATETIME NOT NULL,
                `verified` TINYINT(1) NOT NULL DEFAULT 0,
                `attempts` TINYINT(3) NOT NULL DEFAULT 0,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                KEY `idx_phone` (`phone`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        }

        if (!$this->db->table_exists('cancellation_requests')) {
            $this->db->query("CREATE TABLE `cancellation_requests` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `user_id` INT(11) NOT NULL,
                `payment_id` INT(11) NULL DEFAULT NULL,
                `booking_ref` VARCHAR(100) NULL DEFAULT NULL,
                `reason` TEXT NOT NULL,
                `status` ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
                `admin_note` TEXT NULL DEFAULT NULL,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        }

        if (!$this->db->table_exists('batch_change_requests')) {
            $this->db->query("CREATE TABLE `batch_change_requests` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `user_id` INT(11) NOT NULL,
                `payment_id` INT(11) NULL DEFAULT NULL,
                `booking_ref` VARCHAR(100) NULL DEFAULT NULL,
                `current_batch` VARCHAR(100) NULL DEFAULT NULL,
                `requested_batch` VARCHAR(100) NULL DEFAULT NULL,
                `reason` TEXT NULL DEFAULT NULL,
                `status` ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
                `admin_note` TEXT NULL DEFAULT NULL,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        }
    }

    /* ── OTP ── */

    public function can_send_otp($phone)
    {
        $cooldown = isset($this->cfg['cooldown']) ? (int) $this->cfg['cooldown'] : 60;
        $row = $this->db
            ->where('phone', $phone)
            ->where('created_at >=', date('Y-m-d H:i:s', time() - $cooldown))
            ->order_by('id', 'desc')
            ->limit(1)
            ->get('user_otp')->row_array();
        return empty($row);
    }

    public function create_and_send_otp($phone)
    {
        $len = isset($this->cfg['otp_length']) ? (int) $this->cfg['otp_length'] : 6;
        $exp = isset($this->cfg['otp_expiry']) ? (int) $this->cfg['otp_expiry'] : 10;

        $otp        = str_pad((string) random_int(0, pow(10, $len) - 1), $len, '0', STR_PAD_LEFT);
        $expires_at = date('Y-m-d H:i:s', time() + $exp * 60);
        $now        = date('Y-m-d H:i:s');

        // Invalidate old OTPs for this phone
        $this->db->where('phone', $phone)->where('verified', 0)->update('user_otp', array('verified' => 2));

        $this->db->insert('user_otp', array(
            'phone'      => $phone,
            'otp'        => $otp,
            'expires_at' => $expires_at,
            'verified'   => 0,
            'attempts'   => 0,
            'created_at' => $now,
        ));

        $sent = $this->_send_whatsapp_otp($phone, $otp);
        // Return OTP in test mode so it can be surfaced in the UI for development
        if ($sent && (isset($this->cfg['provider']) && $this->cfg['provider'] === 'test')) {
            return array('ok' => true, 'test_otp' => $otp);
        }
        return $sent ? array('ok' => true) : false;
    }

    public function verify_otp($phone, $otp)
    {
        $max = isset($this->cfg['max_attempts']) ? (int) $this->cfg['max_attempts'] : 3;
        $now = date('Y-m-d H:i:s');

        $row = $this->db
            ->where('phone', $phone)
            ->where('verified', 0)
            ->where('expires_at >=', $now)
            ->where('attempts <', $max)
            ->order_by('id', 'desc')
            ->limit(1)
            ->get('user_otp')->row_array();

        if (!$row) {
            return array('ok' => false, 'message' => 'OTP expired or not found. Please request a new one.');
        }

        $this->db->where('id', $row['id'])->update('user_otp', array('attempts' => (int) $row['attempts'] + 1));

        if ($row['otp'] !== (string) $otp) {
            $left = $max - (int) $row['attempts'] - 1;
            if ($left <= 0) {
                return array('ok' => false, 'message' => 'Too many wrong attempts. Please request a new OTP.');
            }
            return array('ok' => false, 'message' => 'Incorrect OTP. ' . $left . ' attempt(s) left.');
        }

        $this->db->where('id', $row['id'])->update('user_otp', array('verified' => 1));
        return array('ok' => true);
    }

    /* ── User find/create ── */

    public function find_or_create_user($phone)
    {
        $now  = date('Y-m-d H:i:s');
        $user = $this->db->where('phone', $phone)->get('users')->row_array();
        if (!$user) {
            $this->db->insert('users', array(
                'phone'         => $phone,
                'last_login_at' => $now,
                'created_at'    => $now,
            ));
            $user = $this->db->where('id', $this->db->insert_id())->get('users')->row_array();
        } else {
            $this->db->where('id', $user['id'])->update('users', array('last_login_at' => $now));
        }
        return $user;
    }

    /* ── WhatsApp send ── */

    private function _send_whatsapp_otp($phone, $otp)
    {
        $provider = isset($this->cfg['provider']) ? $this->cfg['provider'] : 'test';

        if ($provider === 'test') {
            log_message('info', '[WhatsApp OTP TEST] Phone: ' . $phone . ' | OTP: ' . $otp);
            return true;
        }

        if ($provider === 'fast2sms') {
            return $this->_send_fast2sms($phone, $otp);
        }

        if ($provider === 'msg91') {
            return $this->_send_msg91($phone, $otp);
        }

        if ($provider === 'meta') {
            return $this->_send_meta($phone, $otp);
        }

        return false;
    }

    private function _send_fast2sms($phone, $otp)
    {
        $key    = isset($this->cfg['fast2sms_key']) ? $this->cfg['fast2sms_key'] : '';
        $expiry = isset($this->cfg['otp_expiry'])   ? (int) $this->cfg['otp_expiry'] : 10;

        if (!$key) {
            log_message('error', '[Fast2SMS OTP] fast2sms_key not configured.');
            return false;
        }

        $message = 'Your Tripjyada OTP is ' . $otp . '. Valid for ' . $expiry . ' minutes. Do not share with anyone.';

        $payload = json_encode(array(
            'route'    => 'q',
            'message'  => $message,
            'language' => 'english',
            'flash'    => 0,
            'numbers'  => $phone,
        ));

        $ch = curl_init('https://www.fast2sms.com/dev/bulkV2');
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => array(
                'authorization: ' . $key,
                'Content-Type: application/json',
            ),
            CURLOPT_TIMEOUT        => 15,
        ));
        $resp = curl_exec($ch);
        $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code >= 400) {
            log_message('error', '[Fast2SMS OTP] Failed. HTTP ' . $code . ' | ' . $resp);
            return false;
        }

        $data = json_decode($resp, true);
        if (isset($data['return']) && $data['return'] === false) {
            log_message('error', '[Fast2SMS OTP] API error: ' . $resp);
            return false;
        }

        log_message('info', '[Fast2SMS OTP] Sent to ' . $phone);
        return true;
    }

    private function _send_msg91($phone, $otp)
    {
        $authkey     = $this->cfg['authkey'] ?? '';
        $templateId  = $this->cfg['template_id'] ?? '';
        $expiry      = $this->cfg['otp_expiry'] ?? 10;

        if (!$authkey || !$templateId) {
            log_message('error', '[MSG91 OTP] authkey or template_id not configured.');
            return false;
        }

        $mobile = '91' . ltrim($phone, '+');

        $url = 'https://api.msg91.com/api/v5/otp'
            . '?otp_expiry=' . $expiry
            . '&template_id=' . urlencode($templateId)
            . '&mobile=' . urlencode($mobile)
            . '&authkey=' . urlencode($authkey)
            . '&otp_length=6'
            . '&type=whatsapp'
            . '&otp=' . $otp;

        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 15,
        ));
        $resp = curl_exec($ch);
        $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code >= 400) {
            log_message('error', '[MSG91 OTP] Failed. Response: ' . $resp);
            return false;
        }
        return true;
    }

    private function _send_meta($phone, $otp)
    {
        $token   = $this->cfg['meta_token'] ?? '';
        $phoneId = $this->cfg['meta_phone_id'] ?? '';
        $tpl     = $this->cfg['meta_template'] ?? 'otp_verification';

        if (!$token || !$phoneId) {
            log_message('error', '[Meta WhatsApp OTP] token or phone_id not configured.');
            return false;
        }

        $to = '91' . ltrim($phone, '+');

        $payload = json_encode(array(
            'messaging_product' => 'whatsapp',
            'to'                => $to,
            'type'              => 'template',
            'template'          => array(
                'name'     => $tpl,
                'language' => array('code' => 'en'),
                'components' => array(array(
                    'type'       => 'body',
                    'parameters' => array(array('type' => 'text', 'text' => $otp)),
                )),
            ),
        ));

        $url = 'https://graph.facebook.com/v19.0/' . $phoneId . '/messages';
        $ch  = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token,
            ),
            CURLOPT_TIMEOUT        => 15,
        ));
        $resp = curl_exec($ch);
        $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code >= 400) {
            log_message('error', '[Meta WhatsApp OTP] Failed. Response: ' . $resp);
            return false;
        }
        return true;
    }
}
