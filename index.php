<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\classes\ArticleClass;
use App\classes\FirstClass;

$myFirstClass = new FirstClass();
$myFirstClass->MyFirstFunction();

$articleClass = new ArticleClass();
var_dump($articleClass->listArticles());
