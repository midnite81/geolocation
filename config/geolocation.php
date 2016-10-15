<?php

return [

    /*
     * Set the default API url
     */
    'api-url' => 'http://api.ipinfodb.com',

    /*
     * Set the default API version
     */
    'api-version' => 'v3',

    /*
     * City Precision url
     */
    'api-city' => 'ip-city',

    /*
     * Country Precision url
     */
    'api-country' => 'ip-country',

    /*
     * Set the auth ID from the .env file, or set it here.
     */
    'api-key' => env('GEOLOCATION_API_KEY', null),

    /*
       * How long should the request response be cached for (mins)
       */
    'cache-duration' => env('GEOLOCATION_CACHE', '1440'),


];

