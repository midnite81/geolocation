<?php

namespace Midnite81\GeoLocation\Services;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;
use Midnite81\GeoLocation\Contracts\Services\GeoLocationInterface as GeoLocationContract;
use Midnite81\GeoLocation\Exceptions\PrecisionNotKnownException;

class GeoLocation implements GeoLocationContract
{
    protected ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Get IP information
     *
     * @param string $ip
     * @param string $precision
     *
     * @return IpLocation
     * @throws GuzzleException
     * @throws PrecisionNotKnownException
     */
    public function get(string $ip, string $precision = 'city'): IpLocation
    {

        if ($this->acceptedPrecision($precision)) {
            $response = $this->requestData($ip, $precision);

            return $this->formatResponse($response);
        } else {
            throw new PrecisionNotKnownException;
        }
    }

    /**
     * Get IP information with City Precision
     *
     * @param string $ip
     *
     * @return IpLocation
     * @throws GuzzleException
     * @throws PrecisionNotKnownException
     */
    public function getCity(string $ip): IpLocation
    {
        return $this->get($ip, 'city');
    }

    /**
     * Get IP information with Country Precision
     *
     * @param string $ip
     *
     * @return IpLocation
     * @throws GuzzleException
     * @throws PrecisionNotKnownException
     */
    public function getCountry(string $ip): IpLocation
    {
        return $this->get($ip, 'country');
    }

    /**
     * Create a connection url
     *
     * @param string $ip
     * @param string $precision
     *
     * @return string
     */
    protected function getConnectionUrl(string $ip, string $precision = 'city'): string
    {
        $precision = ($precision == 'city') ? 'api-city' : 'api-country';

        $url = [
            config('geolocation.api-url'),
            config('geolocation.api-version'),
            config('geolocation.' . $precision),
        ];

        $queryString = [
            'key' => config('geolocation.api-key'),
            'ip' => $ip,
            'format' => 'json'
        ];

        return implode('/', $url) . '?' . http_build_query($queryString);
    }

    /**
     * Request Data
     *
     * @param string $ip
     * @param string $precision
     *
     * @return string
     * @throws GuzzleException
     */
    protected function requestData(string $ip, string $precision): string
    {

        if (Cache::has('geolocation.' . $this->signature($this->getConnectionUrl($ip, $precision)))) {
            return Cache::get('geolocation.' . $this->signature($this->getConnectionUrl($ip, $precision)));
        } else {
            $result = $this->client->request('get', $this->getConnectionUrl($ip, $precision));

            $body = $result->getBody();

            Cache::put(
                'geolocation.' . $this->signature($this->getConnectionUrl($ip, $precision)),
                (string)$body,
                (int)config('geolocation.cache-duration')
            );

            return (string)$body;
        }
    }

    /**
     * Return the format in an IpLocation Object
     *
     * @param string $response
     *
     * @return IpLocation
     */
    protected function formatResponse(string $response): IpLocation
    {
        return new IpLocation($response);
    }

    /**
     * Checks to see if the precision given is a valid one
     *
     * @param string $precision
     *
     * @return bool
     */
    protected function acceptedPrecision(string $precision): bool
    {
        $acceptedPrecisions = [
            'city',
            'country'
        ];

        return in_array($precision, $acceptedPrecisions);
    }

    /**
     * Returns signature
     *
     * @param string $string
     *
     * @return string
     */
    protected function signature(string $string): string
    {
        return base64_encode($string);
    }
}
