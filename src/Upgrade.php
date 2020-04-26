<?php

namespace Midnite81\GeoLocation;

use RuntimeException;
use UpdateHelper\UpdateHelper;
use UpdateHelper\UpdateHelperInterface;

class Upgrade implements UpdateHelperInterface
{
    /**
     * @var string
     */
    protected $packageName = 'midnite81/geolocation';

    /**
     * @var UpdateHelper
     */
    protected $helper;

    public function check(UpdateHelper $helper)
    {
        $this->helper = $helper;
        $dependencies = $helper->getProdDependencies();

        if (array_key_exists($this->packageName, $dependencies)) {
            $version = $dependencies[$this->packageName];
            if ($this->version1($version)) {
                $this->yellow('****');
                $this->yellow("Please considering {$this->packageName} to version 2 or greater. Version 1 has been depreciated because of an issue with PSR-4 and composer v2");
                $this->yellow('****');
            }
        }
    }

    private function version1($version)
    {
        return preg_match('/^[\^~>]?1\./', $version);
    }

    private function yellow($string)
    {
        $colour = $this->colour('yellow');
        $reset  = $this->colour('reset');

        $this->helper->write($colour . $string . $reset);
    }

    private function colour($colour)
    {
        $colours = [
            'reset'  => "[0m",
            'yellow' => "[33m"
        ];

        if (!array_key_exists($colour, $colours)) {
            throw new RuntimeException("Colour '$colour' not found");
        }

        if (PHP_OS == 'Darwin') {
            return "\e" . $colours[$colour];
        }

        return "\u001b" . $colours[$colour];
    }
}