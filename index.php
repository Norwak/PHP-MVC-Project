<?php
declare(strict_types=1);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

spl_autoload_register(function(string $class_name) {
  $class_name = str_replace('\\', '/', $class_name);
  require "src/$class_name.php";
});

$router = new Framework\Router();

$router->add('/admin/{controller}/{action}', [
  "namespace" => "Admin",
]);
$router->add('/{title}/{id:\d+}/{page:\d+}', [
  "controller" => "products",
  "action" => "showPage",
]);
$router->add('/product/{slug:[\w-]+}', [
  "controller" => "products",
  "action" => "show",
]);
$router->add('/{controller}/{id:\d+}/{action}');
$router->add('/home/index', [
  "controller" => "home",
  "action" => "index"
]);
$router->add('/products', [
  "controller" => "products",
  "action" => "index"
]);
$router->add('/', [
  "controller" => "home",
  "action" => "index"
]);
$router->add('/{controller}/{action}');



$container = new Framework\Container();
$container->set(App\Database::class, function() {
  $host = 'localhost';
  $db = 'product_db';
  $user = 'root';
  $password = '';
  return new App\Database($host, $db, $user, $password);
});

$dispatcher = new Framework\Dispatcher($router, $container);

$dispatcher->handle($path);