<?php
namespace App\Helper;
class Formater
{

    /**
     * Formats timestamp string 
     *
     * @param string $timeStamp
     * @param string $format
     * @return string
     */
    public static function dateFormat(string $timeStamp, string $format): string
    {
        $date = new \DateTime($timeStamp);
        return $date->format($format);
    }

    /**
     * Converts space sepated words to dash separated,
     * this method also converts the string to lowercase
     *
     * @param string $str
     * @return string
     */
    public static function space2dash(string $str): string
    {
        $str = strtolower($str);
        $result = str_replace(' ', '-', $str);
        return $result;
    }
}
