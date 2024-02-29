<?php

require "src/router.php";

$router = new Router();

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode("/", $path);

$router->add('/', [
  "controller" => "home",
  "action" => "index"
]);
$router->add('/home/index', [
  "controller" => "home",
  "action" => "index"
]);
$router->add('/products', [
  "controller" => "home",
  "action" => "index"
]);

$params = $router->match($path);

if (!$params) {
  http_response_code(404);
  exit('No route matched');
}

$controllerName = $params['controller'];
$action = $params['action'];

require "src/controllers/$controllerName.php";

$controller = new $controllerName;
$controller->$action();