<?php

namespace App\Helpers;

use DateTime;

class Funcoes
{
    /**
     * Truncates the given string at the specified length.
     *
     * @param string $str The input string.
     * @param int $width The number of chars at which the string will be truncated.
     * @return string
     */
    public static function truncate($str, $width)
    {
        return strtok(wordwrap($str, $width, "\n"), "\n");
    }

    /**
     * @return bolean
     */
    public static function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);

        return $d && $d->format($format) == $date;
    }
}
