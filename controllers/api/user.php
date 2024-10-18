<?php

global $config;

use Core\Database;

$db = new Database($config['database']);
$query = "SELECT * FROM students WHERE studentId = :studentId";

$student = $db->query($query,[
  'studentId' => $_GET['studentId']
])->get();

if ($student){
  echo json_encode($student);
}else {
  echo json_encode(['message' => 'No student found']);
}