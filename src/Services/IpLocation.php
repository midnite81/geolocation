<?php
namespace Midnite81\GeoLocation\Services;

class IpLocation
{
    public $statusCode;
    public $statusMessage;
    public $ipAddress;
    public $countryCode;
    public $countryName;
    public $regionName;
    public $cityName;
    public $zipCode;
    public $latitude;
    public $longitude;
    public $timeZone;
    public $addressString;

    public function __construct($response = null)
    {
        if (! empty($response)) {
            $this->addData($response);
        }
    }

    /**
     * Return Address String
     *
     * @return string
     */
    public function createAddressString()
    {

        $address = [
            $this->cityName,
            $this->regionName,
            $this->countryName
        ];

        foreach($address as $k=>$v) {
            if (empty($v)) {
                unset($address[$k]);
            }
        }

        return implode(', ', $address);
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * Object variables as Json String
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return IpLocation
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusMessage()
    {
        return $this->statusMessage;
    }

    /**
     * @param mixed $statusMessage
     * @return IpLocation
     */
    public function setStatusMessage($statusMessage)
    {
        $this->statusMessage = $statusMessage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param mixed $ipAddress
     * @return IpLocation
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param mixed $countryCode
     * @return IpLocation
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * @param mixed $countryName
     * @return IpLocation
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getRegionName()
    {
        return $this->regionName;
    }

    /**
     * @param mixed $regionName
     * @return IpLocation
     */
    public function setRegionName($regionName)
    {
        $this->regionName = $regionName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * @param mixed $cityName
     * @return IpLocation
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostCode()
    {
        return $this->zipCode;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param mixed $zipCode
     * @return IpLocation
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     * @return IpLocation
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     * @return IpLocation
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTimeZone()
    {
        return $this->timeZone;
    }

    /**
     * @param mixed $timeZone
     * @return IpLocation
     */
    public function setTimeZone($timeZone)
    {
        $this->timeZone = $timeZone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddressString()
    {
        return $this->addressString;
    }

    /**
     * @param mixed $addressString
     * @return $this
     */
    public function setAddressString($addressString)
    {
        $this->addressString = $addressString;
        return $this;
    }


    /**
     * @param $response
     */
    public function addData($response)
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