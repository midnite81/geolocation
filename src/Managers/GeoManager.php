<?php

declare(strict_types=1);

namespace Midnite81\GeoLocation\Managers;

use Illuminate\Support\Str;
use Midnite81\GeoLocation\Contracts\Services\Ip2LocationInterface;
use Midnite81\GeoLocation\Contracts\Services\IpInfoDbInterface;
use RuntimeException;

class GeoManager
{
    /**
     * Returns the specified driver if passed, or default if null.
     *
     * @param  string|null  $driver
     * @return IpInfoDbInterface|Ip2LocationInterface
     */
    public function driver(?string $driver = null): IpInfoDbInterface|Ip2LocationInterface
    {
        $driver = $driver ?? $this->getDefaultDriver();
        $driverName = Str::studly($driver);
        $methodName = 'get' . $driverName . 'Driver';

        return $this->{$methodName}();
    }

    /**
     * Returns the Ip Info DB Driver
     *
     * @return IpInfoDbInterface
     */
    public function getIpinfodbDriver(): IpInfoDbInterface
    {
        return app(IpInfoDbInterface::class);
    }

    /**
     * Returns the Ip 2 Location Driver
     *
     * @return Ip2LocationInterface
     */
    public function getIp2locationDriver(): Ip2LocationInterface
    {
        return app(Ip2LocationInterface::class);
    }

    /**
     * Gets the default driver
     *
     * @return string
     */
    protected function getDefaultDriver(): string
    {
        $default = config('geolocation.service', 'ipinfodb');

        if (!in_array($default, ['ipinfodb', 'ip2location'])) {
            throw new RuntimeException("Driver [$default] is not supported");
        }

        return $default;
    }
}
