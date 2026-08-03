<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Google Business Profile Reviews
| -------------------------------------------------------------------
|
| Fill these values with the credentials from your Google Cloud project
| and Business Profile account. The homepage testimonial section will
| gracefully fall back to static reviews until these are configured.
|
*/
$config['google_business_profile'] = array(
    'enabled' => false,
    'client_id' => '',
    'client_secret' => '',
    'refresh_token' => '',
    'account_id' => '',
    'location_id' => '',
    'cache_ttl' => 21600,
    'max_reviews' => 10,
);
