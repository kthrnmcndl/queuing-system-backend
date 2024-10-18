<?php


use Core\Router;

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Max-Age: 3600");

const BASE_PATH = __DIR__ . "/../";

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});

require base_path('vendor/autoload.php');
$config = require base_path('config.php');

$router = new Router();
//echo ("this is the index.php file");
$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

//$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $routes);