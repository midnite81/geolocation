<?php

declare(strict_types=1);

namespace Midnite81\GeoLocation\Tests\Integration;

use Midnite81\GeoLocation\Contracts\Services\GeoLocationInterface;
use Midnite81\GeoLocation\Services\IpLocation;
use Midnite81\GeoLocation\Tests\TestCase;

class GeolocationTest extends TestCase
{
    /** @test */
    public function it_can_connect_to_the_api_and_return_iplocation_object()
    {
        /** @var GeoLocationInterface $sut */
        $sut = app(GeoLocationInterface::class);

        $result = $sut->get('8.8.8.8');

        $this->assertInstanceOf(IpLocation::class, $result);
        $this->assertEquals("OK", $result->getStatusCode());
        $this->assertEquals("8.8.8.8", $result->getIpAddress());
        $this->assertEquals("", $result->getStatusMessage());
        $this->assertEquals("United States of America", $result->getCountryName());
    }
}