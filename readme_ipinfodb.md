# IP Info DB Documentation

## Example usage

```php

use Midnite81\GeoLocation\Contracts\Services\IpInfoDbInterface;
use Midnite81\GeoLocation\Enums\Precision;
use Illuminate\Http\Request;

public function index(IpInfoDbInterface $ipInfoDb, Request $request) 
{
    // you can use the get method to pass the ip address and the precision you wish for
    // precision is an enum, the only options are City or Country.
    // if you don't pass a precision it defaults to City
    // you can read more about precision in the api documentation at https://www.ipinfodb.com/api
    $cityInformation = $ipInfoDb->get('8.8.8.8', Precision::City);
    $cityInformationByDefault = $ipInfoDb->get('8.8.8.8');
    $countryInformation = $ipInfoDb->get('8.8.8.8', Precision::Country);

    // alternatively you can get city information using the ->getCity() method
    $cityInformation = $ipInfoDb->getCity($request->ip());

    // there is a similar method to retrieve country information
    $countryInformation = $ipInfoDb->getCountry($request->ip());

    // all of these methods return a IpInfoDbLocationResponse object
    // for example you can return 
    echo $cityInformation->countryName // returns e.g 'United States of America'
    echo $cityInformation->addressString; // e.g. London, United Kingdom
    
    // a full list of properties and methods can be seen below.
}

```

## Available methods and properties

### Properties

| Property        | Type   | Example Response                |
|-----------------|--------|---------------------------------|
| ->statusCode    | string | 200                             |
| ->statusMessage | string | [empty]                         |
| ->ipAddress     | string | 8.8.8.8                         |
| ->countryCode   | string | gb                              |
| ->countryName   | string | England                         |
| ->regionName    | string | London                          |
| ->cityName      | string | Crystal Palace                  |
| ->addressString | string | Crystal Palace, London, England |
| ->zipCode       | string | S1 E22                          |
| ->postcode      | string | S1 E22                          |
| ->latitude      | string | 51.422                          |
| ->longitude     | string | 0.075                           |
| ->timeZone      | string | +00                             |

### Methods

| Method                                    | Type   | Description                                              |
|-------------------------------------------|--------|----------------------------------------------------------|
| ->toArray()                               | array  | Returns an array of the response                         |
| ->toLimitedArray(array $limitToKeys = []) | array  | Returns an array of the keys you specify in $limitToKeys |
| ->toJson()                                | json   | Returns an json string of the response                   |
| ->toQueryString()                         | string | Returns an a query string of the property key/values     |
