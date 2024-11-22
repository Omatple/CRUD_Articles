<?php

use MyApp\Database\Article;
use MyApp\Database\Category;

$amount = (int) readline("Enter the number of articles (5-50), or '0' to exit: ");
if ($amount === 0) exit("\nExiting at the user's request..." . PHP_EOL);
while ($amount < 5 || $amount > 50) {
    $amount = (int) readline("ERROR: Introduzca el numero de articulos (5-50), '0' para salir: ");
    if ($amount === 0) exit("\nExiting at the user's request..." . PHP_EOL);
}
require __DIR__ . "/../vendor/autoload.php";
Category::createDefaultCategories();
Article::generateFakeArticles($amount);
echo "A total of $amount fake articles have been created." . PHP_EOL;
