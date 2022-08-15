<?php

declare(strict_types=1);

namespace Midnite81\GeoLocation\Responses\Ip2Location;

use Midnite81\Core\Responses\BaseResponse;

class ContinentResponse extends BaseResponse
{
    /**
     * Continent name.
     *
     * @var string|mixed|null
     */
    public readonly ?string $name;

    /**
     * Two-character continent code.
     *
     * @var string|mixed|null
     */
    public readonly ?string $code;

    /**
     * The hemisphere of where the country located. The data in array format with first item indicates (north/south)
     * hemisphere and second item indicates (east/west) hemisphere information.
     *
     * @var array|mixed|string|null
     */
    public readonly ?array $hemisphere;

    /**
     * The translation response
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
        $this->hemisphere = $data['hemisphere'] ?? null;
        $this->translation = !empty($data['translation']) ? new TranslationResponse($data['translation']) : null;
        parent::__construct();
    }
}
