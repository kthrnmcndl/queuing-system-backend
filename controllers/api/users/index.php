<?php

header("Access-Control-Allow-Headers: Content-Type, Authorization");

use \Core\Database;

$config = [
  'host' => 'localhost',
  'port' => 3306,
  'dbname' => 'queuing-system',
];

$db = new Database($config);


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
  $query = "SELECT * FROM users WHERE username = :username AND password = :password";

  $users = $db->query($query, [
    'username' => $_POST['username'],
    'password' => $_POST['password'],
  ])->findOrFail();

  echo json_encode($users);
}

if($_SERVER['REQUEST_METHOD'] === 'GET'){
  $query = "SELECT * FROM users WHERE username = :username AND password = :password";

  $users = $db->query($query, [
    'username' => $_GET['username'],
    'password' => $_GET['password'],
  ])->findOrFail();

  echo json_encode($users);
}