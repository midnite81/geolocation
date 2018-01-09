<?php

namespace Midnite81\GeoLocation\Services\Tests;

use Midnite81\GeoLocation\Services\GeoLocation;
use Midnite81\GeoLocation\Services\IpLocation;
use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;

class GeoLocationTest extends TestCase
{
    /**
     * @var GeoLocation
     */
    protected $geolocation;

    /**
     * @var GeoLocation
     */
    protected $mock;


    /**
     * @before
     */
    public function setup()
    {
        $this->geolocation = new GeoLocation();

        $this->mock = Mockery::mock('Midnite81\GeoLocation\Services\GeoLocation[requestData]');
        $this->mock->shouldAllowMockingProtectedMethods();
        $this->mock->shouldReceive('requestData')->once()->andReturn($this->results());
    }
    
    /** 
     * @test 
     */
    public function it_implements_the_contract() 
    {
        $this->assertInstanceOf(\Midnite81\GeoLocation\Contracts\Services\GeoLocation::class, $this->geolocation);
    }
    
    /** 
     * @test
     * @expectedException \Midnite81\GeoLocation\Exceptions\PrecisionNotKnownException
     */
    public function it_doesnt_except_erroneous_value_as_precision() 
    {
        $location = $this->geolocation->get('127.0.0.1', 'address');
    }

    /**
     * @test
     */
    public function it_accepts_city_as_a_precision()
    {

        $location = $this->mock->get('127.0.0.1', 'city');

        $this->assertInstanceOf(IpLocation::class, $location);
    }

    /**
     * @test
     */
    public function it_accepts_country_as_a_precision()
    {
        $location = $this->mock->get('127.0.0.1', 'country');

        $this->assertInstanceOf(IpLocation::class, $location);
    }

    /**
     * @test
     */
    public function get_city_returns_data()
    {
        $location = $this->mock->getCity('127.0.0.1', 'country');

        $this->assertInstanceOf(IpLocation::class, $location);
    }

    /**
     * @test
     */
    public function get_country_returns_data()
    {
        $location = $this->mock->getCountry('127.0.0.1', 'country');

        $this->assertInstanceOf(IpLocation::class, $location);
    }

    protected function results()
    {
        return json_encode([
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
    }

}