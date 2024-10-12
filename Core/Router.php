<?php

namespace Core;

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

  public function route($uri, $routes)
  {
    if (array_key_exists($uri, $routes)) {
      return require base_path($routes[$uri]);
    } else {
      abort(404);
    }
  }

  public function abort($code = 404)
  {
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
  }
}
