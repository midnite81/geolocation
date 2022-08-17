<?php

declare(strict_types=1);

namespace Midnite81\GeoLocation\Responses;

use Midnite81\Core\Responses\BaseResponse;
use Midnite81\GeoLocation\Responses\Ip2Location\CityResponse;
use Midnite81\GeoLocation\Responses\Ip2Location\ContinentResponse;
use Midnite81\GeoLocation\Responses\Ip2Location\CountryResponse;
use Midnite81\GeoLocation\Responses\Ip2Location\GeoTargetingResponse;
use Midnite81\GeoLocation\Responses\Ip2Location\ProxyResponse;
use Midnite81\GeoLocation\Responses\Ip2Location\RegionResponse;
use Midnite81\GeoLocation\Responses\Ip2Location\TimeZoneResponse;

class Ip2LocationResponse extends BaseResponse
{
    /**
     * The IP Address
     * Availability on Free, Starter, Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $ip;

    /**
     * Two-character country code based on ISO 3166.
     * Availability on Free, Starter, Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $countryCode;

    /**
     * Country name based on ISO 3166.
     * Availability on Free, Starter, Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $countryName;

    /**
     * Region or state name.
     * Availability on Free, Starter, Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $regionName;

    /**
     * City name.
     * Availability on Free, Starter, Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $cityName;

    /**
     * City latitude. Defaults to capital city latitude if city is unknown.
     * Availability on Free, Starter, Plus and Security Plan.
     *
     * @var float|null
     */
    public readonly ?float $latitude;

    /**
     * City longitude. Defaults to capital city longitude if city is unknown.
     * Availability on Free, Starter, Plus and Security Plan.
     *
     * @var float|null
     */
    public readonly ?float $longitude;

    /**
     * ZIP/Postal code.
     * Availability on Free, Starter, Plus and Security Plan.
     *
     * @var string|int|null
     */
    public readonly string|int|null $zipCode;

    /**
     * UTC time zone (with DST supported).
     * Availability on Free, Starter, Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $timeZone;

    /**
     * Autonomous system number (ASN).
     * Availability on Free, Starter, Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $asn;

    /**
     * Autonomous system (AS) name.
     * Availability on Free, Starter, Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $as;

    /**
     * Internet Service Provider or company's name.
     * Availability on Starter, Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $isp;

    /**
     * Internet domain name associated with IP address range.
     * Availability on Starter, Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $domain;

    /**
     * Internet connection type.
     * DIAL = dial-up,
     * DSL = broadband/cable/fiber/mobile,
     * COMP = company/T1
     * Availability on Starter, Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $netSpeed;

    /**
     * The IDD prefix to call the city from another country.
     * Availability on Starter, Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $iddCode;

    /**
     * A varying length number assigned to geographic areas for calls between cities.
     * Availability on Starter, Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $areaCode;

    /**
     * The special code to identify the nearest weather observation station.
     * Availability on Starter, Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $weatherStationCode;

    /**
     * The name of the nearest weather observation station.
     * Availability on Starter, Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $weatherStationName;

    /**
     * Mobile Country Codes (MCC) as defined in ITU E.212 for use in identifying mobile stations in wireless
     * telephone networks, particularly GSM and UMTS networks.
     * Availability on Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $mcc;

    /**
     * Mobile Network Code (MNC) is used in combination with a Mobile Country Code (MCC) to uniquely identify a
     * mobile phone operator or carrier.
     * Availability on Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $mnc;

    /**
     * Commercial brand associated with the mobile carrier.
     * Availability on Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $mobileBrand;

    /**
     * Average height of city above sea level in meters (m).
     * Availability on Plus and Security Plan.
     *
     * @var int|null
     */
    public readonly ?int $elevation;

    /**
     * Usage type classification of ISP or company
     * (COM) Commercial
     * (ORG) Organization
     * (GOV) Government
     * (MIL) Military
     * (EDU) University/College/School
     * (LIB) Library
     * (CDN) Content Delivery Network
     * (ISP) Fixed Line ISP
     * (MOB) Mobile ISP
     * (DCH) Data Center/Web Hosting/Transit
     * (SES) Search Engine Spider
     * (RSV) Reserved
     * Availability on Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $usageType;

    /**
     * IP address types as defined in Internet Protocol version 4 (IPv4) and Internet Protocol version 6 (IPv6).
     * (A) Anycast - One to the closest
     * (U) Unicast - One to one
     * (M) Multicast - One to multiple
     * (B) Broadcast - One to all
     * Availability on Plus and Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $addressType;

    /**
     * The Continent Response
     * Availability on Plus and Security Plan.
     *
     * @var ContinentResponse
     */
    public readonly ContinentResponse $continent;

    /**
     * The Country Response
     * Availability on Plus and Security Plan.
     *
     * @var CountryResponse
     */
    public readonly CountryResponse $country;

    /**
     * The Region Response
     * Availability on Plus and Security Plan.
     *
     * @var RegionResponse
     */
    public readonly RegionResponse $region;

    /**
     * The City Response
     * Availability on Plus and Security Plan.
     *
     * @var CityResponse
     */
    public readonly CityResponse $city;

    /**
     * The Time Zone Info Response
     * Availability on Plus and Security Plan.
     *
     * @var TimeZoneResponse
     */
    public readonly TimeZoneResponse $timeZoneInfo;

    /**
     * The GeoTargeting Response
     * Availability on Plus and Security Plan.
     *
     * @var GeoTargetingResponse
     */
    public readonly GeoTargetingResponse $geoTargeting;

    /**
     * The domain category code based on IAB Tech Lab Content Taxonomy.
     * Availability on Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $adsCategory;

    /**
     * The domain category based on IAB Tech Lab Content Taxonomy. These categories are comprised of
     * Tier-1 and Tier-2 (if available) level categories widely used in services like advertising,
     * Internet security and filtering appliances.
     * Availability on Security Plan.
     *
     * @var string|null
     */
    public readonly ?string $adsCategoryName;

    /**
     * Whether is a proxy or not
     * Availability on Free, Starter, Plus and Security Plan.
     *
     * @var bool|null
     */
    public readonly ?bool $isProxy;

    /**
     * The Proxy Response
     * Availability on the Security Plan
     *
     * @var ProxyResponse
     */
    public readonly ProxyResponse $proxy;

    /**
     * A string with city, region and country.
     * Availability on all plans
     *
     * @var string
     */
    public readonly string $addressString;

    public function __construct(string|array $data)
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        $this->ip = $data['ip'] ?? null;
        $this->countryCode = $data['country_code'] ?? null;
        $this->countryName = $data['country_name'] ?? null;
        $this->regionName = $data['region_name'] ?? null;
        $this->cityName = $data['city_name'] ?? null;
        $this->latitude = $data['latitude'] ?? null;
        $this->longitude = $data['longitude'] ?? null;
        $this->zipCode = $data['zip_code'] ?? null;
        $this->timeZone = $data['time_zone'] ?? null;
        $this->asn = $data['asn'] ?? null;
        $this->as = $data['as'] ?? null;
        $this->isp = $data['isp'] ?? null;
        $this->domain = $data['domain'] ?? null;
        $this->netSpeed = $data['net_speed'] ?? null;
        $this->iddCode = $data['idd_code'] ?? null;
        $this->areaCode = $data['area_code'] ?? null;
        $this->weatherStationCode = $data['weather_station_code'] ?? null;
        $this->weatherStationName = $data['weather_station_name'] ?? null;
        $this->mcc = $data['mcc'] ?? null;
        $this->mnc = $data['mnc'] ?? null;
        $this->mobileBrand = $data['mobile_brand'] ?? null;
        $this->elevation = $data['elevation'] ?? null;
        $this->usageType = $data['usage_type'] ?? null;
        $this->addressType = $data['address_type'] ?? null;
        $this->continent = !empty($data['continent'])
            ? new ContinentResponse($data['continent'])
            : new ContinentResponse();
        $this->country = !empty($data['country']) ? new CountryResponse($data['country']) : new CountryResponse();
        $this->region = !empty($data['region']) ? new RegionResponse($data['region']) : new RegionResponse();
        $this->city = !empty($data['city']) ? new CityResponse($data['city']) : new CityResponse();
        $this->timeZoneInfo = !empty($data['time_zone_info'])
            ? new TimeZoneResponse($data['time_zone_info'])
            : new TimeZoneResponse();
        $this->geoTargeting = !empty($data['geotargeting'])
            ? new GeoTargetingResponse($data['geotargeting'])
            : new GeoTargetingResponse();
        $this->adsCategory = $data['ads_category'] ?? null;
        $this->adsCategoryName = $data['ads_category_name'] ?? null;
        $this->isProxy = $data['is_proxy'] ?? null;
        $this->proxy = !empty($data['proxy']) ? new ProxyResponse($data['proxy']) : new ProxyResponse();
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
