<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 * WhatsApp/SMS OTP credentials must be supplied through the server .env file.
 * The safe default is test mode, which never sends a real message.
 */
$config['tripjyada_whatsapp'] = array(
    'provider'         => getenv('TRIPJYADA_WHATSAPP_PROVIDER') ?: 'test',
    'authkey'          => getenv('TRIPJYADA_MSG91_AUTH_KEY') ?: '',
    'template_id'      => getenv('TRIPJYADA_MSG91_TEMPLATE_ID') ?: '',
    'otp_length'       => (int) (getenv('TRIPJYADA_OTP_LENGTH') ?: 6),
    'otp_expiry'       => (int) (getenv('TRIPJYADA_OTP_EXPIRY') ?: 10),
    'max_attempts'     => (int) (getenv('TRIPJYADA_OTP_MAX_ATTEMPTS') ?: 3),
    'cooldown'         => (int) (getenv('TRIPJYADA_OTP_COOLDOWN') ?: 60),
    'fast2sms_key'     => getenv('TRIPJYADA_FAST2SMS_API_KEY') ?: '',
    'meta_token'       => getenv('TRIPJYADA_META_WHATSAPP_TOKEN') ?: '',
    'meta_phone_id'    => getenv('TRIPJYADA_META_WHATSAPP_PHONE_ID') ?: '',
    'meta_template'    => getenv('TRIPJYADA_META_WHATSAPP_TEMPLATE') ?: 'otp_verification',
);
