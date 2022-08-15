<?php

declare(strict_types=1);

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Illuminate\Cache\Repository;
use Midnite81\GeoLocation\Contracts\Services\IpInfoDbInterface;
use Midnite81\GeoLocation\Enums\Precision;
use Midnite81\GeoLocation\Responses\IpInfoDbLocationResponse;
use Midnite81\GeoLocation\Services\IpInfoDb;
use Midnite81\GeoLocation\Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    $json = json_encode([
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

    $response = new Response(200, [], $json);

    /** @var ClientInterface client */
    $this->client = Mockery::mock(ClientInterface::class);
    $this->client->shouldReceive('request')
                 ->withArgs(['get', Mockery::type('string')])
                 ->andReturn($response);
    /** @var Repository $cache */
    $cache = app()->make(Repository::class);
    $this->geolocation = new IpInfoDb($this->client, $cache);
});

afterAll(function () {
    Mockery::close();
});

it('it implements the contract', function () {
    $this->assertInstanceOf(IpInfoDbInterface::class, $this->geolocation);
});

it('it accepts city as a precision', function () {
    $location = $this->geolocation->get('127.0.0.1', Precision::City);

    $this->assertInstanceOf(IpInfoDbLocationResponse::class, $location);
});

it('it accepts country as a precision', function () {
    $location = $this->geolocation->get('127.0.0.1', Precision::Country);

    $this->assertInstanceOf(IpInfoDbLocationResponse::class, $location);
});

it('get city returns data', function () {
    $location = $this->geolocation->getCity('127.0.0.1');

    $this->assertInstanceOf(IpInfoDbLocationResponse::class, $location);
});

it('get country returns data', function () {
    $location = $this->geolocation->getCountry('127.0.0.1');

    $this->assertInstanceOf(IpInfoDbLocationResponse::class, $location);
});
