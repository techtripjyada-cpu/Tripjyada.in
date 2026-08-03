<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Instagram Feed
| -------------------------------------------------------------------
|
| To enable live Instagram posts on the homepage:
|
| 1. Convert your Instagram account to a Business or Creator account
|    (Settings → Account → Switch to Professional Account).
|
| 2. Go to https://developers.facebook.com and create a new App
|    (Type: "Business", then add the "Instagram Graph API" product).
|
| 3. Under Instagram Graph API → User Token Generator, connect your
|    Instagram account and generate a short-lived token.
|
| 4. Exchange it for a long-lived token (valid 60 days) by visiting:
|    https://graph.instagram.com/access_token
|      ?grant_type=ig_exchange_token
|      &client_id={APP_ID}
|      &client_secret={APP_SECRET}
|      &access_token={SHORT_LIVED_TOKEN}
|
| 5. Paste the long-lived token into 'access_token' below and set
|    'enabled' to true.
|
| The library automatically refreshes the token before it expires
| and stores the refreshed token in application/cache/.
|
*/
$config['instagram'] = array(
    'enabled'      => true,
    'access_token' => getenv('INSTAGRAM_ACCESS_TOKEN') ?: '',
    'limit'        => 10,   // Number of posts to show
    'cache_ttl'    => 3600, // How long to cache the feed in seconds (1 hour)
);
