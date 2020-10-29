<?php

namespace Midnite81\GeoLocation\Tests\Unit;

use Midnite81\GeoLocation\GeoLocationServiceProvider;
use Midnite81\GeoLocation\Services\GeoLocation;
use Midnite81\GeoLocation\Tests\TestCase;

class GeoLocationServiceTest extends TestCase
{
    protected GeoLocationServiceProvider $serviceProvider;

    public function setup(): void
    {
        parent::setUp();
        $this->serviceProvider = new GeoLocationServiceProvider($this->app);
    }

    /**
     * @test
     */
    public function provides_returns_all_of_the_provided_services(): void
    {
        $this->assertContains('midnite81.geolocation', $this->serviceProvider->provides());
        $this->assertContains('Midnite81\GeoLocation\Contracts\Services\GeoLocationInterface', $this->serviceProvider->provides());
    }

    /**
     * @test
     */
    public function test_geolocation_can_be_resolved_from_the_container(): void
    {
        $this->serviceProvider->register();
        $this->assertInstanceOf(GeoLocation::class, $this->app->make('Midnite81\GeoLocation\Contracts\Services\GeoLocationInterface'));
        $this->assertInstanceOf(GeoLocation::class , $this->app->make('midnite81.geolocation'));
    }

    protected function getConfig()
    {
        return require __DIR__ . '/../../config/geolocation.php';
    }
}