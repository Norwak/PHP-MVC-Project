<?php
require "src/app.controller.php";
require "src/products/products.controller.php";



$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode('/', $path);

$controllerName = (array_key_exists(1, $segments) && $segments[1]) ? $segments[1] : 'home';
$controllerAction = (array_key_exists(2, $segments) && $segments[2]) ? $segments[2] : 'showAll';

$controllerMap = [
  'home' => 'AppController',
  'products' => 'ProductsController'
];

$controllerName = array_key_exists($controllerName, $controllerMap) ? $controllerMap[$controllerName] : '';



if ($controllerName) {
  $controller = new $controllerName;
} else {
  http_response_code(404);
  return;
}

if (method_exists($controller, $controllerAction)) {
  $controller->$controllerAction();
} else {
  http_response_code(404);
  return;
}