<?php

global $config;

use \Core\Database;

$db = new Database($config['database']);
$query = "SELECT * FROM users";

$users = $db->query($query)->get();

dd($users);