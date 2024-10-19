<?php

global $config;

use \Core\Database;
use Firebase\JWT\JWT;


//JWT
$secret_key = $config['secret_key'];
$issuer_claim = "queuing-server";
$audience_claim = "queuing-system";
$issuedAt_claim = time();
$notBefore_claim = $issuedAt_claim + 10;
$expire_claim = $issuedAt_claim + 3600;

$db = new Database($config['database']);
$message = '';

//Process POST request
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


$permissionsArray = explode(',', $user['permissions']);

  if ($user){
    $token = [
      'iss' => $issuer_claim,
      'aud' => $audience_claim,
      'iat' => $issuedAt_claim,
      'nbf' => $notBefore_claim,
      'exp' => $expire_claim,
      "data" => [
        'username' => $user['username'],
        'role' => $user['role'],
        'permissions' => $permissionsArray,
      ]
    ];

    $jwt = JWT::encode($token, $secret_key, 'HS256');

    http_response_code(200);
    echo json_encode([
      'token' => $jwt,
      'role' => $user['role'],
      'permissions' => $permissionsArray
    ]);
  }else {
    http_response_code(404);

    $message = "User not found!";
    echo json_encode($message);
  }
}

