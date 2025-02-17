<?php

namespace Core;
use PDO;

class Database
{
  public PDO $connection;
  public $statement;

  protected String $message;

  public function __construct($config, $username = "root", $password = "")
  {
    $dsn = "mysql:" . http_build_query($config, '', ';');

    $this->connection = new PDO($dsn, $username, $password, [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
  }

  public function getConnection(): ?PDO
  {
    return $this->connection;
  }

  public function query($query, $params = []): static
  {
    $this->statement = $this->connection->prepare($query);
    $this->statement->execute($params);

    return $this;
  }

  public function find()
  {
    return $this->statement->fetch();
  }

  public function findOrFail()
  {
    $result = $this->find();

    if(! $result)
    {
      return abort();
    }

    return $result;
  }

  public function get()
  {
    return $this->statement->fetchAll();
  }
}