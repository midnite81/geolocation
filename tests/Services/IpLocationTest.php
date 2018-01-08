<?php

namespace Midnite81\GeoLocation\Services\Tests;

use Midnite81\GeoLocation\Services\IpLocation;
use PHPUnit\Framework\TestCase;

class IpLocationTest extends TestCase
{
    /**
     * @var IpLocation
     */
    protected $ipLocation;

    /**
     * @var IpLocation
     */
    protected $filledIpLocation;

    /**
     * @before
     */
    public function setup()
    {
        $this->ipLocation = new IpLocation();

        $this->filledIpLocation = new IpLocation($this->results());
    }

    /**
     * @test
     */
    public function it_creates_an_address_string()
    {
        $this->ipLocation->setCityName('Crystal Palace')->setRegionName('London')->setCountryName('England');

        $this->assertInternalType('string', $this->ipLocation->createAddressString());
        $this->assertEquals('Crystal Palace, London, England', $this->ipLocation->createAddressString());
    }

    /**
     * @test
     */
    public function it_can_be_exported_as_an_array()
    {
        $this->assertInternalType('array', $this->filledIpLocation->toArray());
        $this->arrayHasKey('statusCode');
        $this->arrayHasKey('statusMessage');
        $this->arrayHasKey('ipAddress');
        $this->arrayHasKey('countryCode');
        $this->arrayHasKey('countryName');
        $this->arrayHasKey('regionName');
        $this->arrayHasKey('cityName');
        $this->arrayHasKey('zipCode');
        $this->arrayHasKey('latitude');
        $this->arrayHasKey('longitude');
        $this->arrayHasKey('timeZone');
        $this->arrayHasKey('addressString');
    }
    
    /** 
     * @test 
     */
    public function it_can_be_exported_as_json() 
    {
        $this->assertInternalType('object', json_decode($this->filledIpLocation->toJson()));
    }

    /**
     * @test
     */
    public function can_retrieve_status_code()
    {
        $this->assertEquals(json_decode($this->results(), false)->statusCode, $this->filledIpLocation->getStatusCode());
    }

    /**
     * @test
     */
    public function can_set_status_code()
    {
        $string = 'Test assertion';
        $this->filledIpLocation->setStatusCode($string);
        $this->assertEquals($string, $this->filledIpLocation->getStatusCode());
    }

    /**
     * @test
     */
    public function can_retrieve_status_message()
    {
        $this->assertEquals(json_decode($this->results(), false)->statusMessage, $this->filledIpLocation->getStatusMessage());
    }

    /**
     * @test
     */
    public function can_set_status_message()
    {
        $string = 'Test assertion';
        $this->filledIpLocation->setStatusMessage($string);
        $this->assertEquals($string, $this->filledIpLocation->getStatusMessage());
    }

    /**
     * @test
     */
    public function can_retrieve_ip_address()
    {
        $this->assertEquals(json_decode($this->results(), false)->ipAddress, $this->filledIpLocation->getIpAddress());
    }

    /**
     * @test
     */
    public function can_set_ip_address()
    {
        $string = 'Test assertion';
        $this->filledIpLocation->setIpAddress($string);
        $this->assertEquals($string, $this->filledIpLocation->getIpAddress());
    }

    /**
     * @test
     */
    public function can_retrieve_country_code()
    {
        $this->assertEquals(json_decode($this->results(), false)->countryCode, $this->filledIpLocation->getCountryCode());
    }

    /**
     * @test
     */
    public function can_set_country_code()
    {
        $string = 'Test assertion';
        $this->filledIpLocation->setCountryCode($string);
        $this->assertEquals($string, $this->filledIpLocation->getCountryCode());
    }

    /**
     * @test
     */
    public function can_retrieve_country_name()
    {
        $this->assertEquals(json_decode($this->results(), false)->countryName, $this->filledIpLocation->getCountryName());
    }

    /**
     * @test
     */
    public function can_set_country_name()
    {
        $string = 'Test assertion';
        $this->filledIpLocation->setCountryName($string);
        $this->assertEquals($string, $this->filledIpLocation->getCountryName());
    }


    /**
     * @test
     */
    public function can_retrieve_region_name()
    {
        $this->assertEquals(json_decode($this->results(), false)->regionName, $this->filledIpLocation->getRegionName());
    }

    /**
     * @test
     */
    public function can_set_region_name()
    {
        $string = 'Test assertion';
        $this->filledIpLocation->setRegionName($string);
        $this->assertEquals($string, $this->filledIpLocation->getRegionName());
    }

    /**
     * @test
     */
    public function can_retrieve_city_name()
    {
        $this->assertEquals(json_decode($this->results(), false)->cityName, $this->filledIpLocation->getCityName());
    }

    /**
     * @test
     */
    public function can_set_city_name()
    {
        $string = 'Test assertion';
        $this->filledIpLocation->setCityName($string);
        $this->assertEquals($string, $this->filledIpLocation->getCityName());
    }

    /**
     * @test
     */
    public function can_retrieve_zipcode()
    {
        $this->assertEquals(json_decode($this->results(), false)->zipCode, $this->filledIpLocation->getZipCode());
    }

    /**
     * @test
     */
    public function can_retrieve_postcode()
    {
        $this->assertEquals(json_decode($this->results(), false)->zipCode, $this->filledIpLocation->getPostCode());
    }

    /**
     * @test
     */
    public function can_set_zipcode()
    {
        $string = 'Test assertion';
        $this->filledIpLocation->setZipCode($string);
        $this->assertEquals($string, $this->filledIpLocation->getZipCode());
    }

    /**
     * @test
     */
    public function can_retrieve_latitude()
    {
        $this->assertEquals(json_decode($this->results(), false)->latitude, $this->filledIpLocation->getLatitude());
    }

    /**
     * @test
     */
    public function can_set_latitude()
    {
        $string = 'Test assertion';
        $this->filledIpLocation->setLatitude($string);
        $this->assertEquals($string, $this->filledIpLocation->getLatitude());
    }

    /**
     * @test
     */
    public function can_retrieve_longitude()
    {
        $this->assertEquals(json_decode($this->results(), false)->longitude, $this->filledIpLocation->getLongitude());
    }

    /**
     * @test
     */
    public function can_set_longitude()
    {
        $string = 'Test assertion';
        $this->filledIpLocation->setLongitude($string);
        $this->assertEquals($string, $this->filledIpLocation->getLongitude());
    }

    /**
     * @test
     */
    public function can_retrieve_time_zone()
    {
        $this->assertEquals(json_decode($this->results(), false)->timeZone, $this->filledIpLocation->getTimeZone());
    }

    /**
     * @test
     */
    public function can_set_time_zone()
    {
        $string = 'Test assertion';
        $this->filledIpLocation->setTimeZone($string);
        $this->assertEquals($string, $this->filledIpLocation->getTimeZone());
    }

    /**
     * @test
     */
    public function can_retrieve_address_string()
    {
        $this->assertEquals(json_decode($this->results(), false)->addressString, $this->filledIpLocation->getAddressString());
    }

    /**
     * @test
     */
    public function can_set_address_string()
    {
        $string = 'Test assertion';
        $this->filledIpLocation->setAddressString($string);
        $this->assertEquals($string, $this->filledIpLocation->getAddressString());
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