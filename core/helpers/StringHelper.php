<?php namespace Partham\core\helpers;


class StringHelper
{
    public static function contains($needle, $haystack)
    {
        $containsValue = strpos($haystack, $needle);

        if ($containsValue === false)
            return false;

        if ($containsValue >= 0)
            return true;
    }
}