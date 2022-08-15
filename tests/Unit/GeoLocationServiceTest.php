<?php

namespace Midnite81\GeoLocation\Tests\Unit;

use Midnite81\GeoLocation\GeoLocationServiceProvider;
use Midnite81\GeoLocation\Services\GeoIpInfoDb;
use Midnite81\GeoLocation\Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    $this->serviceProvider = new GeoLocationServiceProvider($this->app);
});

it('provides returns all of the provided services', function () {
    $sut = $this->serviceProvider->provides();

    expect($sut)
        ->toContain('midnite81.geolocation')
        ->toContain('Midnite81\GeoLocation\Contracts\Services\GeoIpInfoDbInterface');
});

test('geolocation can be resolved from the container', function () {
    $interface = $this->app->make('Midnite81\GeoLocation\Contracts\Services\GeoIpInfoDbInterface');
    expect($interface)
        ->toBeInstanceOf(GeoIpInfoDb::class);

    $alias = $this->app->make('midnite81.geolocation');
    expect($alias)
        ->toBeInstanceOf(GeoIpInfoDb::class);
});
