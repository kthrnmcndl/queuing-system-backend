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

//Process POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  $username = $_POST['username'];
  $password = $_POST['password'];

//Check if username and password exists in the database
  $query = "SELECT * FROM users WHERE username = :username LIMIT 1";

  $user = $db->query($query,[
    'username' => $username,
  ])->find();

  if (strval($user['password']) === strval($password)){
    $permissionsArray = explode(',', $user['permissions']);

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

    $message = "Wrong password.";
    echo json_encode($message);
  }
}

