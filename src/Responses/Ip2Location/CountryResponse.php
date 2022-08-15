<?php

declare(strict_types=1);

namespace Midnite81\GeoLocation\Responses\Ip2Location;

use Midnite81\Core\Responses\BaseResponse;

class CountryResponse extends BaseResponse
{
    /**
     * Country name based on ISO 3166.
     *
     * @var string|null
     */
    public readonly ?string $name;

    /**
     * Three-character country code based on ISO 3166.
     *
     * @var string|null
     */
    public readonly ?string $alpha3Code;

    /**
     * Three-character country numeric code based on ISO 3166.
     *
     * @var int|null
     */
    public readonly ?int $numericCode;

    /**
     * Native of the country
     *
     * @var string|null
     */
    public readonly ?string $demonym;

    /**
     * URL of the country flag image.
     *
     * @var string|null
     */
    public readonly ?string $flag;

    /**
     * Capital of the country.
     *
     * @var string|null
     */
    public readonly ?string $capital;

    /**
     * Total area in km2.
     *
     * @var int|null
     */
    public readonly ?int $totalArea;

    /**
     * Population of the country.
     *
     * @var int|null
     */
    public readonly ?int $population;

    /**
     * The Currency Response
     *
     * @var CurrencyResponse|null
     */
    public readonly ?CurrencyResponse $currency;

    /**
     * The Language Response
     *
     * @var LanguageResponse|null
     */
    public readonly ?LanguageResponse $language;

    /**
     * Country-Code Top-Level Domain.
     *
     * @var string|null
     */
    public readonly ?string $tld;

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
        $this->alpha3Code = $data['alpha3_code'] ?? null;
        $this->numericCode = $data['numeric_code'] ?? null;
        $this->demonym = $data['demonym'] ?? null;
        $this->flag = $data['flag'] ?? null;
        $this->capital = $data['capital'] ?? null;
        $this->totalArea = $data['total_area'] ?? null;
        $this->population = $data['population'] ?? null;
        $this->currency = !empty($data['currency']) ? new CurrencyResponse($data['currency']) : null;
        $this->language = !empty($data['language']) ? new LanguageResponse($data['language']) : null;
        $this->tld = $data['tld'];
        $this->translation = !empty($data['translation']) ? new TranslationResponse($data['translation']) : null;
        parent::__construct();
    }
}
