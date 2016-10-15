<?php

namespace Midnite81\GeoLocation\Contracts\Services;

interface GeoLocation
{

    /**
     * Get IP information
     *
     * @param $ip
     * @param $precision
     * @return Midnite81\GeoLocation\Services\IpLocation
     */
    public function get($ip, $precision);

    /**
     * Get IP information with City Precision
     *
     * @param $ip
     * @return IpLocation
     */
    public function getCity($ip);

    /**
     * Get IP information with Country Precision
     *
     * @param $ip
     * @return IpLocation
     */
    public function getCountry($ip);

}