<?php

namespace MyApp\Utils;

class UtilsSession
{
    public static function redirectTo(string $urlPage)
    {
        header("Location: $urlPage");
        exit();
    }

    public static function refreshPage()
    {
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
}
