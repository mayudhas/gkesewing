<?php
function encrypt(string $string): string
{
    $encrypter = \Config\Services::encrypter();
    $entext = base64_encode($encrypter->encrypt($string));
    return strtr($entext, '+/=', '-_,');
}

function decrypt(string $string = null): string
{
    $dec = '';
    if (!empty($string)) {
        $encrypter = \Config\Services::encrypter();
        $detext = strtr($string, '-_,', '+/=');
        $dec = $encrypter->decrypt(base64_decode($detext));
    }
    return $dec;
}


function setCsrfToken(): bool|string|null
{
    if (!session()->csrf_token) {
        return session()->csrf_token = hash('sha1', time());
    }
    return session()?->csrf_token;
}

function getCsrfToken($type = 'hidden'): string
{
    return "<input type='$type' class='form-control' id='token' name='_token' value='" . setCsrfToken() . "'>";
}

/**
 * @throws Exception
 */
function checkCsrfToken($token, $ket = 'Data Token tidak ada, Silahkan Hubungi administrator')
{
    if ($token !== setCsrfToken() or !setCsrfToken() or !$token) {
        throw new \Exception($ket);
    }
}


function getCodeUUID(bool $tipe = false, int $length = 20): string
{
    $intFormat = sprintf("%'.0" . $length . "s", rand(0, 99999999999999));
    $uniqFormat = strtoupper(md5(uniqid(rand(), true)));
    return $tipe ? $intFormat : substr($uniqFormat, 0, $length);
}
