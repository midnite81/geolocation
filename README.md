# Geolocation [![Latest Stable Version](https://poser.pugx.org/midnite81/geolocation/version)](https://packagist.org/packages/midnite81/geolocation) [![Total Downloads](https://poser.pugx.org/midnite81/geolocation/downloads)](https://packagist.org/packages/midnite81/geolocation) [![Latest Unstable Version](https://poser.pugx.org/midnite81/geolocation/v/unstable)](https://packagist.org/packages/midnite81/geolocation) [![License](https://poser.pugx.org/midnite81/geolocation/license.svg)](https://packagist.org/packages/midnite81/geolocation) [![Build](https://travis-ci.org/midnite81/geolocation.svg?branch=master)](https://travis-ci.org/midnite81/geolocation) [![Coverage Status](https://coveralls.io/repos/github/midnite81/geolocation/badge.svg?branch=master)](https://coveralls.io/github/midnite81/geolocation?branch=master)

A IP Info DB integration for Laravel

# Versioning

|Version|Branch|PHP|Laravel|Notes|
|---|---|---|---|---|
|^3.0|master|\>=7.4|\>=6|Latest release, facade has been removed and guzzle dependency has been updated to version 7|
|^2.0|v2|\>=5.6|\>=5|Corrects issues with composer 2.0|
|^1.0|v1|\>=5.6|\>=5|First release - not compatible with composer 2.0|

# Installation

If installing on anything below PHP 7.4, please checkout the v2 branch and follow the 
instructions on the readme for that branch.

This package requires PHP 7.4+, and includes a Laravel Service Provider.

To install through composer include the package in your `composer.json`.

    "midnite81/geolocation": "^3.0"

Run `composer install` or `composer update` to download the dependencies, or you can run 
`composer require midnite81/geolocation`.

## Laravel 5 Integration



To use the package with Laravel 5 firstly add the GeoLocation service provider to the 
list of service providers 
in `app/config/app.php`.

    'providers' => [

      Midnite81\GeoLocation\GeoLocationServiceProvider::class
              
    ];
    
Add the `GeoLocation` facade to your aliases array.

    'aliases' => [

      'GeoLocation' => Midnite81\GeoLocation\Facades\GeoLocation::class,
      
    ];
    
Publish the config and migration files using 
`php artisan vendor:publish --provider="Midnite81\GeoLocation\GeoLocationServiceProvider"`
    
# Configuration File

Once you have published the config files, you will find a `geolocation.php` file in the 
`config` folder. You should look through these settings and update these where necessary. 

# Env

You will need to add the following to your `.env` file and update these with your own 
settings

    GEOLOCATION_API_KEY=<key>
    GEOLOCATION_CACHE=<duration_in_minutes>

# Get your GeoLocation API Key

Before using this package you must get an API Key from IP Info DB. Please access 
http://ipinfodb.com/register.php and after registering and confirming your email address 
your api key will be show. Please copy and set to your `.env` file on 
`GEOLOCATION_API_KEY` option.

# Example Usage

    use Midnite81\GeoLocation\Contracts\Services\GeoLocationInterface;
    use Illuminate\Http\Request;
    
    public function index(GeoLocationInterface $geo, Request $request) 
    {
        $ipLocation = $geo->getCity($request->ip());
        
        // if you do $geo->get($request->ip()), the default precision is now city
    
        // $ipLocation is an IpLocation Object
        
        echo $ipLocation->ipAddress; // e.g. 127.0.0.1
        
        echo $ipLocation->getAddressString(); // e.g. London, United Kingdom
        
        // the object has a toJson() and toArray() method on it 
        // so you can die and dump an array.
        dd($ipLocation->toArray()); 

    }
    
# Methods on IpLocation

    $ipLocation->getStatusCode(); // returns status code of request (e.g. 200)
    $ipLocation->getStatusMessage(); // returns any status message to go with code
    $ipLocation->getIpAddress(); // the geolocation IP requested
    $ipLocation->getCountryCode(); // country code of the IP e.g. GB
    $ipLocation->getCountryName(); // country name of the IP e.g. United Kingdom
    $ipLocation->getRegionName(); // region name of the IP e.g. England
    $ipLocation->getCityName(); // city name of the IP e.g. London
    $ipLocation->getZipCode(); // postcode of the IP e.g. SE01 1AA
    $ipLocation->getPostCode(); // postcode of the IP e.g. SE01 1AA
    $ipLocation->getLatitude(); // latitude of the IP e.g. 53.4030
    $ipLocation->getLongitude(); // longitude of the IP e.g. -1.201
    $ipLocation->getTimeZone(); // timezone of the IP e.g. +01:00
    $ipLocation->getAddressString(); // gets the city, region and country as a string
    $ipLocation->toArray(); // returns object as an array
    $ipLocation->toJson(); // returns object as a json object
