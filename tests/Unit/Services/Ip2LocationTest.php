<?php

declare(strict_types=1);

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Cache\Repository;
use Midnite81\GeoLocation\Exceptions\Ip2Location\InternalServerException;
use Midnite81\GeoLocation\Exceptions\Ip2Location\InvalidApiException;
use Midnite81\GeoLocation\Exceptions\Ip2Location\InvalidIpException;
use Midnite81\GeoLocation\Exceptions\Ip2Location\InvalidLanguageCodeException;
use Midnite81\GeoLocation\Exceptions\Ip2Location\RetrievalException;
use Midnite81\GeoLocation\Exceptions\Ip2Location\TranslationNotAvailableException;
use Midnite81\GeoLocation\Responses\Ip2LocationResponse;
use Midnite81\GeoLocation\Services\Ip2Location;
use Midnite81\GeoLocation\Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    $json = file_get_contents(__DIR__ . '/../../fixtures/ip2location_free.json');

    $response = new Response(200, [], $json);

    $this->clientInterface = Mockery::mock(ClientInterface::class);
    $this->clientInterface->shouldReceive('request')
                          ->withArgs(['get', Mockery::type('string')])
                          ->andReturn($response);
    /** @var Repository $cache */
    $cache = app()->make(Repository::class);
    $this->geolocation = new Ip2Location($this->clientInterface, $cache);
});

afterAll(function () {
    Mockery::close();
});

it('it implements the contract', function () {
    $this->assertInstanceOf(Ip2Location::class, $this->geolocation);
});

it('it accepts city as a precision', function () {
    $location = $this->geolocation->get('127.0.0.1');

    $this->assertInstanceOf(Ip2LocationResponse::class, $location);
});

it('throws an exception if invalid api key', function () {
    $json = '{"error":{"error_code":10000,"error_message":"Invalid API key or insufficient credit."}}';
    $response = new Response(401, [], $json);

    $clientException = new ClientException(
        '',
        new Request('GET', 'http://blah.etc'),
        $response,
        null,
        [],
    );

    $client = Mockery::mock(ClientInterface::class);
    $client->shouldReceive('request')
           ->withArgs(['get', Mockery::type('string')])
           ->andThrow($clientException);
    /** @var Repository $cache */
    $cache = app()->make(Repository::class);
    $geolocation = new Ip2Location($client, $cache);
    $geolocation->get('8.8.8.8');
})->throws(InvalidApiException::class);

it('throws an exception if invalid ip address', function () {
    $json = '{"error":{"error_code":10001,"error_message":"Invalid IP address."}}';
    $response = new Response(401, [], $json);

    $clientException = new ClientException(
        '',
        new Request('GET', 'http://blah.etc'),
        $response,
        null,
        [],
    );

    $client = Mockery::mock(ClientInterface::class);
    $client->shouldReceive('request')
           ->withArgs(['get', Mockery::type('string')])
           ->andThrow($clientException);
    /** @var Repository $cache */
    $cache = app()->make(Repository::class);
    $geolocation = new Ip2Location($client, $cache);
    $geolocation->get('8.8.8.8');
})->throws(InvalidIpException::class);

it('throws an exception if internal server error', function () {
    $json = '{"error":{"error_code":10002,"error_message":"Internal server error."}}';
    $response = new Response(401, [], $json);

    $clientException = new ClientException(
        '',
        new Request('GET', 'http://blah.etc'),
        $response,
        null,
        [],
    );

    $client = Mockery::mock(ClientInterface::class);
    $client->shouldReceive('request')
           ->withArgs(['get', Mockery::type('string')])
           ->andThrow($clientException);
    /** @var Repository $cache */
    $cache = app()->make(Repository::class);
    $geolocation = new Ip2Location($client, $cache);
    $geolocation->get('8.8.8.8');
})->throws(InternalServerException::class);

it('throws an exception if invalid language error', function () {
    $json = '{"error":{"error_code":10003,"error_message":"Invalid language code."}}';
    $response = new Response(401, [], $json);

    $clientException = new ClientException(
        '',
        new Request('GET', 'http://blah.etc'),
        $response,
        null,
        [],
    );

    $client = Mockery::mock(ClientInterface::class);
    $client->shouldReceive('request')
           ->withArgs(['get', Mockery::type('string')])
           ->andThrow($clientException);
    /** @var Repository $cache */
    $cache = app()->make(Repository::class);
    $geolocation = new Ip2Location($client, $cache);
    $geolocation->get('8.8.8.8');
})->throws(InvalidLanguageCodeException::class);

it('throws an exception if translation is not available', function () {
    $json = '{"error":{"error_code":10004,"error_message":"Translation is not available with your plan."}}';
    $response = new Response(401, [], $json);

    $clientException = new ClientException(
        '',
        new Request('GET', 'http://blah.etc'),
        $response,
        null,
        [],
    );

    $client = Mockery::mock(ClientInterface::class);
    $client->shouldReceive('request')
           ->withArgs(['get', Mockery::type('string')])
           ->andThrow($clientException);
    /** @var Repository $cache */
    $cache = app()->make(Repository::class);
    $geolocation = new Ip2Location($client, $cache);
    $geolocation->get('8.8.8.8');
})->throws(TranslationNotAvailableException::class);

it('throws a general exception if things go wrong', function () {
    $json = '{"error":{"error_code":401,"error_message":"Some other error"}}';
    $response = new Response(401, [], $json);

    $clientException = new ClientException(
        '',
        new Request('GET', 'http://blah.etc'),
        $response,
        null,
        [],
    );

    $client = Mockery::mock(ClientInterface::class);
    $client->shouldReceive('request')
           ->withArgs(['get', Mockery::type('string')])
           ->andThrow($clientException);
    /** @var Repository $cache */
    $cache = app()->make(Repository::class);
    $geolocation = new Ip2Location($client, $cache);
    $geolocation->get('8.8.8.8');
})->throws(RetrievalException::class);

it('caches the response ', function () {
    $json = file_get_contents(__DIR__ . '/../../fixtures/ip2location_free.json');
    $response = new Response(200, [], $json);

    $client = Mockery::mock(ClientInterface::class);
    $client->shouldReceive('request')
           ->withArgs(['get', Mockery::type('string')])
           ->andReturns($response);

    $cache = Mockery::mock(Repository::class);
    /* @phpstan-ignore-next-line */
    $cache->shouldReceive('has')
        ->andReturn(false)
        ->once();
    /* @phpstan-ignore-next-line */
    $cache->shouldReceive('put')
        ->once();

    $geolocation = new Ip2Location($client, $cache);
    $geolocation->get('8.8.8.8');
});
