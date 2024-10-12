<?php

$data = [
  'message' => 'this is a response from PHPServer/api/auth!',
  'status' => 'success',
  'user' => [
    'id' => 1,
    'name' => 'John Doe'
  ]
];

header('Content-Type: application/json');
echo json_encode($data);