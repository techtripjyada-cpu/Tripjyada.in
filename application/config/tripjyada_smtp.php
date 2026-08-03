<?php defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| TripJyada SMTP Configuration
|--------------------------------------------------------------------------
|
| Set these values with environment variables when possible. If your hosting
| panel doesn't support env vars, you can edit the fallback values directly.
|
| Google Workspace examples:
| - SMTP host: smtp.gmail.com
| - Port: 587
| - Crypto: tls
| - User: your full Google Workspace email address
| - Pass: app password (or relay-specific credential)
|
*/

$config['tripjyada_smtp'] = array(
    'protocol'     => getenv('TRIPJYADA_SMTP_PROTOCOL') ?: 'smtp',
    'smtp_host'    => getenv('TRIPJYADA_SMTP_HOST') ?: 'smtp.gmail.com',
    'smtp_port'    => (int) (getenv('TRIPJYADA_SMTP_PORT') ?: 587),
    'smtp_user'    => getenv('TRIPJYADA_SMTP_USER') ?: 'info@tripjyada.com',
    'smtp_pass'    => getenv('TRIPJYADA_SMTP_PASS') ?: 'D@m@Inf@652#tjK',
    'smtp_crypto'  => getenv('TRIPJYADA_SMTP_CRYPTO') ?: 'tls',
    'smtp_timeout' => (int) (getenv('TRIPJYADA_SMTP_TIMEOUT') ?: 15),
    'mailtype'     => 'html',
    'charset'      => 'utf-8',
    'wordwrap'     => true,
    'newline'      => "\r\n",
    'crlf'         => "\r\n",
);
