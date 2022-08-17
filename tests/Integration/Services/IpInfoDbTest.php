<?php

declare(strict_types=1);

namespace Midnite81\GeoLocation\Tests\Integration;

use Midnite81\GeoLocation\Contracts\Services\IpInfoDbInterface;
use Midnite81\GeoLocation\Responses\IpInfoDbLocationResponse;
use Midnite81\GeoLocation\Tests\TestCase;

uses(TestCase::class);

it('can connect to the api and return ip-location object', function () {
    /** @var IpInfoDbInterface $sut */
    $sut = app(IpInfoDbInterface::class);

    $result = $sut->get('8.8.8.8');

    expect($result)
        ->toBeInstanceOf(IpInfoDbLocationResponse::class)
        ->and($result->statusCode)->toBe('OK')
        ->and($result->statusMessage)->toBe('')
        ->and($result->ipAddress)->toBe('8.8.8.8')
        ->and($result->countryCode)->toBe('US')
        ->and($result->countryName)->toBe('United States of America')
        ->and($result->regionName)->toBe('California')
        ->and($result->cityName)->toBe('Mountain View')
        ->and($result->zipCode)->toBe('94043')
        ->and($result->postcode)->toBe('94043')
        ->and($result->latitude)->toBe('37.406')
        ->and($result->longitude)->toBe('-122.079')
        ->and($result->timeZone)->toBe('-07:00')
        ->and($result->addressString)->toBe('Mountain View, California, United States of America');
});
