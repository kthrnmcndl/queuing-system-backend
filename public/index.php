<?php


use Core\Router;
use Dotenv\Dotenv;

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Max-Age: 3600");

const BASE_PATH = __DIR__ . "/../";

require BASE_PATH . 'Core/functions.php';

require base_path('vendor/autoload.php');

$dotenv = Dotenv::createImmutable(BASE_PATH)->load();

$config = require base_path('config.php');

$router = new Router();
//echo ("this is the index.php file");
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
require base_path('routes.php');

$method = ($_POST['_method'] ?? $_SERVER['REQUEST_METHOD']);
//$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);