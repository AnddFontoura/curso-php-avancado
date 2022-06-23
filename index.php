<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\classes\ArticleClass;
use App\classes\FirstClass;
use App\classes\SubCategoryClass;

$subCategoryParams = [
    'name' => 'sub correio new',
    'description' => 'exemplo de subcategory update',
    'category_id' => 1,
];

$subCategoryClass = new SubCategoryClass();
$subCategoryClass->insertOnTable($subCategoryParams);
$subCategory = $subCategoryClass->getFromTable($subCategoryParams);

echo "<pre>";
//var_dump($subCategory);
echo "</pre>";

$newSubCategoryInfo = [
    'name' => 'Andre atualizou',
    'description' => 'Deu bom',
];

$filter = [
    'id' => $subCategory['id'],
];

$subCategoryClass->updateOnTable($newSubCategoryInfo, $filter);

echo "<pre>";
var_dump($subCategoryClass->getAllFromTable($filter));
echo "</pre>";

