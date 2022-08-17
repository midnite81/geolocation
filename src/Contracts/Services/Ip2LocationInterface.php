<?php

namespace Midnite81\GeoLocation\Contracts\Services;

use GuzzleHttp\Exception\GuzzleException;
use Midnite81\GeoLocation\Enums\Language;
use Midnite81\GeoLocation\Exceptions\Ip2Location\InternalServerException;
use Midnite81\GeoLocation\Exceptions\Ip2Location\InvalidApiException;
use Midnite81\GeoLocation\Exceptions\Ip2Location\InvalidIpException;
use Midnite81\GeoLocation\Exceptions\Ip2Location\InvalidLanguageCodeException;
use Midnite81\GeoLocation\Exceptions\Ip2Location\TranslationNotAvailableException;
use Midnite81\GeoLocation\Responses\Ip2LocationResponse;

interface Ip2LocationInterface
{
    /**
     * Get IP information
     *
     * @param  string  $ip
     * @param  Language|null  $language
     * @return Ip2LocationResponse
     *
     * @throws GuzzleException
     * @throws InternalServerException
     * @throws InvalidApiException
     * @throws InvalidIpException
     * @throws InvalidLanguageCodeException
     * @throws TranslationNotAvailableException
     */
    public function get(string $ip, ?Language $language = null): Ip2LocationResponse;
}
