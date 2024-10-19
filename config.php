<?php

return [
  'database' => [
    'host' => $_ENV['DB_HOST'],
    'port' => $_ENV['DB_PORT'],
    'dbname' => $_ENV['DB_NAME'],
  ],
  'secret_key' => $_ENV['SECRET_KEY']
];