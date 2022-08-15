<?php

declare(strict_types=1);

namespace Midnite81\GeoLocation\Responses\Ip2Location;

use Midnite81\Core\Responses\BaseResponse;

class LanguageResponse extends BaseResponse
{
    /**
     * The language code
     *
     * @var string|mixed|null
     */
    public readonly string $code;

    /**
     * The language name
     *
     * @var string|mixed|null
     */
    public readonly string $name;

    public function __construct(string|array $data)
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        $this->code = $data['code'] ?? null;
        $this->name = $data['name'] ?? null;
        parent::__construct();
    }
}
