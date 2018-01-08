<?php

namespace Midnite81\GeoLocation\Services\Tests;

use Midnite81\GeoLocation\Services\GeoLocation;
use Midnite81\GeoLocation\Services\IpLocation;
use PHPUnit\Framework\TestCase;

class GeoLocationTest extends TestCase
{
    /**
     * @var GeoLocation
     */
    protected $geolocation;


    /**
     * @before
     */
    public function setup()
    {
        $this->geolocation = new GeoLocation();

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

//    /**
//     * @test
//     */
//    public function it_accepts_city_as_a_precision()
//    {
//
//        $location = $this->geolocation->get('127.0.0.1', 'city');
//
//        $this->assertInstanceOf(IpLocation::class, $location);
//    }

}