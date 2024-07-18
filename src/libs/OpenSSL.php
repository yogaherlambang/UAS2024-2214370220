<?php
namespace App\Library;

class OpenSSL extends \App\Library\AES256ofb
{
    /**
     * @param mixed $plainText
     * @param string $key
     * @param binary $iv
     * @return $cipherText
     */
    public static function encript($plainText, string $key, $iv): string 
    {
        if (!in_array(self::$cipher, openssl_get_cipher_methods())) {
            throw new \Exception('cipher method not found');
        }

        $ciphertext = openssl_encrypt($plainText, self::$cipher, $key,  $options = OPENSSL_ZERO_PADDING, $iv);

        return $ciphertext;
    }

    /**
     * @param string $cipherText
     * @param string $key
     * @param binary $iv
     * @return $plainText
     */
    public static function decript(string $cipherText, string $key, $iv): string
    {
        if (!in_array(self::$cipher, openssl_get_cipher_methods())) {
            throw new \Exception('cipher method not found');
        }

        $plainText = openssl_decrypt($cipherText, self::$cipher, $key, $options = OPENSSL_ZERO_PADDING, $iv);

        return $plainText;
    }
}