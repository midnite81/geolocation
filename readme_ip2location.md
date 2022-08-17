# IP2Location Documentation

## Example usage

```php

use Midnite81\GeoLocation\Contracts\Services\Ip2LocationInterface;
use Midnite81\GeoLocation\Enums\Precision;
use Illuminate\Http\Request;

public function index(Ip2LocationInterface $ip2Location, Request $request) 
{
    // One simple call is needed to obtain geolocation information
    $geolocationInformation = $ip2Location->get($request->ip());

    // all of these methods return a Ip2LocationResponse object
    // for example you can return 
    echo $geolocationInformation->countryName // returns e.g United States of America
    echo $geolocationInformation->addressString; // e.g. London, United Kingdom
    
    // a full list of properties and methods can be seen below.
}

```

## Available methods and properties

### Properties

Please note that while all of these properties are available, if your plan doesn't allow for the property to be 
retrieved the response will be empty. You can view the response types available on the 
[Ip2Location website](https://www.ip2location.io/documentation#apires) 

Alternatively you can view the test fixtures to give you a better idea;
- [Free](/tests/fixtures/ip2location_free.json)
- [Starter](/tests/fixtures/ip2location_starter.json)
- [Plus](/tests/fixtures/ip2location_plus.json)
- [Security](/tests/fixtures/ip2location_security.json)

| Property                           | Type (if not null) | Example Response                                    |
|------------------------------------|--------------------|-----------------------------------------------------|
| ->ip                               | String             | 8.8.8.8                                             |
| ->countryCode                      | String             | US                                                  |
| ->countryName                      | String             | United States of America                            |
| ->regionName                       | String             | California                                          |
| ->cityName                         | String             | Mountain View                                       |
| ->addressString                    | String             | Mountain View, California, United States of America |
| ->latitude                         | Float              | 37.405992                                           |                                         
| ->longitude                        | Float              | -122.078515                                         |                                       
| ->zipCode                          | String/Int         | 94043                                               |
| ->timeZone                         | String             | -07:00                                              |
| ->asn                              | String             | 15169                                               |
| ->as                               | String             | Google LLC                                          |
| ->isp                              | String             | Google LLC                                          |
| ->domain                           | String             | google.com                                          |
| ->netSpeed                         | String             | T1                                                  |
| ->iddCode                          | String             | 1                                                   |
| ->areaCode                         | String             | 650                                                 |
| ->weatherStationCode               | String             | USCA0746                                            |
| ->weatherStationName               | String             | Mountain View                                       |
| ->mcc                              | String             | -                                                   |
| ->mnc                              | String             | -                                                   |
| ->mobileBrand                      | String             | -                                                   |
| ->elevation                        | Int                | 32                                                  |                                                
| ->usageType                        | String             | DCH                                                 |
| ->addressType                      | String             | Anycast                                             |
| ->continent->name                  | String             | North America                                       |
| ->continent->code                  | String             | NA                                                  |
| ->continent->hemisphere            | Array              | ['north', 'west']                                   |
| ->continent->translation->language | String             | ko                                                  |
| ->continent->translation->value    | String             | 북아메리카                                               |
| ->country->name                    | String             | United States of America                            |
| ->country->alpha3Code              | String             | USA                                                 |
| ->country->numericCode             | Int                | 840                                                 
| ->country->demonym                 | String             | Americans                                           |
| ->country->flag                    | String             | https://cdn.ip2location.io/assets/img/flags/us.png  |
| ->country->capital                 | String             | Washington, D.C.                                    |
| ->country->totalArea               | Int                | 9826675                                             
| ->country->population              | Int                | 331002651                                           
| ->country->currency->code          | String             | USD                                                 |
| ->country->currency->name          | String             | United States Dollar                                |
| ->country->currency->symbol        | String             | $                                                   |
| ->country->language->code          | String             | EN                                                  |
| ->country->language->name          | String             | English                                             |
| ->country->tld                     | String             | us                                                  |
| ->country->translation->language   | String             | ko                                                  |
| ->country->translation->value      | String             | 미국                                                  |
| ->region->name                     | String             | California                                          |
| ->region->code                     | String             | US-CA                                               |
| ->region->translation->language    | String             | ko                                                  |
| ->region->translation->value       | String             | 캘리포니아주                                              |
| ->city->name                       | String             | Mountain View                                       |
| ->city->translation->language      | String             |                                                     |                       
| ->city->translation->value         | String             |                                                     |
| ->timeZoneInfo->olson              | String             | America/Los_Angeles                                 |
| ->timeZoneInfo->currentTime        | String             | 2022-04-18T23:41:57-07:00                           |
| ->timeZoneInfo->gmtOffset          | Int                | -25200                                              
| ->timeZoneInfo->isDst              | Boolean            | true                                                |
| ->timeZoneInfo->sunrise            | String             | 06:27                                               |
| ->timeZoneInfo->sunset             | String             | 19:47                                               |
| ->geoTargeting->metro              | String             | 807                                                 |
| ->adsCategory                      | String             | IAB19                                               |
| ->adsCategoryName                  | String             | Technology & Computing                              |
| ->isProxy                          | Boolean            | False                                               |
| ->proxy->lastSeen                  | String             | 18                                                  |                                                
| ->proxy->proxyType                 | String             | DCH                                                 |
| ->proxy->provider                  | String             | -                                                   |
| ->proxy->threat                    | String             | -                                                   |

### Methods

| Method                                    | Type   | Description                                              |
|-------------------------------------------|--------|----------------------------------------------------------|
| ->toArray()                               | array  | Returns an array of the response                         |
| ->toLimitedArray(array $limitToKeys = []) | array  | Returns an array of the keys you specify in $limitToKeys |
| ->toJson()                                | json   | Returns an json string of the response                   |
| ->toQueryString()                         | string | Returns an a query string of the property key/values     |


## Exceptions

If an error occurs when attempting to retrieve geolocation information, one of the six exceptions will be thrown. They
are all namespaced to `Midnite81\GeoLocation\Exceptions\Ip2Location`. The previous exception is also passed to these 
exceptions so should you need to explore further back you can. 

Each exception provides the message you see in the table below. 

| Exception                        | Error Code | Error Message                               |
|----------------------------------|------------|---------------------------------------------|
| InvalidApiException              | 10000      | Invalid API key or insufficient credit      |
| InvalidIpException               | 10001      | Invalid IP address                          |
| InternalServerException          | 10002      | Internal server error                       |
| InvalidLanguageCodeException     | 10003      | Invalid language code                       |
| TranslationNotAvailableException | 10004      | Translation is not available with your plan |
| RetrievalException               | 99999      | General failure to retrieve information     |
