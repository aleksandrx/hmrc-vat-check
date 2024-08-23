<?php

return [

    /*
    |--------------------------------------------------------------------------
    | HMRC API Configuration
    |--------------------------------------------------------------------------
    |
    | The following configuration values are used to connect to the HMRC API.
    | Make sure to set the environment variables in your .env file.
    |
    */

    'client_id' => env('HMRC_CLIENT_ID', 'your-client-id'),
    'client_secret' => env('HMRC_CLIENT_SECRET', 'your-client-secret'),
    'oauth2_url' => env('HMRC_OAUTH2_URL', 'https://test-api.service.hmrc.gov.uk/oauth/token'),
    'grant_type' => env('HMRC_GRANT_TYPE', 'client_credentials'),
    'scope' => env('HMRC_SCOPE', 'read:vat'),
    'check_vat_number_url' => env('HMRC_CHECK_VAT_NUMBER_ENDPOINT', 'https://test-api.service.hmrc.gov.uk/organisations/vat/check-vat-number/lookup'),
];
