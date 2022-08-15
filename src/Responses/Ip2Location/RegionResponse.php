<?php

declare(strict_types=1);

namespace Midnite81\GeoLocation\Responses\Ip2Location;

use Midnite81\Core\Responses\BaseResponse;

class RegionResponse extends BaseResponse
{
    /**
     * Region or state name.
     *
     * @var string|mixed|null
     */
    public readonly ?string $name;

    /**
     * ISO3166-2 code.
     *
     * @var string|mixed|null
     */
    public readonly ?string $code;

    /**
     * The Translation Response
     *
     * @var TranslationResponse|null
     */
    public readonly ?TranslationResponse $translation;

    public function __construct(string|array $data)
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        $this->name = $data['name'] ?? null;
        $this->code = $data['code'] ?? null;
        $this->translation = !empty($data['translation']) ? new TranslationResponse($data['translation']) : null;
        parent::__construct();
    }
}
