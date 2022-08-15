<?php

namespace Midnite81\GeoLocation\Enums;

use Midnite81\Core\Traits\Enum\Arrayable;

enum Precision: string
{
    use Arrayable;

    case City = 'city';
    case Country = 'country';
}
