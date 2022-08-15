<?php

namespace Midnite81\GeoLocation\Exceptions\IpInfoDb;

use Exception;
use Throwable;

class PrecisionNotKnownException extends Exception
{
    public string $defaultMessage = 'Precision not known';

    public int $defaultCode = 10001;

    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        $message = ($message === '') ? $this->defaultMessage : $message;
        $code = ($code === 0) ? $this->defaultCode : $code;
        parent::__construct($message, $code, $previous);
    }
}
