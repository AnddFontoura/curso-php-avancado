<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\classes\ArticleClass;
use App\classes\FirstClass;
use App\classes\SubCategoryClass;

$articleClass = new ArticleClass();
$articles = $articleClass->listArticles();

$params = [
    'name' => 'Volume 8, número 5',
];

$subCategoryClass = new SubCategoryClass();
var_dump($subCategoryClass->getAllFromTable($params));
