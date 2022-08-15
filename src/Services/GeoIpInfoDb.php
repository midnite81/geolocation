<?php

namespace Midnite81\GeoLocation\Services;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Cache\Repository;
use Midnite81\GeoLocation\Contracts\Services\GeoIpInfoDbInterface;
use Midnite81\GeoLocation\Enums\Precision;
use Midnite81\GeoLocation\Responses\IpInfoDbLocationResponse;

class GeoIpInfoDb implements GeoIpInfoDbInterface
{
    /**
     * GeoLocation constructor.
     *
     * @param  ClientInterface  $client
     * @param  Repository  $cache
     */
    public function __construct(protected ClientInterface $client, protected Repository $cache)
    {
    }

    /**
     * Get IP information
     *
     * @param  string  $ip
     * @param  Precision  $precision
     * @return IpInfoDbLocationResponse
     *
     * @throws GuzzleException
     */
    public function get(string $ip, Precision $precision = Precision::City): IpInfoDbLocationResponse
    {
        $response = $this->requestData($ip, $precision);

        return new IpInfoDbLocationResponse($response);
    }

    /**
     * Get IP information with City Precision
     *
     * @param  string  $ip
     * @return IpInfoDbLocationResponse
     *
     * @throws GuzzleException
     */
    public function getCity(string $ip): IpInfoDbLocationResponse
    {
        return $this->get($ip, Precision::City);
    }

    /**
     * Get IP information with Country Precision
     *
     * @param  string  $ip
     * @return IpInfoDbLocationResponse
     *
     * @throws GuzzleException
     */
    public function getCountry(string $ip): IpInfoDbLocationResponse
    {
        return $this->get($ip, Precision::Country);
    }

    /**
     * Create a connection url
     *
     * @param  string  $ip
     * @param  Precision  $precision
     * @return string
     */
    protected function getConnectionUrl(string $ip, Precision $precision = Precision::City): string
    {
        $precision = ($precision->value == 'city') ? 'api-city' : 'api-country';

        $url = [
            config('geolocation.services.ipinfodb.api-url'),
            config('geolocation.services.ipinfodb.api-version'),
            config('geolocation.services.ipinfodb.' . $precision),
        ];

        $queryString = [
            'key' => config('geolocation.services.ipinfodb.api-key'),
            'ip' => $ip,
            'format' => 'json',
        ];

        return implode('/', $url) . '?' . http_build_query($queryString);
    }

    /**
     * Request Data
     *
     * @param  string  $ip
     * @param  Precision  $precision
     * @return string
     *
     * @throws GuzzleException
     */
    protected function requestData(string $ip, Precision $precision): string
    {
        $cacheKey = 'geolocation.' . $this->signature($this->getConnectionUrl($ip, $precision));

        return $this->cache->remember(
            $cacheKey,
            now()->addSeconds(config('geolocation.cache-duration')),
            function () use ($ip, $precision) {
                $result = $this->client->request('get', $this->getConnectionUrl($ip, $precision));

                return (string) $result->getBody();
            }
        );
    }

    /**
     * Returns signature
     *
     * @param  string  $string
     * @return string
     */
    protected function signature(string $string): string
    {
        return base64_encode($string);
    }
}
