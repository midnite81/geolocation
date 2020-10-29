<?php

namespace Midnite81\GeoLocation\Tests\Unit\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use Midnite81\GeoLocation\Contracts\Services\GeoLocationInterface;
use Midnite81\GeoLocation\Exceptions\PrecisionNotKnownException;
use Midnite81\GeoLocation\Services\GeoLocation;
use Midnite81\GeoLocation\Services\IpLocation;
use Mockery as M;
use Midnite81\GeoLocation\Tests\TestCase;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class GeoLocationTest extends TestCase
{
    protected GeoLocation $geolocation;

    /**
     * @var ClientInterface|M\LegacyMockInterface|M\MockInterface
     */
    protected $client;

    /**
     * @before
     */
    public function setup(): void
    {
        parent::setUp();
        $this->client = M::mock(ClientInterface::class);
        $this->client->shouldReceive('request')
            ->withArgs(['get', M::type('string')])
            ->andReturn($this->results());

        $this->geolocation = new GeoLocation($this->client);
    }

    protected function tearDown(): void
    {
        M::close();
    }

    /**
     * @test
     */
    public function it_implements_the_contract()
    {
        $this->assertInstanceOf(GeoLocationInterface::class, $this->geolocation
        );
    }

    /**
     * @test
     * @throws GuzzleException
     */
    public function it_doesnt_except_erroneous_value_as_precision()
    {
        $this->expectException(PrecisionNotKnownException::class);
        $this->geolocation->get('127.0.0.1', 'address');
    }

    /**
     * @test
     * @throws GuzzleException|PrecisionNotKnownException
     */
    public function it_accepts_city_as_a_precision()
    {
        $location = $this->geolocation->get('127.0.0.1', 'city');

        $this->assertInstanceOf(IpLocation::class, $location);
    }

    /**
     * @test
     * @throws GuzzleException|PrecisionNotKnownException
     */
    public function it_accepts_country_as_a_precision()
    {
        $location = $this->geolocation->get('127.0.0.1', 'country');

        $this->assertInstanceOf(IpLocation::class, $location);
    }

    /**
     * @test
     * @throws GuzzleException
     * @throws PrecisionNotKnownException
     */
    public function get_city_returns_data()
    {
        $location = $this->geolocation->getCity('127.0.0.1');

        $this->assertInstanceOf(IpLocation::class, $location);
    }

    /**
     * @test
     * @throws GuzzleException
     * @throws PrecisionNotKnownException
     */
    public function get_country_returns_data()
    {
        $location = $this->geolocation->getCountry('127.0.0.1');

        $this->assertInstanceOf(IpLocation::class, $location);
    }

    protected function results(): ResponseInterface
    {
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
            'addressString' => 'Crystal Palace, London, England'
        ]);

        return new Response(200, [], $json);
    }

}