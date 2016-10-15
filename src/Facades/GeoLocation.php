<?php
namespace Midnite81\GeoLocation\Facades;

use Illuminate\Support\Facades\Facade;

class Geolocation extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'midnite81.geolocation'; }
}