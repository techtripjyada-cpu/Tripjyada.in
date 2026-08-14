<?php defined('BASEPATH') or exit('No direct script access allowed');

/* SMTP credentials belong in the root .env file, never in source control. */
$config['tripjyada_smtp'] = array(
    'protocol'     => getenv('TRIPJYADA_SMTP_PROTOCOL') ?: 'smtp',
    'smtp_host'    => getenv('TRIPJYADA_SMTP_HOST') ?: 'smtp.gmail.com',
    'smtp_port'    => (int) (getenv('TRIPJYADA_SMTP_PORT') ?: 587),
    'smtp_user'    => getenv('TRIPJYADA_SMTP_USER') ?: '',
    'smtp_pass'    => getenv('TRIPJYADA_SMTP_PASS') ?: '',
    'smtp_crypto'  => getenv('TRIPJYADA_SMTP_CRYPTO') ?: 'tls',
    'smtp_timeout' => (int) (getenv('TRIPJYADA_SMTP_TIMEOUT') ?: 15),
    'mailtype'     => 'html',
    'charset'      => 'utf-8',
    'wordwrap'     => true,
    'newline'      => "\r\n",
    'crlf'         => "\r\n",
);
