<?php
namespace App;
use PDO;

class Database {

  function __construct(
    private string $host,
    private string $db,
    private string $user,
    private string $pass,
  ) {}


  function getConnection(): PDO {
    $charset = 'utf8mb4';

    $data_source = "mysql:host={$this->host};dbname={$this->db};charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    return new PDO($data_source, $this->user, $this->pass, $options);
  }

}