<?php
namespace App\Models;
use App\Database;

class Product {

  function __construct(
    private Database $database,
  ) {}


  function getData(): array {
    $pdo = $this->database->getConnection();

    $stmt = $pdo->query("SELECT * FROM product");
    return $stmt->fetchAll();
  }

}