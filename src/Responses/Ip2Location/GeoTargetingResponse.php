<?php

declare(strict_types=1);

namespace Midnite81\GeoLocation\Responses\Ip2Location;

use Midnite81\Core\Responses\BaseResponse;

class GeoTargetingResponse extends BaseResponse
{
    /**
     * Metro code based on zip/postal code.
     *
     * @var string|null
     */
    public readonly ?string $metro;

    public function __construct(string|array $data)
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        $this->metro = $data['metro'] ?? null;
        parent::__construct();
    }
}
