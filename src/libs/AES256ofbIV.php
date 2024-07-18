<?php
namespace App\Library;

class AES256ofbIV extends \App\Library\AES256ofb
{
    /**
     * Return random IV for aes-256-ofb
     */
    public static function get(): string
    {
        $ivlen = openssl_cipher_iv_length(self::$cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        return $iv;
    }
}