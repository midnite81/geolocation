<?php

declare(strict_types=1);

use Midnite81\GeoLocation\Contracts\Services\GeoIp2LocationInterface;
use Midnite81\GeoLocation\Contracts\Services\GeoIpInfoDbInterface;
use Midnite81\GeoLocation\Managers\GeoManager;
use Midnite81\GeoLocation\Tests\TestCase;

uses(TestCase::class);

it('returns the default instance', function () {
    /** @var GeoManager $manager */
    $manager = app(GeoManager::class);

    expect($manager->driver())
        ->toBeInstanceOf(GeoIpInfoDbInterface::class);
});

it('returns an instance of ip2location', function () {
    /** @var GeoManager $manager */
    $manager = app(GeoManager::class);

    expect($manager->driver('ip2location'))
        ->toBeInstanceOf(GeoIp2LocationInterface::class);
});

it('returns an instance of ip info db when called directly', function () {
    /** @var GeoManager $manager */
    $manager = app(GeoManager::class);

    expect($manager->getIpinfodbDriver())
        ->toBeInstanceOf(GeoIpInfoDbInterface::class);
});

it('returns an instance of ip2location when called directly', function () {
    /** @var GeoManager $manager */
    $manager = app(GeoManager::class);

    expect($manager->getIp2locationDriver())
        ->toBeInstanceOf(GeoIp2LocationInterface::class);
});
