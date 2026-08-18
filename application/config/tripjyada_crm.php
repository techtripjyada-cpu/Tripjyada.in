<?php defined('BASEPATH') or exit('No direct script access allowed');

/* Third-party lead CRM. Endpoints belong in the root .env file, never in source control. */
$config['tripjyada_crm'] = array(
    'lead_api_bhutan'  => getenv('TRIPJYADA_CRM_LEAD_API_BHUTAN') ?: '',
    'lead_api_std'     => getenv('TRIPJYADA_CRM_LEAD_API_STD') ?: '',
    'lead_api_timeout' => (int) (getenv('TRIPJYADA_CRM_LEAD_API_TIMEOUT') ?: 8),
);
