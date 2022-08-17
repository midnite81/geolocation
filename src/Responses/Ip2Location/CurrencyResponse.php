<?php

declare(strict_types=1);

namespace Midnite81\GeoLocation\Responses\Ip2Location;

use Midnite81\Core\Responses\BaseResponse;

class CurrencyResponse extends BaseResponse
{
    /**
     * The currency code
     *
     * @var string|null
     */
    public readonly ?string $code;

    /**
     * The currency name
     *
     * @var string|null
     */
    public readonly ?string $name;

    /**
     * The currency symbol
     *
     * @var string|null
     */
    public readonly ?string $symbol;

    public function __construct(string|array $data = [])
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        $this->code = $data['code'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->symbol = $data['symbol'] ?? null;
        parent::__construct();
    }
}
