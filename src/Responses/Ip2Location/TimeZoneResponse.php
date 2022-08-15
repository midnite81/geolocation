<?php

declare(strict_types=1);

namespace Midnite81\GeoLocation\Responses\Ip2Location;

use Midnite81\Core\Responses\BaseResponse;

class TimeZoneResponse extends BaseResponse
{
    /**
     * Time zone in Olson format.
     *
     * @var string|mixed|null
     */
    public readonly ?string $olson;

    /**
     * Current time in ISO 8601 format.
     *
     * @var string|mixed|null
     */
    public readonly ?string $currentTime;

    /**
     * GMT offset value in seconds.
     *
     * @var int|mixed|string|null
     */
    public readonly ?int $gmtOffset;

    /**
     * Indicate if the time zone value is in DST.
     *
     * @var bool|mixed|string|null
     */
    public readonly bool $isDst;

    /**
     * Time of sunrise. (hh:mm format in local time, i.e. 07:47)
     *
     * @var string|mixed|null
     */
    public readonly ?string $sunrise;

    /**
     * Time of sunset. (hh:mm format in local time, i.e. 19:50)
     *
     * @var string|mixed|null
     */
    public readonly ?string $sunset;

    public function __construct(string|array $data)
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        $this->olson = $data['olson'] ?? null;
        $this->currentTime = $data['current_time'] ?? null;
        $this->gmtOffset = $data['gmt_offset'] ?? null;
        $this->isDst = $data['is_dst'] ?? null;
        $this->sunrise = $data['sunrise'] ?? null;
        $this->sunset = $data['sunset'] ?? null;
        parent::__construct();
    }
}
