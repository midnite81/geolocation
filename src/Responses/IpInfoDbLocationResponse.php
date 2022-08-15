<?php

namespace Midnite81\GeoLocation\Responses;

use Midnite81\Core\Responses\BaseResponse;

class IpInfoDbLocationResponse extends BaseResponse
{
    public readonly ?string $statusCode;

    public readonly ?string $statusMessage;

    public readonly ?string $ipAddress;

    public readonly ?string $countryCode;

    public readonly ?string $countryName;

    public readonly ?string $regionName;

    public readonly ?string $cityName;

    public readonly ?string $zipCode;

    public readonly ?string $postcode;

    public readonly ?string $latitude;

    public readonly ?string $longitude;

    public readonly ?string $timeZone;

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
