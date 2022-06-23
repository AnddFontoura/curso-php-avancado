<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\classes\ArticleClass;
use App\classes\FirstClass;
use App\classes\SubCategoryClass;

$articleClass = new ArticleClass();
$articles = $articleClass->getAllFromTable();

$insertSubCategory = [
    'name' => 'sub correio',
    'category_id' => 1,
    'description' => 'exemplo de subcategory',
];

$selectSubCategory = [
    'name' => 'sub correio',
];

$subCategoryClass = new SubCategoryClass();
$subCategoryClass->insertOnTable($insertSubCategory);
var_dump($subCategoryClass->getAllFromTable($selectSubCategory));


