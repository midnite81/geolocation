<?php
namespace Midnite81\GeoLocation\Tests;

use Illuminate\Container\Container;
use Midnite81\GeoLocation\GeoLocationServiceProvider;
use PHPUnit\Framework\TestCase;

class GeoLocationServiceTest extends TestCase
{
    protected $app;

    protected $serviceProvider;

    public function setup()
    {
        $this->app = new Container();

        $this->app['config'] = ['geolocation' => $this->getConfig()];

        $this->serviceProvider = new GeoLocationServiceProvider($this->app);
    }

    /**
     * @test
     */
    public function provides_returns_all_of_the_provided_services()
    {
        $this->assertContains('midnite81.geolocation', $this->serviceProvider->provides());
        $this->assertContains('Midnite81\GeoLocation\Contracts\Services\GeoLocation', $this->serviceProvider->provides());
    }

    /**
     * @test
     */
    public function test_geolocation_can_be_resolved_from_the_container()
    {
        $this->serviceProvider->register();
        $this->assertInstanceOf('Midnite81\GeoLocation\Contracts\Services\GeoLocation', $this->app->make('Midnite81\GeoLocation\Contracts\Services\GeoLocation'));
        $this->assertInstanceOf('Midnite81\GeoLocation\Contracts\Services\GeoLocation', $this->app->make('midnite81.geolocation'));
    }

    protected function getConfig()
    {
        return require __DIR__ . '/../config/geolocation.php';
    }
}