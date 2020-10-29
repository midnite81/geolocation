<?php

namespace Midnite81\GeoLocation\Contracts\Services;

use Midnite81\GeoLocation\Services\IpLocation;

interface GeoLocationInterface
{
    /**
     * Get IP information
     *
     * @param  $ip
     * @param  $precision
     * @return IpLocation
     */
    public function get(string $ip, string $precision = 'city');

    /**
     * Get IP information with City Precision
     *
     * @param  $ip
     * @return IpLocation
     */
    public function getCity(string $ip);

    /**
     * Get IP information with Country Precision
     *
     * @param  $ip
     * @return IpLocation
     */
    public function getCountry(string $ip);
}
