<?php

namespace MyApp\Utils;

class UtilsValidator
{
    public static function validateLength(string $chain, int $minChars, int $maxChars)
    {
        return (strlen($chain) >= $minChars && strlen($chain) <= $maxChars);
    }
}
