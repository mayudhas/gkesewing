<?php

function formatUang($uang, $rp = false, $decimals = 0): string
{
    if (!$uang) {
        return "";
    }
    $serRp = '';
    if ($rp) $serRp = 'Rp. ';
    return $serRp . number_format($uang, $decimals, ',', '.');
}

function msgAlert(string $title, string $msg = null, string $class = 'warning'): string
{
    return "<h4 class='alert alert-$class'>
                <i class='fas fa-info'></i> $title 
                <br><small>$msg</small>
        </h4>";
}

function dateIndoNumber($date): string
{
    if (!$date) return 'NULL';
    $day = day($date);
    $month = month($date);
    $year = year($date);
    return $day . '-' . $month . '-' . $year;
}

function dateNow(): string
{
    return date('Y-m-d');
}

function day($date): string
{
    return date("d", strtotime($date));
}

function month($date): string
{
    return date("m", strtotime($date));
}

function year($date): string
{
    return date("Y", strtotime($date));
}

function startYear(): int
{
    return 2022;
}

function moneyToWord(int $value): string
{
    return $value ? ucwords(trim(convertNumber($value)) . ' Rupiah') : 'NULL';
}

function convertNumber($value): string
{
    $value = abs($value);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($value < 12) {
        $temp = " " . $huruf[$value];
    } else if ($value < 20) {
        $temp = convertNumber($value - 10) . " belas";
    } else if ($value < 100) {
        $temp = convertNumber((int)($value / 10)) . " puluh" . convertNumber($value % 10);
    } else if ($value < 200) {
        $temp = " seratus" . convertNumber($value - 100);
    } else if ($value < 1000) {
        $temp = convertNumber((int)($value / 100)) . " ratus" . convertNumber($value % 100);
    } else if ($value < 2000) {
        $temp = " seribu" . convertNumber($value - 1000);
    } else if ($value < 1000000) {
        $temp = convertNumber((int)($value / 1000)) . " ribu" . convertNumber($value % 1000);
    } else if ($value < 1000000000) {
        $temp = convertNumber((int)($value / 1000000)) . " juta" . convertNumber($value % 1000000);
    } else if ($value < 1000000000000) {
        $temp = convertNumber((int)($value / 1000000000)) . " milyar" . convertNumber(fmod($value, 1000000000));
    } else if ($value < 1000000000000000) {
        $temp = convertNumber((int)($value / 1000000000000)) . " trilyun" . convertNumber(fmod($value, 1000000000000));
    }
    return $temp;
}


function sprintfNumber(int $number, int $length = 4): string
{
    return sprintf("%'.0" . $length . "s", $number);
}