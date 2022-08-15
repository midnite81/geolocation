<?php

declare(strict_types=1);

namespace Midnite81\GeoLocation\Responses\Ip2Location;

use Midnite81\Core\Responses\BaseResponse;

class TranslationResponse extends BaseResponse
{
    public readonly ?string $language;

    public readonly ?string $value;

    public function __construct(string|array $data)
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        $this->language = $data['lang'] ?? null;
        $this->value = $data['value'] ?? null;
        parent::__construct();
    }
}
