<?php
namespace Sylapi\Feeds\Skapiec\Enums;

class Availability
{

    const IMMEDIATELY = 1;
    const UP_1_DAY  = 24;
    const UP_2_DAYS  = 48;
    const UP_3_DAYS  = 72;
    const UP_7_DAYS  = 168;
    const FROM_7_DAYS  = 999;

    private static $availabilities = [
        self::IMMEDIATELY => 'wysyłka do godziny / natychmiast',
        self::UP_1_DAY => 'wysyłka następnego dnia',
        self::UP_2_DAYS => 'wysyłka do 2 dni',
        self::UP_3_DAYS => 'wysyłka do 3 dni',
        self::UP_7_DAYS => 'wysyłka do tygodnia',
        self::FROM_7_DAYS => 'dostępny na życzenie'
    ];

    public static function isCorrectStatus($status) 
    {
        return (in_array($status, static::$availabilities) 
            || in_array($status, array_keys(static::$availabilities)));
    }
}