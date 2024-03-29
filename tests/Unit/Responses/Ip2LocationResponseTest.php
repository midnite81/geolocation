<?php

declare(strict_types=1);

use Midnite81\GeoLocation\Responses\Ip2Location\CityResponse;
use Midnite81\GeoLocation\Responses\Ip2Location\ContinentResponse;
use Midnite81\GeoLocation\Responses\Ip2Location\CountryResponse;
use Midnite81\GeoLocation\Responses\Ip2Location\CurrencyResponse;
use Midnite81\GeoLocation\Responses\Ip2Location\GeoTargetingResponse;
use Midnite81\GeoLocation\Responses\Ip2Location\LanguageResponse;
use Midnite81\GeoLocation\Responses\Ip2Location\ProxyResponse;
use Midnite81\GeoLocation\Responses\Ip2Location\RegionResponse;
use Midnite81\GeoLocation\Responses\Ip2Location\TimeZoneResponse;
use Midnite81\GeoLocation\Responses\Ip2Location\TranslationResponse;
use Midnite81\GeoLocation\Responses\Ip2LocationResponse;

beforeEach(function () {
    $this->freeResponse = file_get_contents(__DIR__ . '/../../fixtures/ip2location_free.json');
    $this->starterResponse = file_get_contents(__DIR__ . '/../../fixtures/ip2location_starter.json');
    $this->plusResponse = file_get_contents(__DIR__ . '/../../fixtures/ip2location_plus.json');
    $this->securityResponse = file_get_contents(__DIR__ . '/../../fixtures/ip2location_security.json');
});

it('can construct correctly with free response', function () {
    $response = new Ip2LocationResponse($this->freeResponse);
    expect($response)
        ->toBeInstanceOf(Ip2LocationResponse::class)
        ->and($response->ip)->toBe('8.8.8.8')
        ->and($response->countryCode)->toBe('US')
        ->and($response->countryName)->toBe('United States of America')
        ->and($response->regionName)->toBe('California')
        ->and($response->cityName)->toBe('Mountain View')
        ->and($response->latitude)->toBe(37.405992)
        ->and($response->longitude)->toBe(-122.078515)
        ->and($response->zipCode)->toBe('94043')
        ->and($response->timeZone)->toBe('-07:00')
        ->and($response->asn)->toBe('15169')
        ->and($response->as)->toBe('Google LLC')
        ->and($response->isp)->toBeNull()
        ->and($response->domain)->toBeNull()
        ->and($response->netSpeed)->toBeNull()
        ->and($response->iddCode)->toBeNull()
        ->and($response->areaCode)->toBeNull()
        ->and($response->weatherStationCode)->toBeNull()
        ->and($response->weatherStationName)->toBeNull()
        ->and($response->mcc)->toBeNull()
        ->and($response->mnc)->toBeNull()
        ->and($response->mobileBrand)->toBeNull()
        ->and($response->elevation)->toBeNull()
        ->and($response->usageType)->toBeNull()
        ->and($response->addressType)->toBeNull()
        ->and($response->continent)->toBeInstanceOf(ContinentResponse::class)
        ->and($response->continent->name)->toBeNull()
        ->and($response->continent->code)->toBeNull()
        ->and($response->continent->hemisphere)->toBeNull()
        ->and($response->continent->translation)->toBeInstanceOf(TranslationResponse::class)
        ->and($response->continent->translation->language)->toBeNull()
        ->and($response->continent->translation->value)->toBeNull()
        ->and($response->country)->toBeInstanceOf(CountryResponse::class)
        ->and($response->country->name)->toBeNull()
        ->and($response->country->alpha3Code)->toBeNull()
        ->and($response->country->numericCode)->toBeNull()
        ->and($response->country->demonym)->toBeNull()
        ->and($response->country->flag)->toBeNull()
        ->and($response->country->capital)->toBeNull()
        ->and($response->country->totalArea)->toBeNull()
        ->and($response->country->population)->toBeNull()
        ->and($response->country->currency)->toBeInstanceOf(CurrencyResponse::class)
        ->and($response->country->currency->code)->toBeNull()
        ->and($response->country->currency->name)->toBeNull()
        ->and($response->country->currency->symbol)->toBeNull()
        ->and($response->country->language)->toBeInstanceOf(LanguageResponse::class)
        ->and($response->country->language->code)->toBeNull()
        ->and($response->country->language->name)->toBeNull()
        ->and($response->country->tld)->toBeNull()
        ->and($response->country->translation)->toBeInstanceOf(TranslationResponse::class)
        ->and($response->country->translation->language)->toBeNull()
        ->and($response->country->translation->value)->toBeNull()
        ->and($response->region)->toBeInstanceOf(RegionResponse::class)
        ->and($response->region->name)->toBeNull()
        ->and($response->region->code)->toBeNull()
        ->and($response->region->translation)->toBeInstanceOf(TranslationResponse::class)
        ->and($response->region->translation->language)->toBeNull()
        ->and($response->region->translation->value)->toBeNull()
        ->and($response->city)->toBeInstanceOf(CityResponse::class)
        ->and($response->city->name)->toBeNull()
        ->and($response->city->translation)->toBeInstanceOf(TranslationResponse::class)
        ->and($response->city->translation->language)->toBeNull()
        ->and($response->city->translation->value)->toBeNull()
        ->and($response->timeZoneInfo)->toBeInstanceOf(TimeZoneResponse::class)
        ->and($response->timeZoneInfo->olson)->toBeNull()
        ->and($response->timeZoneInfo->currentTime)->toBeNull()
        ->and($response->timeZoneInfo->gmtOffset)->toBeNull()
        ->and($response->timeZoneInfo->isDst)->toBeNull()
        ->and($response->timeZoneInfo->sunrise)->toBeNull()
        ->and($response->timeZoneInfo->sunset)->toBeNull()
        ->and($response->geoTargeting)->toBeInstanceOf(GeoTargetingResponse::class)
        ->and($response->geoTargeting->metro)->toBeNull()
        ->and($response->adsCategory)->toBeNull()
        ->and($response->adsCategoryName)->toBeNull()
        ->and($response->isProxy)->toBeFalse()
        ->and($response->proxy)->toBeInstanceOf(ProxyResponse::class)
        ->and($response->proxy->lastSeen)->toBeNull()
        ->and($response->proxy->proxyType)->toBeNull()
        ->and($response->proxy->provider)->toBeNull()
        ->and($response->proxy->threat)->toBeNull()
        ->and($response->addressString)->toBe('Mountain View, California, United States of America');
});

it('can construct correctly with starter response', function () {
    $response = new Ip2LocationResponse($this->starterResponse);
    expect($response)
        ->toBeInstanceOf(Ip2LocationResponse::class)
        ->and($response->ip)->toBe('8.8.8.8')
        ->and($response->countryCode)->toBe('US')
        ->and($response->countryName)->toBe('United States of America')
        ->and($response->regionName)->toBe('California')
        ->and($response->cityName)->toBe('Mountain View')
        ->and($response->latitude)->toBe(37.405992)
        ->and($response->longitude)->toBe(-122.078515)
        ->and($response->zipCode)->toBe('94043')
        ->and($response->timeZone)->toBe('-07:00')
        ->and($response->asn)->toBe('15169')
        ->and($response->as)->toBe('Google LLC')
        ->and($response->isp)->toBe('Google LLC')
        ->and($response->domain)->toBe('google.com')
        ->and($response->netSpeed)->toBe('T1')
        ->and($response->iddCode)->toBe('1')
        ->and($response->areaCode)->toBe('650')
        ->and($response->weatherStationCode)->toBe('USCA0746')
        ->and($response->weatherStationName)->toBe('Mountain View')
        ->and($response->mcc)->toBeNull()
        ->and($response->mnc)->toBeNull()
        ->and($response->mobileBrand)->toBeNull()
        ->and($response->elevation)->toBe(32)
        ->and($response->usageType)->toBe('DCH')
        ->and($response->addressType)->toBeNull()
        ->and($response->continent)->toBeInstanceOf(ContinentResponse::class)
        ->and($response->continent->name)->toBeNull()
        ->and($response->continent->code)->toBeNull()
        ->and($response->continent->hemisphere)->toBeNull()
        ->and($response->continent->translation)->toBeInstanceOf(TranslationResponse::class)
        ->and($response->continent->translation->language)->toBeNull()
        ->and($response->continent->translation->value)->toBeNull()
        ->and($response->country)->toBeInstanceOf(CountryResponse::class)
        ->and($response->country->name)->toBeNull()
        ->and($response->country->alpha3Code)->toBeNull()
        ->and($response->country->numericCode)->toBeNull()
        ->and($response->country->demonym)->toBeNull()
        ->and($response->country->flag)->toBeNull()
        ->and($response->country->capital)->toBeNull()
        ->and($response->country->totalArea)->toBeNull()
        ->and($response->country->population)->toBeNull()
        ->and($response->country->currency)->toBeInstanceOf(CurrencyResponse::class)
        ->and($response->country->currency->code)->toBeNull()
        ->and($response->country->currency->name)->toBeNull()
        ->and($response->country->currency->symbol)->toBeNull()
        ->and($response->country->language)->toBeInstanceOf(LanguageResponse::class)
        ->and($response->country->language->code)->toBeNull()
        ->and($response->country->language->name)->toBeNull()
        ->and($response->country->tld)->toBeNull()
        ->and($response->country->translation)->toBeInstanceOf(TranslationResponse::class)
        ->and($response->country->translation->language)->toBeNull()
        ->and($response->country->translation->value)->toBeNull()
        ->and($response->region)->toBeInstanceOf(RegionResponse::class)
        ->and($response->region->name)->toBeNull()
        ->and($response->region->code)->toBeNull()
        ->and($response->region->translation)->toBeInstanceOf(TranslationResponse::class)
        ->and($response->region->translation->language)->toBeNull()
        ->and($response->region->translation->value)->toBeNull()
        ->and($response->city)->toBeInstanceOf(CityResponse::class)
        ->and($response->city->name)->toBeNull()
        ->and($response->city->translation)->toBeInstanceOf(TranslationResponse::class)
        ->and($response->city->translation->language)->toBeNull()
        ->and($response->city->translation->value)->toBeNull()
        ->and($response->timeZoneInfo)->toBeInstanceOf(TimeZoneResponse::class)
        ->and($response->timeZoneInfo->olson)->toBeNull()
        ->and($response->timeZoneInfo->currentTime)->toBeNull()
        ->and($response->timeZoneInfo->gmtOffset)->toBeNull()
        ->and($response->timeZoneInfo->isDst)->toBeNull()
        ->and($response->timeZoneInfo->sunrise)->toBeNull()
        ->and($response->timeZoneInfo->sunset)->toBeNull()
        ->and($response->geoTargeting)->toBeInstanceOf(GeoTargetingResponse::class)
        ->and($response->geoTargeting->metro)->toBeNull()
        ->and($response->adsCategory)->toBeNull()
        ->and($response->adsCategoryName)->toBeNull()
        ->and($response->isProxy)->toBeFalse()
        ->and($response->proxy)->toBeInstanceOf(ProxyResponse::class)
        ->and($response->proxy->lastSeen)->toBeNull()
        ->and($response->proxy->proxyType)->toBeNull()
        ->and($response->proxy->provider)->toBeNull()
        ->and($response->proxy->threat)->toBeNull()
        ->and($response->addressString)->toBe('Mountain View, California, United States of America');
});

it('can construct correctly with plus response', function () {
    $response = new Ip2LocationResponse($this->plusResponse);
    expect($response)
        ->toBeInstanceOf(Ip2LocationResponse::class)
        ->and($response->ip)->toBe('8.8.8.8')
        ->and($response->countryCode)->toBe('US')
        ->and($response->countryName)->toBe('United States of America')
        ->and($response->regionName)->toBe('California')
        ->and($response->cityName)->toBe('Mountain View')
        ->and($response->latitude)->toBe(37.405992)
        ->and($response->longitude)->toBe(-122.078515)
        ->and($response->zipCode)->toBe('94043')
        ->and($response->timeZone)->toBe('-07:00')
        ->and($response->asn)->toBe('15169')
        ->and($response->as)->toBe('Google LLC')
        ->and($response->isp)->toBe('Google LLC')
        ->and($response->domain)->toBe('google.com')
        ->and($response->netSpeed)->toBe('T1')
        ->and($response->iddCode)->toBe('1')
        ->and($response->areaCode)->toBe('650')
        ->and($response->weatherStationCode)->toBe('USCA0746')
        ->and($response->weatherStationName)->toBe('Mountain View')
        ->and($response->mcc)->toBe('-')
        ->and($response->mnc)->toBe('-')
        ->and($response->mobileBrand)->toBe('-')
        ->and($response->elevation)->toBe(32)
        ->and($response->usageType)->toBe('DCH')
        ->and($response->addressType)->toBe('Anycast')
        ->and($response->continent)->toBeInstanceOf(ContinentResponse::class)
        ->and($response->continent->name)->toBe('North America')
        ->and($response->continent->code)->toBe('NA')
        ->and($response->continent->hemisphere)->toBeArray()->toContain('north')->toContain('west')
        ->and($response->continent->translation)->toBeInstanceOf(TranslationResponse::class)
        ->and($response->continent->translation->language)->toBe('ko')
        ->and($response->continent->translation->value)->toBe('북아메리카')
        ->and($response->country)->toBeInstanceOf(CountryResponse::class)
        ->and($response->country->name)->toBe('United States of America')
        ->and($response->country->alpha3Code)->toBe('USA')
        ->and($response->country->numericCode)->toBe(840)
        ->and($response->country->demonym)->toBe('Americans')
        ->and($response->country->flag)->toBe('https://cdn.ip2location.io/assets/img/flags/us.png')
        ->and($response->country->capital)->toBe('Washington, D.C.')
        ->and($response->country->totalArea)->toBe(9826675)
        ->and($response->country->population)->toBe(331002651)
        ->and($response->country->currency)->toBeInstanceOf(CurrencyResponse::class)
        ->and($response->country->currency->code)->toBe('USD')
        ->and($response->country->currency->name)->toBe('United States Dollar')
        ->and($response->country->currency->symbol)->toBe('$')
        ->and($response->country->language)->toBeInstanceOf(LanguageResponse::class)
        ->and($response->country->language->code)->toBe('EN')
        ->and($response->country->language->name)->toBe('English')
        ->and($response->country->tld)->toBe('us')
        ->and($response->country->translation)->toBeInstanceOf(TranslationResponse::class)
        ->and($response->country->translation->language)->toBe('ko')
        ->and($response->country->translation->value)->toBe('미국')
        ->and($response->region)->toBeInstanceOf(RegionResponse::class)
        ->and($response->region->name)->toBe('California')
        ->and($response->region->code)->toBe('US-CA')
        ->and($response->region->translation)->toBeInstanceOf(TranslationResponse::class)
        ->and($response->region->translation->language)->toBe('ko')
        ->and($response->region->translation->value)->toBe('캘리포니아주')
        ->and($response->city)->toBeInstanceOf(CityResponse::class)
        ->and($response->city->name)->toBe('Mountain View')
        ->and($response->city->translation)->toBeInstanceOf(TranslationResponse::class)
        ->and($response->city->translation->language)->toBeNull()
        ->and($response->city->translation->value)->toBeNull()
        ->and($response->timeZoneInfo)->toBeInstanceOf(TimeZoneResponse::class)
        ->and($response->timeZoneInfo->olson)->toBe('America/Los_Angeles')
        ->and($response->timeZoneInfo->currentTime)->toBe('2022-04-18T23:13:19-07:00')
        ->and($response->timeZoneInfo->gmtOffset)->toBe(-25200)
        ->and($response->timeZoneInfo->isDst)->toBeTrue()
        ->and($response->timeZoneInfo->sunrise)->toBe('06:27')
        ->and($response->timeZoneInfo->sunset)->toBe('19:47')
        ->and($response->geoTargeting)->toBeInstanceOf(GeoTargetingResponse::class)
        ->and($response->geoTargeting->metro)->toBe('807')
        ->and($response->adsCategory)->toBeNull()
        ->and($response->adsCategoryName)->toBeNull()
        ->and($response->isProxy)->toBeFalse()
        ->and($response->proxy)->toBeInstanceOf(ProxyResponse::class)
        ->and($response->proxy->lastSeen)->toBeNull()
        ->and($response->proxy->proxyType)->toBeNull()
        ->and($response->proxy->provider)->toBeNull()
        ->and($response->proxy->threat)->toBeNull()
        ->and($response->addressString)->toBe('Mountain View, California, United States of America');
});

it('can construct correctly with security response', function () {
    $response = new Ip2LocationResponse($this->securityResponse);
    expect($response)
        ->toBeInstanceOf(Ip2LocationResponse::class)
        ->and($response->ip)->toBe('8.8.8.8')
        ->and($response->countryCode)->toBe('US')
        ->and($response->countryName)->toBe('United States of America')
        ->and($response->regionName)->toBe('California')
        ->and($response->cityName)->toBe('Mountain View')
        ->and($response->latitude)->toBe(37.405992)
        ->and($response->longitude)->toBe(-122.078515)
        ->and($response->zipCode)->toBe('94043')
        ->and($response->timeZone)->toBe('-07:00')
        ->and($response->asn)->toBe('15169')
        ->and($response->as)->toBe('Google LLC')
        ->and($response->isp)->toBe('Google LLC')
        ->and($response->domain)->toBe('google.com')
        ->and($response->netSpeed)->toBe('T1')
        ->and($response->iddCode)->toBe('1')
        ->and($response->areaCode)->toBe('650')
        ->and($response->weatherStationCode)->toBe('USCA0746')
        ->and($response->weatherStationName)->toBe('Mountain View')
        ->and($response->mcc)->toBe('-')
        ->and($response->mnc)->toBe('-')
        ->and($response->mobileBrand)->toBe('-')
        ->and($response->elevation)->toBe(32)
        ->and($response->usageType)->toBe('DCH')
        ->and($response->addressType)->toBe('Anycast')
        ->and($response->continent)->toBeInstanceOf(ContinentResponse::class)
        ->and($response->continent->name)->toBe('North America')
        ->and($response->continent->code)->toBe('NA')
        ->and($response->continent->hemisphere)->toBeArray()->toContain('north')->toContain('west')
        ->and($response->continent->translation)->toBeInstanceOf(TranslationResponse::class)
        ->and($response->continent->translation->language)->toBe('ko')
        ->and($response->continent->translation->value)->toBe('북아메리카')
        ->and($response->country)->toBeInstanceOf(CountryResponse::class)
        ->and($response->country->name)->toBe('United States of America')
        ->and($response->country->alpha3Code)->toBe('USA')
        ->and($response->country->numericCode)->toBe(840)
        ->and($response->country->demonym)->toBe('Americans')
        ->and($response->country->flag)->toBe('https://cdn.ip2location.io/assets/img/flags/us.png')
        ->and($response->country->capital)->toBe('Washington, D.C.')
        ->and($response->country->totalArea)->toBe(9826675)
        ->and($response->country->population)->toBe(331002651)
        ->and($response->country->currency)->toBeInstanceOf(CurrencyResponse::class)
        ->and($response->country->currency->code)->toBe('USD')
        ->and($response->country->currency->name)->toBe('United States Dollar')
        ->and($response->country->currency->symbol)->toBe('$')
        ->and($response->country->language)->toBeInstanceOf(LanguageResponse::class)
        ->and($response->country->language->code)->toBe('EN')
        ->and($response->country->language->name)->toBe('English')
        ->and($response->country->tld)->toBe('us')
        ->and($response->country->translation)->toBeInstanceOf(TranslationResponse::class)
        ->and($response->country->translation->language)->toBe('ko')
        ->and($response->country->translation->value)->toBe('미국')
        ->and($response->region)->toBeInstanceOf(RegionResponse::class)
        ->and($response->region->name)->toBe('California')
        ->and($response->region->code)->toBe('US-CA')
        ->and($response->region->translation)->toBeInstanceOf(TranslationResponse::class)
        ->and($response->region->translation->language)->toBe('ko')
        ->and($response->region->translation->value)->toBe('캘리포니아주')
        ->and($response->city)->toBeInstanceOf(CityResponse::class)
        ->and($response->city->name)->toBe('Mountain View')
        ->and($response->city->translation)->toBeInstanceOf(TranslationResponse::class)
        ->and($response->city->translation->language)->toBeNull()
        ->and($response->city->translation->value)->toBeNull()
        ->and($response->timeZoneInfo)->toBeInstanceOf(TimeZoneResponse::class)
        ->and($response->timeZoneInfo->olson)->toBe('America/Los_Angeles')
        ->and($response->timeZoneInfo->currentTime)->toBe('2022-04-18T23:41:57-07:00')
        ->and($response->timeZoneInfo->gmtOffset)->toBe(-25200)
        ->and($response->timeZoneInfo->isDst)->toBeTrue()
        ->and($response->timeZoneInfo->sunrise)->toBe('06:27')
        ->and($response->timeZoneInfo->sunset)->toBe('19:47')
        ->and($response->geoTargeting)->toBeInstanceOf(GeoTargetingResponse::class)
        ->and($response->geoTargeting->metro)->toBe('807')
        ->and($response->adsCategory)->toBe('IAB19')
        ->and($response->adsCategoryName)->toBe('Technology & Computing')
        ->and($response->isProxy)->toBeFalse()
        ->and($response->proxy)->toBeInstanceOf(ProxyResponse::class)
        ->and($response->proxy->lastSeen)->toBe(18)
        ->and($response->proxy->proxyType)->toBe('DCH')
        ->and($response->proxy->provider)->toBe('-')
        ->and($response->proxy->threat)->toBe('-')
        ->and($response->addressString)->toBe('Mountain View, California, United States of America');
});
