<?php defined('BASEPATH') or exit('No direct script access allowed');

// Load .env file if it exists (for local XAMPP development)
$_rzp_env = FCPATH . '.env';
if (file_exists($_rzp_env)) {
    foreach (file($_rzp_env, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $_line) {
        if (strpos(trim($_line), '#') === 0 || strpos($_line, '=') === false) continue;
        list($_k, $_v) = explode('=', $_line, 2);
        if (!getenv(trim($_k))) putenv(trim($_k) . '=' . trim($_v));
    }
}

$config['tripjyada_razorpay'] = array(
    // TEST keys (rzp_test_...) — replace with rzp_live_... when going live
    'key_id'             => getenv('RZP_KEY_ID')         ?: 'rzp_test_T2d0LkH2Vby9c3',
    'key_secret'         => getenv('RZP_KEY_SECRET')     ?: 'AfiTkbRO8BT3rrwth75H8fzx',
    'webhook_secret'     => getenv('RZP_WEBHOOK_SECRET') ?: 'TripjyadaWH@2026!',
    'currency'           => 'INR',
    'company_name'       => 'Tripjyada',
    'description_prefix' => 'Trip package payment',
    'theme_color'        => '#f97316',
);
