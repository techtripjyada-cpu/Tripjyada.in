<?php defined('BASEPATH') or exit('No direct script access allowed');

$supportEmail = getenv('TRIPJYADA_SUPPORT_EMAIL') ?: 'info@tripjyada.com';
$sendBookingAutoReply = getenv('TRIPJYADA_SEND_BOOKING_AUTO_REPLY');
$sendContactAutoReply = getenv('TRIPJYADA_SEND_CONTACT_AUTO_REPLY');
$publicContactEmailsRaw = getenv('TRIPJYADA_PUBLIC_CONTACT_EMAILS') ?: 'info@tripjyada.com';
$publicContactEmails = array_values(array_filter(array_map('trim', explode(',', $publicContactEmailsRaw))));

$config['tripjyada_mail'] = array(
    'support_email'                 => $supportEmail,
    'reply_to_email'                => getenv('TRIPJYADA_REPLY_TO_EMAIL') ?: $supportEmail,
    'booking_notification_email'    => getenv('TRIPJYADA_BOOKING_NOTIFICATION_EMAIL') ?: $supportEmail,
    'contact_notification_email'    => getenv('TRIPJYADA_CONTACT_NOTIFICATION_EMAIL') ?: $supportEmail,
    'faq_notification_email'        => getenv('TRIPJYADA_FAQ_NOTIFICATION_EMAIL') ?: $supportEmail,
    'newsletter_notification_email' => getenv('TRIPJYADA_NEWSLETTER_NOTIFICATION_EMAIL') ?: $supportEmail,
    'slider_notification_email'     => getenv('TRIPJYADA_SLIDER_NOTIFICATION_EMAIL') ?: $supportEmail,
    'company_name'                  => getenv('TRIPJYADA_COMPANY_NAME') ?: 'Tripjyada',
    'company_domain'                => getenv('TRIPJYADA_COMPANY_DOMAIN') ?: 'tripjyada.in',
    'phone'                         => getenv('TRIPJYADA_SUPPORT_PHONE') ?: '+91-9558515518',
    'phone_html'                    => getenv('TRIPJYADA_SUPPORT_PHONE_HTML') ?: 'tel:+919558515518',
    'public_contact_emails'         => ! empty($publicContactEmails) ? $publicContactEmails : array($supportEmail),
    'mail_test_token'               => getenv('TRIPJYADA_MAIL_TEST_TOKEN') ?: 'tripjyada-mail-test-2026',
    'mail_test_default_recipient'   => getenv('TRIPJYADA_MAIL_TEST_DEFAULT_RECIPIENT') ?: $supportEmail,
    'send_booking_auto_reply'       => $sendBookingAutoReply === false
        ? true
        : filter_var($sendBookingAutoReply, FILTER_VALIDATE_BOOLEAN),
    'send_contact_auto_reply'       => $sendContactAutoReply === false
        ? true
        : filter_var($sendContactAutoReply, FILTER_VALIDATE_BOOLEAN),
);
