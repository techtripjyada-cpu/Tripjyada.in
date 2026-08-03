<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 * WhatsApp OTP Configuration
 *
 * provider:
 *   'msg91'  — MSG91 WhatsApp OTP API (popular in India, signup at msg91.com)
 *   'meta'   — Meta WhatsApp Cloud API (requires Meta Business account)
 *   'test'   — Development mode: OTP is NOT sent, just logged to CI log file
 *
 * Setup (MSG91):
 *   1. Sign up at msg91.com → get authkey
 *   2. Create a WhatsApp OTP template → get template_id
 *   3. Set provider = 'msg91', fill authkey + template_id below
 *   4. Set test_mode = false in production
 */
$config['tripjyada_whatsapp'] = array(
    'provider'    => 'fast2sms',    // 'fast2sms' | 'msg91' | 'meta' | 'test'
    'authkey'     => '543665Af1UkE396a3a174dP1', // MSG91 auth key
    'template_id' => '',            // MSG91 WhatsApp OTP template ID — fill this after WhatsApp setup
    'otp_length'  => 6,
    'otp_expiry'  => 10,            // minutes before OTP expires
    'max_attempts'=> 3,             // wrong OTP attempts before lockout
    'cooldown'    => 60,            // seconds before user can request another OTP
    // Fast2SMS (if provider = 'fast2sms')
    'fast2sms_key' => 'jUZ8cwNMh31qIH7ufPCDKaBp4WYkJOSXs2GizFy9bLlQod5xRgg8qrCx6mDaBUFsXnwcE4Qho5NtKTlO',
    // Meta WhatsApp Cloud API (if provider = 'meta')
    'meta_token'       => '',       // Meta permanent access token
    'meta_phone_id'    => '',       // WhatsApp Business phone number ID
    'meta_template'    => 'otp_verification', // template name in Meta
);
