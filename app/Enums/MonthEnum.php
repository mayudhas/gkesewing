<?php

namespace App\Enums;

enum MonthEnum: int
{
    case January = 1;
    case February = 2;
    case March = 3;
    case April = 4;
    case May = 5;
    case June = 6;
    case July = 7;
    case August = 8;
    case September = 9;
    case October = 10;
    case November = 11;
    case December = 12;


    function convertToIndo(): string
    {
        return match ($this) {
            self::January => 'Januari',
            self::February => 'Februari',
            self::March => 'Maret',
            self::April => 'April',
            self::May => 'Mei',
            self::June => 'Juni',
            self::July => 'Juli',
            self::August => 'Agustus',
            self::September => 'September',
            self::October => 'Oktober',
            self::November => 'November',
            self::December => 'Desember',
        };
    }

    static function monthIndo(): array
    {
        return [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
    }

}