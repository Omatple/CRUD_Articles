<?php

use MyApp\Database\Article;
use MyApp\Database\Category;
use MyApp\Utils\ArticleValidator;
use MyApp\Utils\HandlerErrorDisplay;
use MyApp\Utils\UtilsSession;

session_start();

require __DIR__ . "/../vendor/autoload.php";

$categories = Category::read();
if (isset($_POST["name"])) {
    $name = ArticleValidator::sanitizeInput($_POST["name"]);
    $description = ArticleValidator::sanitizeInput($_POST["description"]);
    $availability = (isset($_POST["availability"])) ? ArticleValidator::sanitizeInput($_POST["availability"]) : false;
    $categoryId = ($_POST["categoryId"] !== "Select category") ? ArticleValidator::sanitizeInput($_POST["categoryId"]) : false;
    $hasErrors = false;
    if (!ArticleValidator::validateNameLength($name)) $hasErrors = true;
    if (!$hasErrors && ArticleValidator::validateIfNameTaken($name)) $hasErrors = true;
    if (!ArticleValidator::validateDescriptionLength($description)) $hasErrors = true;
    if (!ArticleValidator::validateAvailability($availability)) $hasErrors = true;
    if (!ArticleValidator::validateCategory($categoryId)) $hasErrors = true;
    if ($hasErrors) UtilsSession::refreshPage();
    (new Article)
        ->setName($name)
        ->setDescription($description)
        ->setAvailability($availability)
        ->setCategoryId($categoryId)
        ->create();
    $_SESSION["message"] = "Article created successfully.";
    UtilsSession::redirectTo("articles.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Ángel Martínez Otero">
    <title>Articles</title>
    <!-- CDN SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- CDN FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-white dark:bg-gray-900">
    <section class="bg-white dark:bg-gray-900">
        <div class="mt-8 py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">Add a new article</h2>
            <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST" novalidate>
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Article Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                        <?= HandlerErrorDisplay::displayError("name") ?>
                    </div>
                    <div class="w-full">
                        <label for="availability" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Availability</label>
                        <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center ps-3">
                                    <input id="availability" name="availability" type="radio" value="no" name="list-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="availability" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Available</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center ps-3">
                                    <input id="availability" name="availability" type="radio" value="yes" name="list-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="availability" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Not Available</label>
                                </div>
                            </li>
                        </ul>
                        <?= HandlerErrorDisplay::displayError("availability") ?>
                    </div>
                    <div>
                        <label for="categoryId" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select name="categoryId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Select category</option>
                            <?php
                            foreach ($categories as $category) {
                                echo "<option value='{$category['id']}'>{$category['name']}</option>";
                            }
                            ?>
                        </select>
                        <?= HandlerErrorDisplay::displayError("category") ?>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea name="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here"></textarea>
                        <?= HandlerErrorDisplay::displayError("description") ?>
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                    Add article
                </button>
                <button type="reset" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-green-800 ml-4">
                    Reset
                </button>
                <a href="articles.php" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800 ml-4">
                    Back
                </a>
            </form>
        </div>
    </section>
</body>

</html>