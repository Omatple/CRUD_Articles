<?php

namespace MyApp\Utils;

use MyApp\Database\Article;
use MyApp\Database\Category;

class ArticleValidator
{
    public static function sanitizeInput(string $input): string
    {
        return htmlspecialchars(trim($input));
    }

    public static function isAvailabilityValid(string|false $availability): bool
    {
        if (!$availability || !in_array(strtoupper($availability), ["YES", "NO"])) {
            $_SESSION["error_availability"] = "Invalid availability value.";
            return false;
        }
        return true;
    }

    public static function isCategoryValid(int|false $category): bool
    {
        if (!$category && !in_array($category, Category::getCategoriesId())) {
            $_SESSION["error_category"] = "Invalid category selected.";
            return false;
        }
        return true;
    }

    public static function isNameLengthValid(string $name): bool
    {
        $minChars = 5;
        $maxChars = 40;
        if (!Validator::validateStringLength($name, $minChars, $maxChars)) {
            $_SESSION["error_name"] = "Name must be between $minChars and $maxChars characters.";
            return false;
        }
        return true;
    }

    public static function isDescriptionLengthValid(string $description): bool
    {
        $minChars = 5;
        $maxChars = 250;
        if (!Validator::validateStringLength($description, $minChars, $maxChars)) {
            $_SESSION["error_description"] = "Description must be between $minChars and $maxChars characters.";
            return false;
        }
        return true;
    }

    public static function isNameTaken(string $name, ?int $id = null): bool
    {
        if (Article::isNameTaken($name, $id)) {
            $_SESSION["error_name"] = "The article name already exists.";
            return true;
        }
        return false;
    }
}
