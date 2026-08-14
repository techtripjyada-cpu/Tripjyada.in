<?php defined('BASEPATH') or exit('No direct script access allowed');

$config['tripjyada_razorpay'] = array(
    'key_id'             => getenv('RZP_KEY_ID') ?: '',
    'key_secret'         => getenv('RZP_KEY_SECRET') ?: '',
    'webhook_secret'     => getenv('RZP_WEBHOOK_SECRET') ?: '',
    'currency'           => 'INR',
    'company_name'       => 'Tripjyada',
    'description_prefix' => 'Trip package payment',
    'theme_color'        => '#f97316',
);
