<?php
require "src/router.php";



$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router = new Router;
$router->add('/', [
  "controllerPath" => "src/app.controller.php",
  "controller" => "AppController",
  "action" => "index",
]);
$router->add('/products', [
  "controllerPath" => "src/products/products.controller.php",
  "controller" => "ProductsController",
  "action" => "showAll",
]);

$params = $router->match($path);

if (!$params) {
  http_response_code(404);
  echo 'No route matched';
  return;
}



$controllerName = $params['controller'];
$controllerPath = $params['controllerPath'];
$action = $params['action'];

require $controllerPath;
$controller = new $controllerName;

if (method_exists($controller, $action)) {
  $controller->$action();
} else {
  http_response_code(404);
  echo 'No route matched';
  return;
}