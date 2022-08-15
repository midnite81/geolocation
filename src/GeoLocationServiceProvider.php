<?php

namespace Midnite81\GeoLocation;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Midnite81\GeoLocation\Contracts\Services\Ip2LocationInterface;
use Midnite81\GeoLocation\Contracts\Services\IpInfoDbInterface;
use Midnite81\GeoLocation\Services\Ip2Location;
use Midnite81\GeoLocation\Services\IpInfoDb;

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
        $this->app->bind(IpInfoDbInterface::class, IpInfoDb::class);
        $this->app->bind(Ip2LocationInterface::class, Ip2Location::class);
        $this->app->alias(IpInfoDbInterface::class, 'midnite81.geolocation.ipinfodb');
        $this->app->alias(Ip2LocationInterface::class, 'midnite81.geolocation.ip2location');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            'midnite81.geolocation.ipinfodb',
            'midnite81.geolocation.ip2location',
            IpInfoDbInterface::class,
            Ip2LocationInterface::class,
        ];
    }
}
