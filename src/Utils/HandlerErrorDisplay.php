<?php

namespace MyApp\Utils;

class HandlerErrorDisplay
{
    public static function displayError(string $errorName)
    {
        if (isset($_SESSION["error_$errorName"])) {
            echo "<p class='text-red-700 bold text-xs'>{$_SESSION["error_$errorName"]}</p>";
            unset($_SESSION["error_$errorName"]);
        }
    }
}
