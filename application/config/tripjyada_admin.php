<?php defined('BASEPATH') or exit('No direct script access allowed');

$config['tripjyada_admin'] = array(
    'password_hash'   => trim((string) getenv('TRIPJYADA_ADMIN_PASSWORD_HASH')),
    'password'        => trim((string) getenv('TRIPJYADA_ADMIN_PASSWORD')),
    'session_expiry'  => (int) (getenv('TRIPJYADA_ADMIN_SESSION_EXPIRY') ?: 7200),
);
