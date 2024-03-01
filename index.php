<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

spl_autoload_register(function(string $class_name) {
  $class_name = str_replace('\\', '/', $class_name);
  require "src/$class_name.php";
});

$router = new Framework\Router();

$router->add('/', [
  "controller" => "home",
  "action" => "index"
]);
$router->add('/home/index', [
  "controller" => "home",
  "action" => "index"
]);
$router->add('/products', [
  "controller" => "products",
  "action" => "index"
]);

$params = $router->match($path);

if (!$params) {
  http_response_code(404);
  exit('No route matched');
}

$controllerName = 'App\Controllers\\' . ucwords($params['controller']);
$action = $params['action'];

$controller = new $controllerName;
$controller->$action();