<?php
namespace Midnite81\GeoLocation;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Midnite81\GeoLocation\Contracts\Services\GeoLocationInterface;
use Midnite81\GeoLocation\Services\GeoLocation;
use GuzzleHttp\ClientInterface;

class GeoLocationServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected bool $defer = true;
    /**
     * Bootstrap the application events.
     *
     * @return             void
     * @codeCoverageIgnore
     */
    public function boot()
    {
        $this->publishes(
            [
            __DIR__ . '/../config/geolocation.php' => config_path('geolocation.php')
            ]
        );
        $this->mergeConfigFrom(__DIR__ . '/../config/geolocation.php', 'geolocation');
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ClientInterface::class, Client::class);

        $this->app->bind(GeoLocationInterface::class, GeoLocation::class);

        $this->app->alias(GeoLocationInterface::class, 'midnite81.geolocation');
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['midnite81.geolocation', GeoLocationInterface::class];
    }
}
