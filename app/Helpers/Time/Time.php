<?php


namespace App\Helpers\Time;

use App\Domain\Contracts\MainContract;

class Time
{
    public static function toLocal($dateTime,$timezone):string
    {
        $time   =   new \DateTime($dateTime, new \DateTimeZone($timezone));
        $time->setTimezone(new \DateTimeZone(MainContract::UTC));
        return $time->format('H:i:s');
    }
}
