<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Caching (in seconds)
    |--------------------------------------------------------------------------
    |
    | Responses can be cached for a specified duration which will limit hammering
    | the api for the same IP lookup. You will need to ensure that you don't exceed
    | any caching restrictions for your services T&Cs. To prevent any caching, please
    | set this value to 0 or null.
    |
    */
    'cache-duration' => env('GEOLOCATION_CACHE', 60 * 60 * 24),

    /*
    |--------------------------------------------------------------------------
    | Service
    |--------------------------------------------------------------------------
    |
    | You can only provide one of the following values as the service
    | ipinfodb
    | ip2location
    |
    | IpInfoDb is the legacy (and default) service.
    |
    */
    'service' => env('GEOLOCATION_SERVICE', 'ipinfodb'),

    /*
    |--------------------------------------------------------------------------
    | Services
    |--------------------------------------------------------------------------
    |
    | This sets up service defaults.
    |
    */
    'services' => [

        /*
        |--------------------------------------------------------------------------
        | IP Info DB
        |--------------------------------------------------------------------------
        |
        | This service is no longer accepting new applications, if you don't have a
        | api key to use this service you will need to use the other service, Ip 2 Location.
        |
        */
        'ipinfodb' => [
            /**
             * Api key for the Ip Info DB service
             */
            'api-key' => env('GEOLOCATION_IPINFODB_API_KEY', null),

            /*
             * Set the default API url
             */
            'api-url' => 'https://api.ipinfodb.com',

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
        ],

        /*
        |--------------------------------------------------------------------------
        | IP 2 Location
        |--------------------------------------------------------------------------
        |
        | This is the newer service.
        |
        */
        'ip2location' => [
            /**
             * Api key for the Ip2Location service
             */
            'api-key' => env('GEOLOCATION_IP2LOCATION_API_KEY', null),

            /*
             * Set the default API url
             */
            'api-url' => 'https://api.ip2location.io',
        ],
    ],
];
