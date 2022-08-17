<?php

namespace Midnite81\GeoLocation\Services;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Cache\Repository;
use Illuminate\Support\Str;
use Midnite81\GeoLocation\Contracts\Services\Ip2LocationInterface;
use Midnite81\GeoLocation\Enums\Language;
use Midnite81\GeoLocation\Exceptions\Ip2Location\InternalServerException;
use Midnite81\GeoLocation\Exceptions\Ip2Location\InvalidApiException;
use Midnite81\GeoLocation\Exceptions\Ip2Location\InvalidIpException;
use Midnite81\GeoLocation\Exceptions\Ip2Location\InvalidLanguageCodeException;
use Midnite81\GeoLocation\Exceptions\Ip2Location\RetrievalException;
use Midnite81\GeoLocation\Exceptions\Ip2Location\TranslationNotAvailableException;
use Midnite81\GeoLocation\Responses\Ip2LocationResponse;

class Ip2Location implements Ip2LocationInterface
{
    protected ClientInterface $client;

    protected Repository $cache;

    /**
     * GeoLocation constructor.
     *
     * @param  ClientInterface  $client
     * @param  Repository  $cache
     */
    public function __construct(ClientInterface $client, Repository $cache)
    {
        $this->client = $client;
        $this->cache = $cache;
    }

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
     * @throws RetrievalException
     */
    public function get(string $ip, ?Language $language = null): Ip2LocationResponse
    {
        $response = $this->requestData($ip, $language);

        return new Ip2LocationResponse($response);
    }

    /**
     * Create a connection url
     *
     * @param  string  $ip
     * @param  Language|null  $language
     * @return string
     */
    protected function getConnectionUrl(string $ip, ?Language $language = null): string
    {
        $template = '{baseUrl}/?key={apiKey}&ip={ipAddress}&format=json{language}';
        $url = config('geolocation.services.ip2location.api-url');
        $apiKey = config('geolocation.services.ip2location.api-key');
        $language = $language !== null ? '&lang=' . $language->value : '';

        return Str::of($template)
                  ->replace('{baseUrl}', $url)
                  ->replace('{apiKey}', $apiKey)
                  ->replace('{ipAddress}', $ip)
                  ->replace('{language}', $language)
                  ->toHtmlString();
    }

    /**
     * Request Data
     *
     * @param  string  $ip
     * @param  Language|null  $language
     * @return string
     *
     * @throws GuzzleException
     * @throws InternalServerException
     * @throws InvalidApiException
     * @throws InvalidIpException
     * @throws InvalidLanguageCodeException
     * @throws TranslationNotAvailableException
     * @throws RetrievalException
     */
    protected function requestData(string $ip, ?Language $language = null): string
    {
        $cacheKey = 'geolocation.' . $this->signature($this->getConnectionUrl($ip, $language));
        $cacheDuration = config('geolocation.cache-duration');

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        try {
            $response = $this->client->request('get', $this->getConnectionUrl($ip, $language));
            $this->cache->put(
                $cacheKey,
                $response->getBody()->getContents(),
                now()->addSeconds($cacheDuration),
            );
        } catch (ClientException $e) {
            $contents = $e->getResponse()->getBody()->getContents();
            $error = json_decode($contents);

            match ($error->error->error_code) {
                10000 => throw new InvalidApiException(previous:  $e),
                10001 => throw new InvalidIpException(previous:  $e),
                10002 => throw new InternalServerException(previous:  $e),
                10003 => throw new InvalidLanguageCodeException(previous:  $e),
                10004 => throw new TranslationNotAvailableException(previous:  $e),
                default => throw new RetrievalException(previous:  $e),
            };
        }

        return (string) $response->getBody();
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
