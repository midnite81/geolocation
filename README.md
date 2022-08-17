# Geolocation [![Latest Stable Version](https://poser.pugx.org/midnite81/geolocation/version)](https://packagist.org/packages/midnite81/geolocation) [![Total Downloads](https://poser.pugx.org/midnite81/geolocation/downloads)](https://packagist.org/packages/midnite81/geolocation) [![Latest Unstable Version](https://poser.pugx.org/midnite81/geolocation/v/unstable)](https://packagist.org/packages/midnite81/geolocation) [![License](https://poser.pugx.org/midnite81/geolocation/license.svg)](https://packagist.org/packages/midnite81/geolocation) [![Build](https://travis-ci.org/midnite81/geolocation.svg?branch=master)](https://travis-ci.org/midnite81/geolocation) [![Coverage Status](https://coveralls.io/repos/github/midnite81/geolocation/badge.svg?branch=master)](https://coveralls.io/github/midnite81/geolocation?branch=master)

A IP Info DB integration for Laravel

# Versioning

| Version | Branch    | PHP    | Laravel | Notes                                                                        |
|---------|-----------|--------|---------|------------------------------------------------------------------------------|
| ^4.0    | master/v4 | \>=8.1 | \>=8    | Update to include wrap Ip2Location in addition to IpInfoDb, moved to php 8.1 |
| ^3.0    | v3        | \>=7.4 | \>=6    | Facade has been removed and guzzle dependency has been updated to version 7  |
| ^2.0    | v2        | \>=5.6 | \>=5    | Corrects issues with composer 2.0                                            |
| ^1.0    | v1        | \>=5.6 | \>=5    | First release - not compatible with composer 2.0                             |

# Upgrading to v4.0

Please note:

- version 4 brings in the ability to wrap both the IpInfoDb service (as was available in previous versions)
  and the Ip2Location service.  IpInfoDb are not accepting new registrations and are asking users to register at
  Ip2Location instead.
- version 4 minimum requirements are php 8.1 to make use of the additional features php 8.1 brings, such as enums
  and better type safety.
- version 4 has an updated config file. If you are upgrading, I would suggest checking out the
  [config file](/config/geolocation.php) and updating your local instance of it.
- a change has been made to the caching from minutes to seconds.


# Installation

If installing on anything below PHP 8.1, please checkout the v2 or v3 branch and follow the
instructions on the readme for that branch. Please note ip2location is not supported on previous versions of this
package

This package requires PHP 8.1+, and includes a Laravel Service Provider.

To install through composer include the package in your `composer.json`.

    "midnite81/geolocation": "^4.0"

Run `composer install` or `composer update` to download the dependencies, or you can run
`composer require midnite81/geolocation`.

## Laravel Integration

This package makes use of Laravel's auto package loader, so you shouldn't need to add this
to your config/app.php file. However, if you've disabled this then you'll need to add the
GeoLocation service provider to the list of service providers
in `app/config/app.php`.

    'providers' => [
      Midnite81\GeoLocation\GeoLocationServiceProvider::class
    ];

Publish the config and migration files using
`php artisan vendor:publish --provider="Midnite81\GeoLocation\GeoLocationServiceProvider"`

# Configuration File

Once you have published the config files, you will find a `geolocation.php` file in the
`config` folder. You should look through these settings and update these where necessary.

# Env

You will need to add the following to your `.env` file and update these with your own
settings. Please note you will only need to fill in the api key for the service you are using.

```dotenv
GEOLOCATION_IPINFODB_API_KEY=<ip_info_db_api_key>
GEOLOCATION_IP2LOCATION_API_KEY=<ip2location_api_key>
GEOLOCATION_CACHE=<duration_in_seconds>
```

# Get your GeoLocation API Key

Before using this package you'll need to obtain an API Key from either [IpInfoDb](http://ipinfodb.com/register)
which is no longer accepting new registrations or [Ip2Location](https://www.ip2location.io/sign-up).

Once you have signed up you will need to add your api key to the relevant `.env` key; `GEOLOCATION_IPINFODB_API_KEY` for
IpInfoDb or `GEOLOCATION_IP2LOCATION_API_KEY` for Ip2Location.

# Caching

This package allows you to cache responses, however it is your responsibility to ensure you're not breaking any
terms and conditions of use.

# Rate Limiting

This package does not set any rate limiting internally. You should ensure that your application adheres to any rate
limiting set by your chosen provider.


# Example Usage and Available Methods and Properties

- [IpInfoDb example usage and available methods](/readme_ipinfodb.md)
- [Ip2Location example usage and available methods](/readme_ip2location.md)