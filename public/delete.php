<?php

use MyApp\Database\Article;
use MyApp\Utils\UtilsSession;

session_start();
require __DIR__ . "/../vendor/autoload.php";

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
if (!$id || $id <= 0) UtilsSession::redirectTo("articles.php");
Article::delete($id);
$_SESSION["message"] = "Article deleted successfully.";
UtilsSession::redirectTo("articles.php");
