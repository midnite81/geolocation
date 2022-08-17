<?php

declare(strict_types=1);

use Midnite81\GeoLocation\Responses\IpInfoDbLocationResponse;

beforeEach(function () {
    $this->results = json_encode([
        'statusCode' => '200',
        'statusMessage' => 'Success',
        'ipAddress' => '127.0.0.1',
        'countryCode' => 'gb',
        'countryName' => 'England',
        'regionName' => 'London',
        'cityName' => 'Crystal Palace',
        'zipCode' => 'S1 E22',
        'latitude' => '50',
        'longitude' => '50',
        'timeZone' => '+00',
        'addressString' => 'Crystal Palace, London, England',
    ]);

    $this->ipLocation = new IpInfoDbLocationResponse([]);
    $this->filledIpLocation = new IpInfoDbLocationResponse($this->results);
});

it('it_can_be_exported_as_json', function () {
    expect($this->filledIpLocation->toJson())
        ->toBeString();
});

it('can be exported as an array', function () {
    expect($this->filledIpLocation->toArray())
    ->toBeArray()
    ->toHaveKey('statusCode')
    ->toHaveKey('statusMessage')
    ->toHaveKey('ipAddress')
    ->toHaveKey('countryCode')
    ->toHaveKey('countryName')
    ->toHaveKey('regionName')
    ->toHaveKey('cityName')
    ->toHaveKey('zipCode')
    ->toHaveKey('latitude')
    ->toHaveKey('longitude')
    ->toHaveKey('timeZone')
    ->toHaveKey('addressString');
});

it('can_retrieve_status_code', function () {
    expect($this->filledIpLocation->statusCode)
        ->toBe('200');
});

it('can_retrieve_status_message', function () {
    expect($this->filledIpLocation->statusMessage)
        ->toBe('Success');
});

it('can_retrieve_ip_address', function () {
    expect($this->filledIpLocation->ipAddress)
        ->toBe('127.0.0.1');
});

it('can_retrieve_country_code', function () {
    expect($this->filledIpLocation->countryCode)
        ->toBe('gb');
});

it('can_retrieve_country_name', function () {
    expect($this->filledIpLocation->countryName)
        ->toBe('England');
});

it('can_retrieve_region_name', function () {
    expect($this->filledIpLocation->regionName)
        ->toBe('London');
});

it('can_retrieve_city_name', function () {
    expect($this->filledIpLocation->cityName)
        ->toBe('Crystal Palace');
});

it('can_retrieve_zipcode', function () {
    expect($this->filledIpLocation->zipCode)
        ->toBe('S1 E22');
});

it('can_retrieve_postcode', function () {
    expect($this->filledIpLocation->postcode)
        ->toBe('S1 E22');
});

it('can_retrieve_latitude', function () {
    expect($this->filledIpLocation->latitude)
        ->toBe('50');
});

it('can_retrieve_longitude', function () {
    expect($this->filledIpLocation->longitude)
        ->toBe('50');
});

it('can_retrieve_time_zone', function () {
    expect($this->filledIpLocation->timeZone)
        ->toBe('+00');
});

it('can_retrieve_address_string', function () {
    expect($this->filledIpLocation->addressString)
        ->toBe('Crystal Palace, London, England');
});
