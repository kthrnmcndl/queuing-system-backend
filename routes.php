<?php

global $router;

$router->get('/', 'controllers/index.php');
$router->post('/api/auth', 'controllers/api/auth.php');
$router->get('/api/user', 'controllers/api/user.php');