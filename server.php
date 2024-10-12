<?php
$data = ['message' => 'this is a response from PHP!'];

$db = new PDO("mysql:host=localhost; dbname=queuing-system", "root", "");
$query = "SELECT * FROM students";

$students = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

$data['students'] = $students;

echo json_encode($data);