<?php

declare(strict_types=1);

namespace Midnite81\GeoLocation\Tests\Integration;

use Midnite81\GeoLocation\Contracts\Services\Ip2LocationInterface;
use Midnite81\GeoLocation\Exceptions\Ip2Location\InvalidApiException;
use Midnite81\GeoLocation\Responses\Ip2LocationResponse;
use Midnite81\GeoLocation\Tests\TestCase;

uses(TestCase::class);

it('can connect to the api and return ip-location object', function () {
    /** @var Ip2LocationInterface $sut */
    $sut = app(Ip2LocationInterface::class);

    $result = $sut->get('8.8.8.8');

    expect($result)
        ->toBeInstanceOf(Ip2LocationResponse::class)
        ->and($result->ip)->toBe('8.8.8.8')
        ->and($result->countryCode)->toBe('US')
        ->and($result->countryName)->toBe('United States of America')
        ->and($result->regionName)->toBe('California')
        ->and($result->cityName)->toBe('Mountain View')
        ->and($result->latitude)->toBe(37.405992)
        ->and($result->longitude)->toBe(-122.078515)
        ->and($result->zipCode)->toBe('94043')
        ->and($result->timeZone)->toBe('-07:00')
        ->and($result->asn)->toBe('15169')
        ->and($result->as)->toBe('Google LLC')
        ->and($result->isp)->toBeNull()
        ->and($result->domain)->toBeNull()
        ->and($result->netSpeed)->toBeNull()
        ->and($result->iddCode)->toBeNull()
        ->and($result->areaCode)->toBeNull()
        ->and($result->weatherStationCode)->toBeNull()
        ->and($result->weatherStationName)->toBeNull()
        ->and($result->mcc)->toBeNull()
        ->and($result->mnc)->toBeNull()
        ->and($result->mobileBrand)->toBeNull()
        ->and($result->elevation)->toBeNull()
        ->and($result->usageType)->toBeNull()
        ->and($result->addressType)->toBeNull()
        ->and($result->continent->name)->toBeNull()
        ->and($result->country->name)->toBeNull()
        ->and($result->region->name)->toBeNull()
        ->and($result->city->name)->toBeNull()
        ->and($result->timeZoneInfo->olson)->toBeNull()
        ->and($result->geoTargeting->metro)->toBeNull()
        ->and($result->adsCategory)->toBeNull()
        ->and($result->adsCategoryName)->toBeNull()
        ->and($result->isProxy)->toBeFalse()
        ->and($result->proxy->lastSeen)->toBeNull();
});

it('can throws and exception when invalid api key', function () {
    config()->set('geolocation.services.ip2location.api-key', 'abc');

    /** @var Ip2LocationInterface $sut */
    $sut = app(Ip2LocationInterface::class);

    $sut->get('8.8.8.8');
})->throws(InvalidApiException::class);
