<?php

namespace Core;

use JetBrains\PhpStorm\NoReturn;

class Router
{
  protected array $routes = [];

  public function add($method, $uri, $controller): void
  {
    $this->routes[] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller,
    ];
  }

  public function get($uri, $controller): void
  {
    $this->add('GET', $uri, $controller);
  }

  public function post($uri, $controller): void
  {
    $this->add('POST', $uri, $controller);
  }

  public function route($uri, $method)
  {
    foreach ($this->routes as $route){
      if ($route['uri'] === $uri   && $route['method'] === strtoupper($method)){
        return require base_path($route['controller']);
      }
    }
    return null;
  }

  #[NoReturn]
  public function abort($code = 404)
  {
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
  }
}
