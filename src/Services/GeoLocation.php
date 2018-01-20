<?php
namespace Midnite81\GeoLocation\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Midnite81\GeoLocation\Contracts\Services\GeoLocation as GeoLocationContract;
use Midnite81\GeoLocation\Exceptions\PrecisionNotKnownException;

class GeoLocation implements GeoLocationContract
{

    /**
     * Get IP information
     *
     * @param $ip
     * @param $precision
     * @return IpLocation
     * @throws PrecisionNotKnownException
     */
    public function get($ip, $precision = 'city')
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
     * @param $ip
     * @return IpLocation
     * @throws PrecisionNotKnownException
     */
    public function getCity($ip)
    {
        return $this->get($ip, 'city');
    }

    /**
     * Get IP information with Country Precision
     *
     * @param $ip
     * @return IpLocation
     * @throws PrecisionNotKnownException
     */
    public function getCountry($ip)
    {
        return $this->get($ip, 'country');
    }

    /**
     * Request Data
     *
     * @param $ip
     * @param $precision
     * @return \Psr\Http\Message\StreamInterface
     * @codeCoverageIgnore
     */
    protected function requestData($ip, $precision)
    {

        if (Cache::has('geolocation.' . $this->signature($this->getConnectionUrl($ip, $precision)))) {

            return Cache::get('geolocation.' . $this->signature($this->getConnectionUrl($ip, $precision)));

        } else {

            $client = new Client();

            $result = $client->request('get', $this->getConnectionUrl($ip, $precision));

            $body = $result->getBody();

            Cache::put('geolocation.' . $this->signature($this->getConnectionUrl($ip, $precision)),
                        (string)$body,
                        (int)config('geolocation.cache-duration'));

            return (string)$body;
        }


    }

    /**
     * Create a connection url
     *
     * @param $ip
     * @param string $precision
     * @return string
     * @codeCoverageIgnore
     */
    protected function getConnectionUrl($ip, $precision = 'city')
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
     * Return the format in an IpLocation Object
     *
     * @param $response
     * @return IpLocation
     */
    protected function formatResponse($response)
    {
        $ip = new IpLocation($response);

        return $ip;
    }

    /**
     * Checks to see if the precision given is a valid one
     *
     * @param $precision
     * @return bool
     */
    protected function acceptedPrecision($precision)
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
     * @param $string
     * @return string
     * @codeCoverageIgnore
     */
    protected function signature($string)
    {
        return base64_encode($string);
    }

}