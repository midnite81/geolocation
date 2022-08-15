<?php

namespace Midnite81\GeoLocation\Tests\Unit;

use Midnite81\GeoLocation\GeoLocationServiceProvider;
use Midnite81\GeoLocation\Services\Ip2Location;
use Midnite81\GeoLocation\Services\IpInfoDb;
use Midnite81\GeoLocation\Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    $this->serviceProvider = new GeoLocationServiceProvider($this->app);
});

it('provides returns all of the provided services', function () {
    $sut = $this->serviceProvider->provides();

    expect($sut)
        ->toContain('midnite81.geolocation.ipinfodb')
        ->toContain('midnite81.geolocation.ip2location')
        ->toContain('Midnite81\GeoLocation\Contracts\Services\IpInfoDbInterface')
        ->toContain('Midnite81\GeoLocation\Contracts\Services\Ip2LocationInterface');
});

test('ip info db can be resolved from the container', function () {
    $interface = $this->app->make('Midnite81\GeoLocation\Contracts\Services\IpInfoDbInterface');
    expect($interface)
        ->toBeInstanceOf(IpInfoDb::class);

    $alias = $this->app->make('midnite81.geolocation.ipinfodb');
    expect($alias)
        ->toBeInstanceOf(IpInfoDb::class);
});

test('ip2location can be resolved from the container', function () {
    $interface = $this->app->make('Midnite81\GeoLocation\Contracts\Services\Ip2LocationInterface');
    expect($interface)
        ->toBeInstanceOf(Ip2Location::class);

    $alias = $this->app->make('midnite81.geolocation.ip2location');
    expect($alias)
        ->toBeInstanceOf(Ip2Location::class);
});
