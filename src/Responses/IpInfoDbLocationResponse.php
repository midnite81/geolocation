<?php

namespace Midnite81\GeoLocation\Responses;

use Midnite81\Core\Responses\BaseResponse;

class IpInfoDbLocationResponse extends BaseResponse
{
    /**
     * The status code
     *
     * @var string|null
     */
    public readonly ?string $statusCode;

    /**
     * The status message
     *
     * @var string|null
     */
    public readonly ?string $statusMessage;

    /**
     * The IP Address
     *
     * @var string|null
     */
    public readonly ?string $ipAddress;

    /**
     * The code of the country
     *
     * @var string|null
     */
    public readonly ?string $countryCode;

    /**
     * The name of the country
     *
     * @var string|null
     */
    public readonly ?string $countryName;

    /**
     * The name of the region
     *
     * @var string|null
     */
    public readonly ?string $regionName;

    /**
     * The name of the city
     *
     * @var string|null
     */
    public readonly ?string $cityName;

    /**
     * The zip code
     *
     * @var string|null
     */
    public readonly ?string $zipCode;

    /**
     * The postcode (alias of zip code)
     *
     * @var string|null
     */
    public readonly ?string $postcode;

    /**
     * The latitude
     *
     * @var string|null
     */
    public readonly ?string $latitude;

    /**
     * The longitude
     *
     * @var string|null
     */
    public readonly ?string $longitude;

    /**
     * The timezone
     *
     * @var string|null
     */
    public readonly ?string $timeZone;

    /**
     * The address string
     *
     * @var string|null
     */
    public readonly ?string $addressString;

    public function __construct(string|array $data)
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        $this->statusCode = $data['statusCode'] ?? null;
        $this->statusMessage = $data['statusMessage'] ?? null;
        $this->ipAddress = $data['ipAddress'] ?? null;
        $this->countryCode = $data['countryCode'] ?? null;
        $this->countryName = $data['countryName'] ?? null;
        $this->regionName = $data['regionName'] ?? null;
        $this->cityName = $data['cityName'] ?? null;
        $this->zipCode = $data['zipCode'] ?? null;
        $this->postcode = $data['zipCode'] ?? null;
        $this->latitude = $data['latitude'] ?? null;
        $this->longitude = $data['longitude'] ?? null;
        $this->timeZone = $data['timeZone'] ?? null;
        $this->addressString = $this->createAddressString();
        parent::__construct();
    }

    /**
     * Return Address String
     *
     * @return string
     */
    public function createAddressString(): string
    {
        $address = [
            $this->cityName,
            $this->regionName,
            $this->countryName,
        ];

        foreach ($address as $k => $v) {
            if (empty($v)) {
                unset($address[$k]);
            }
        }

        return implode(', ', $address);
    }
}
