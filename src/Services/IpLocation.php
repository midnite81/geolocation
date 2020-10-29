<?php
namespace Midnite81\GeoLocation\Services;

class IpLocation
{
    public string $statusCode = "";
    public string $statusMessage = "";
    public string $ipAddress = "";
    public string $countryCode = "";
    public string $countryName = "";
    public string $regionName = "";
    public string $cityName = "";
    public string $zipCode = "";
    public string $latitude = "";
    public string $longitude = "";
    public string $timeZone = "";
    public string $addressString = "";

    /**
     * IpLocation constructor.
     *
     * @param string|null $response
     */
    public function __construct(?string $response = null)
    {
        if (! empty($response)) {
            $this->parseData($response);
        }
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
            $this->countryName
        ];

        foreach ($address as $k => $v) {
            if (empty($v)) {
                unset($address[$k]);
            }
        }

        return implode(', ', $address);
    }

    /**
     * Returns the class properties as an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * Object variables as Json String
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * Get the status code
     *
     * @return string
     */
    public function getStatusCode(): string
    {
        return $this->statusCode;
    }

    /**
     * Set the status code
     *
     * @param string $statusCode
     *
     * @return IpLocation
     */
    public function setStatusCode(string $statusCode): IpLocation
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Get the status message
     *
     * @return string
     */
    public function getStatusMessage(): string
    {
        return $this->statusMessage;
    }

    /**
     * Sets the status message
     *
     * @param string $statusMessage
     *
     * @return IpLocation
     */
    public function setStatusMessage(string $statusMessage): IpLocation
    {
        $this->statusMessage = $statusMessage;
        return $this;
    }

    /**
     * Get the IP address
     *
     * @return string
     */
    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    /**
     * Sets the IP address
     *
     * @param  string $ipAddress
     * @return IpLocation
     */
    public function setIpAddress(string $ipAddress): IpLocation
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }

    /**
     * Gets the country code of the IP
     *
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @param  string $countryCode
     * @return IpLocation
     */
    public function setCountryCode(string $countryCode): IpLocation
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * Gets the country name of the IP
     *
     * @return string
     */
    public function getCountryName(): string
    {
        return $this->countryName;
    }

    /**
     * Sets the country name of the IP
     *
     * @param  string $countryName
     * @return IpLocation
     */
    public function setCountryName(string $countryName): IpLocation
    {
        $this->countryName = $countryName;
        return $this;
    }


    /**
     * Gets the name of the IP
     *
     * @return string
     */
    public function getRegionName(): string
    {
        return $this->regionName;
    }

    /**
     * Sets the region of the IP
     *
     * @param  string $regionName
     * @return IpLocation
     */
    public function setRegionName(string $regionName): IpLocation
    {
        $this->regionName = $regionName;
        return $this;
    }

    /**
     * Gets the city name of the IP
     *
     * @return string
     */
    public function getCityName(): string
    {
        return $this->cityName;
    }

    /**
     * Set the City Name of the IP
     *
     * @param  string $cityName
     * @return IpLocation
     */
    public function setCityName(string $cityName): IpLocation
    {
        $this->cityName = $cityName;
        return $this;
    }

    /**
     * Get Post Code of the IP
     *
     * @return string
     */
    public function getPostCode(): string
    {
        return $this->zipCode;
    }

    /**
     * Get Zip Code of the IP
     *
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param  string $zipCode
     * @return IpLocation
     */
    public function setZipCode(string $zipCode)
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * Gets the Latitude of the Ip
     *
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * Sets the latitude of the IP
     *
     * @param  string $latitude
     * @return IpLocation
     */
    public function setLatitude(string $latitude): IpLocation
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * Get Longitude of the ip
     *
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * Sets the longitude of the IP
     *
     * @param  string $longitude
     * @return IpLocation
     */
    public function setLongitude(string $longitude): IpLocation
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * Gets the time zone of the IP
     *
     * @return string
     */
    public function getTimeZone(): string
    {
        return $this->timeZone;
    }

    /**
     * Sets the time zone of the IP
     *
     * @param  string $timeZone
     * @return IpLocation
     */
    public function setTimeZone(string $timeZone): IpLocation
    {
        $this->timeZone = $timeZone;
        return $this;
    }

    /**
     * Gets the city, region and country
     *
     * @return string
     */
    public function getAddressString(): string
    {
        return $this->addressString;
    }

    /**
     * Sets the city, region and country
     *
     * @param  string $addressString
     * @return $this
     */
    public function setAddressString(string $addressString)
    {
        $this->addressString = $addressString;
        return $this;
    }

    /**
     * Parses json data into the class
     *
     * @param string $response
     */
    protected function parseData(string $response)
    {
        $response = json_decode($response);
        $this->statusCode = ! empty($resp = $response->statusCode) ? $resp : '';
        $this->statusMessage = ! empty($resp = $response->statusMessage) ? $resp : '';
        $this->ipAddress = ! empty($resp = $response->ipAddress) ? $resp : '';
        $this->countryCode = ! empty($resp = $response->countryCode) ? $resp : '';
        $this->countryName = ! empty($resp = $response->countryName) ? $resp : '';
        $this->regionName = ! empty($resp = $response->regionName) ? $resp : '';
        $this->cityName = ! empty($resp = $response->cityName) ? $resp : '';
        $this->zipCode = ! empty($resp = $response->zipCode) ? $resp : '';
        $this->latitude = ! empty($resp = $response->latitude) ? $resp : '';
        $this->longitude = ! empty($resp = $response->longitude) ? $resp : '';
        $this->timeZone = ! empty($resp = $response->timeZone) ? $resp : '';
        $this->addressString = $this->createAddressString();
    }
}
