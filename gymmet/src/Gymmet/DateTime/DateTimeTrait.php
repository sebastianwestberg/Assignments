<?php

namespace Gymmet\DateTime;

trait DateTimeTrait
{
    public function getAsDateTime($time, $timezone = 'Europe/Stockholm')
    {
        return new \DateTime($time, new \DateTimeZone($timezone));
    }
}