# Geolocation [![Latest Stable Version](https://poser.pugx.org/midnite81/geolocation/version)](https://packagist.org/packages/midnite81/geolocation) [![Total Downloads](https://poser.pugx.org/midnite81/geolocation/downloads)](https://packagist.org/packages/midnite81/geolocation) [![Latest Unstable Version](https://poser.pugx.org/midnite81/geolocation/v/unstable)](https://packagist.org/packages/midnite81/geolocation) [![License](https://poser.pugx.org/midnite81/geolocation/license.svg)](https://packagist.org/packages/midnite81/geolocation)
A IP Info DB integration for Laravel

#Installation

This package requires PHP 5.6+, and includes a Laravel 5 Service Provider and Facade.

To install through composer include the package in your `composer.json`.

    "midnite81/geolocation": "0.1.*"

Run `composer install` or `composer update` to download the dependencies or you can run `composer require midnite81/geolocation`.

## Refresh Autoloader

At this point some users may need to run the command `composer dump-autoload`. Alternatively, you can run `php artisan optimize`
which should include the dump-autoload command.

##Laravel 5 Integration

To use the package with Laravel 5 firstly add the Messaging service provider to the list of service providers 
in `app/config/app.php`.

    'providers' => [

      Midnite81\Geolocation\GeoLocationServiceProvider::class
              
    ];
    
Add the `GeoLocation` facade to your aliases array.

    'aliases' => [

      'GeoLocation' => Midnite81\GeoLocation\Facades\GeoLocation::class,
      
    ];
    
Publish the config and migration files using 
`php artisan vendor:publish --provider="Midnite81\GeoLocation\GeoLocationServiceProvider"`
    
#Configuration File

Once you have published the config files, you will find a `geolocation.php` file in the `config` folder. You should 
look through these settings and update these where necessary. 

# Env

You will need to add the following to your `.env` file and update these with your own settings

    GEOLOCATION_API_KEY=<key>
    GEOLOCATION_CACHE=<duration_in_minutes>

# Example Usage

    use Midnite81\GeoLocation\Contracts\Services\GeoLocation;
    use Illuminate\Http\Request;
    
    public function index(GeoLocation $geo, Request $request) 
    {
        $location = $geo->getCity($request->ip());
    
        // $location is an IpLocation Object
        
        echo $location->ipAddress; // e.g. 127.0.0.1
        
        echo $location->getAddressString(); // e.g. London, United Kingdom
        
        // the object has a toJson() and toArray() method on it 
        // so you can die and dump an array.
        dd($location->toArray()); 

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
    $ipLocation->getTimeZone(); // timezone of the IP e.g.
    $ipLocation->getAddressString(); // gets the city, region and country as a string
    $ipLocation->toArray(); // returns object as an array
    $ipLocation->toJson(); returns object as a json object
