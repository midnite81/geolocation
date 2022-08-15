<?php

namespace Midnite81\GeoLocation\Contracts\Services;

use GuzzleHttp\Exception\GuzzleException;
use Midnite81\GeoLocation\Enums\Precision;
use Midnite81\GeoLocation\Responses\IpInfoDbLocationResponse;

interface GeoIpInfoDbInterface
{
    /**
     * Get IP information
     *
     * @param  string  $ip
     * @param  Precision  $precision
     * @return IpInfoDbLocationResponse
     *
     * @throws GuzzleException
     */
    public function get(string $ip, Precision $precision = Precision::City): IpInfoDbLocationResponse;

    /**
     * Get IP information with City Precision
     *
     * @param  string  $ip
     * @return IpInfoDbLocationResponse
     *
     * @throws GuzzleException
     */
    public function getCity(string $ip): IpInfoDbLocationResponse;

    /**
     * Get IP information with Country Precision
     *
     * @param  string  $ip
     * @return IpInfoDbLocationResponse
     *
     * @throws GuzzleException
     */
    public function getCountry(string $ip): IpInfoDbLocationResponse;
}
