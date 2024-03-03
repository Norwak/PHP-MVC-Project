<?php
namespace Framework;
use ReflectionMethod;
use ReflectionClass;

class Dispatcher {

  function __construct(
    private Router $router,
  ) {}


  private function getActionArguments(string $controller, string $action, array $params): array {
    $args = [];

    $method = new ReflectionMethod($controller, $action);
    foreach ($method->getParameters() as $parameter) {
      $name = $parameter->getName();
      $args[$name] = $params[$name];
    }

    return $args;
  }


  private function getControllerName(array $params): string {
    $controllerName = $params['controller'];
    $controllerName = str_replace('-', '', ucwords(strtolower($controllerName), '-'));

    $namespace = 'App\Controllers';
    if (array_key_exists('namespace', $params)) {
      $namespace .= '\\' . $params['namespace'];
    }

    return $namespace . '\\' . $controllerName;
  }


  private function getActionName(array $params): string {
    $actionName = $params['action'];
    $actionName = lcfirst(str_replace('-', '', ucwords(strtolower($actionName), '-')));

    return $actionName;
  }


  private function getObject(string $class_name): object {
    $reflector = new ReflectionClass($class_name);
    $constructor = $reflector->getConstructor();
    if ($constructor === null) {
      return new $class_name();
    }
    
    $dependencies = [];
    foreach ($constructor->getParameters() as $parameter) {
      $type = (string) $parameter->getType();
      $dependencies[] = $this->getObject($type);
    }

    return new $class_name(...$dependencies);
  }


  function handle(string $path) {
    $params = $this->router->match($path);

    if (!$params) {
      http_response_code(404);
      exit('No route matched');
    }

    $controllerName = $this->getControllerName($params);
    $controller = $this->getObject($controllerName);

    $action = $this->getActionName($params);
    $args = $this->getActionArguments($controllerName, $action, $params);
    $controller->$action(...$args);
  }

}