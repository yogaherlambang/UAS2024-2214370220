<?php

namespace App\Helper;

class Util
{
    /**
     * Return reading time of string.
     *
     * @param string $str
     * @param int    $count
     *
     * @return int
     */
    public static function getReadTime(string $str, int $count = 200): int
    {
        $wordCount = str_word_count($str);
        $minutes = floor($wordCount / $count);
        $seconds = floor($wordCount % $count / ($count / 60));

        if ($seconds > 30) {
            ++$minutes;
        }

        return $minutes;
    }
}
