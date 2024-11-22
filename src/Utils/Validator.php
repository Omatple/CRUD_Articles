<?php

namespace MyApp\Utils;

class Validator
{
    public static function validateStringLength(string $chain, int $minChars, int $maxChars)
    {
        return (strlen($chain) >= $minChars && strlen($chain) <= $maxChars);
    }
}
