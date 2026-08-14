<?php defined('BASEPATH') OR exit('No direct script access allowed');

$googleBusinessEnabled = filter_var(
    getenv('TRIPJYADA_GOOGLE_BUSINESS_ENABLED') ?: 'false',
    FILTER_VALIDATE_BOOLEAN
);

$config['google_business_profile'] = array(
    'enabled'       => $googleBusinessEnabled,
    'client_id'     => getenv('TRIPJYADA_GOOGLE_CLIENT_ID') ?: '',
    'client_secret' => getenv('TRIPJYADA_GOOGLE_CLIENT_SECRET') ?: '',
    'refresh_token' => getenv('TRIPJYADA_GOOGLE_REFRESH_TOKEN') ?: '',
    'account_id'    => getenv('TRIPJYADA_GOOGLE_ACCOUNT_ID') ?: '',
    'location_id'   => getenv('TRIPJYADA_GOOGLE_LOCATION_ID') ?: '',
    'cache_ttl'     => (int) (getenv('TRIPJYADA_GOOGLE_CACHE_TTL') ?: 21600),
    'max_reviews'   => (int) (getenv('TRIPJYADA_GOOGLE_MAX_REVIEWS') ?: 10),
);
