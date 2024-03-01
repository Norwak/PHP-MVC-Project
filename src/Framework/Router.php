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
    $pattern = '#^/(?<controller>[a-z]+)/(?<action>[a-z]+)$#';
    if (preg_match($pattern, $path, $matches)) {
      return array_filter($matches, "is_string", ARRAY_FILTER_USE_KEY);
    };

    return [];
  }
}