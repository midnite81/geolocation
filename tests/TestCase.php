<?php

declare(strict_types=1);

namespace Midnite81\GeoLocation\Tests;

use Illuminate\Foundation\Application;
use Midnite81\GeoLocation\GeoLocationServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * @param  Application  $app
     * @return array|string[]
     */
    protected function getPackageProviders($app)
    {
        return [
            GeoLocationServiceProvider::class,
        ];
    }
}
