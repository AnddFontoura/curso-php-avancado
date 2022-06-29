<?php
require_once __DIR__ . '/vendor/autoload.php';

$urlExplode = explode('/', $_SERVER['REQUEST_URI']);

$function = $urlExplode[count($urlExplode) - 1];
$controller = $urlExplode[count($urlExplode) - 2];
$function = preg_replace('/\?[A-z=&0-9\+-]{1,1000}/', '', $function);
$controller = strtolower($controller);
$controller = ucwords($controller);

$pathClass = "App\\classes\\" . $controller . "Class";


if (class_exists($pathClass)) {
    $myClass = new $pathClass();
} else {
    die("Classe não encontrada");
}

if (method_exists($myClass, $function)) {
    require_once('./view/includes/header.php');
    $result = $myClass->$function();
    require_once('./view/includes/footer.php');
} else {
    die("Função não existe");
}
