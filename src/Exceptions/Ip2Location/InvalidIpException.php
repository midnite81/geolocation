<?php

declare(strict_types=1);

namespace Midnite81\GeoLocation\Exceptions\Ip2Location;

use Exception;
use Throwable;

class InvalidIpException extends Exception
{
    public string $defaultMessage = 'Invalid IP address';

    public int $defaultCode = 10001;

    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        $message = ($message === '') ? $this->defaultMessage : $message;
        $code = ($code === 0) ? $this->defaultCode : $code;
        parent::__construct($message, $code, $previous);
    }
}
