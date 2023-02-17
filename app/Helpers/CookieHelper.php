<?php

namespace App\Helpers;

class CookieHelper
{
    public static string $nameCookie = 'POS-PENJAHIT';
    public static string $transaction = 'transaction-code';
    public static string $ledger = 'ledger-code';
    public static string $transactionTemp = 'transaction-temp';
    public static int $timeCookie = (60 * 60 * 24);

    public static function setCookie(string $value, int $expireDay = 2, bool $httpOnly = true): void
    {
        $time = time() + (self::$timeCookie * $expireDay);
        set_cookie(name: self::$nameCookie, value: $value, expire: $time, httpOnly: $httpOnly);
    }

    public static function setCodeTransaction(bool $httpOnly = true): void
    {
        if (!get_cookie(CookieHelper::$transaction)) {
            $time = time() + self::$timeCookie;
            $valueCode = getCodeUUID();
            set_cookie(name: self::$transaction, value: $valueCode, expire: $time, httpOnly: $httpOnly);
        }
    }

    public static function setCodeLedger(bool $httpOnly = true): void
    {
        if (!get_cookie(CookieHelper::$ledger)) {
            $time = time() + self::$timeCookie;
            $valueCode = getCodeUUID();
            set_cookie(name: self::$ledger, value: $valueCode, expire: $time, httpOnly: $httpOnly);
        }
    }

    public static function setTransactionTemp(bool $httpOnly = true): void
    {
        if (!get_cookie(CookieHelper::$transaction)) {
            $time = time() + self::$timeCookie;
            $valueCode = getCodeUUID();
            set_cookie(name: self::$transactionTemp, value: $valueCode, expire: $time, httpOnly: $httpOnly);
        }
    }

    public static function getCookie(): array|object|null
    {
        $token = decrypt(get_cookie(self::$nameCookie));
        return json_decode($token);
    }

}