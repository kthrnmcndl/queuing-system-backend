<?php

global $config;

use \Core\Database;

$db = new Database($config['database']);
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  $username = $_POST['username'];
  $password = $_POST['password'];

//Check if username and password exists in the database
  $query = "SELECT * FROM users WHERE username = :username AND password = :password LIMIT 1";

  $user = $db->query($query,[
    'username' => $username,
    'password' => $password,
  ])->find();

  if ($user){
    http_response_code(200);
    echo json_encode($user);
  }else {
    http_response_code(404);

    $message = "User not found!";
    echo json_encode($message);
  }
}