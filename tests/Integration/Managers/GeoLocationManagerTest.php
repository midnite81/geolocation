<?php

declare(strict_types=1);

use Midnite81\GeoLocation\Contracts\Services\Ip2LocationInterface;
use Midnite81\GeoLocation\Contracts\Services\IpInfoDbInterface;
use Midnite81\GeoLocation\Managers\GeoManager;
use Midnite81\GeoLocation\Tests\TestCase;

uses(TestCase::class);

it('returns the default instance', function () {
    /** @var GeoManager $manager */
    $manager = app(GeoManager::class);

    expect($manager->driver())
        ->toBeInstanceOf(IpInfoDbInterface::class);
});

it('returns an instance of ip2location', function () {
    /** @var GeoManager $manager */
    $manager = app(GeoManager::class);

    expect($manager->driver('ip2location'))
        ->toBeInstanceOf(Ip2LocationInterface::class);
});

it('returns an instance of ip info db when called directly', function () {
    /** @var GeoManager $manager */
    $manager = app(GeoManager::class);

    expect($manager->getIpinfodbDriver())
        ->toBeInstanceOf(IpInfoDbInterface::class);
});

it('returns an instance of ip2location when called directly', function () {
    /** @var GeoManager $manager */
    $manager = app(GeoManager::class);

    expect($manager->getIp2locationDriver())
        ->toBeInstanceOf(Ip2LocationInterface::class);
});

it('throws an exception if an invalid driver is set', function () {
    /** @var GeoManager $manager */
    $manager = app(GeoManager::class);

    config()->set('geolocation.service', 'dummy-driver');

    $manager->driver();
})->throws(RuntimeException::class, 'Driver [dummy-driver] is not supported');
