<?php
namespace Framework;

class Router {

  private array $routes;

  function add(string $path, array $params): void {
    $this->routes[] = [
      "path" => $path,
      "params" => $params,
    ];
  }

  function match(string $path): array {
    foreach ($this->routes as $route) {
      if($route['path'] === $path) {
        return $route['params'];
      }
    }

    return [];
  }
}