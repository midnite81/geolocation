<?php

namespace Midnite81\GeoLocation;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Midnite81\GeoLocation\Contracts\Services\GeoIp2LocationInterface;
use Midnite81\GeoLocation\Contracts\Services\GeoIpInfoDbInterface;
use Midnite81\GeoLocation\Services\GeoIp2Location;
use Midnite81\GeoLocation\Services\GeoIpInfoDb;

class GeoLocationServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     * @codeCoverageIgnore
     */
    public function boot(): void
    {
        $this->publishes(
            [
                __DIR__ . '/../config/geolocation.php' => config_path('geolocation.php'),
            ]
        );
        $this->mergeConfigFrom(__DIR__ . '/../config/geolocation.php', 'geolocation');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ClientInterface::class, Client::class);
        $this->app->bind(GeoIpInfoDbInterface::class, GeoIpInfoDb::class);
        $this->app->bind(GeoIp2LocationInterface::class, GeoIp2Location::class);
        $this->app->alias(GeoIpInfoDbInterface::class, 'midnite81.geolocation');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['midnite81.geolocation', GeoIpInfoDbInterface::class];
    }
}
