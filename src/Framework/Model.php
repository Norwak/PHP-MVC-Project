<?php
declare(strict_types=1);
namespace Framework;
use PDO;
use App\Database;

abstract class Model {

  protected $table;

  function __construct(
    private Database $database,
  ) {}


  private function getTable(): string {
    if ($this->table !== null) return $this->table;
    
    $parts = explode("\\", $this::class);
    return strtolower(array_pop($parts));
  }


  function findAll(): array {
    $pdo = $this->database->getConnection();

    $sql = "SELECT * FROM {$this->getTable()}";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
  }


  function find(string $id): array {
    $pdo = $this->database->getConnection();

    $sql = "SELECT * FROM {$this->getTable()} WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $data = $stmt->fetch();
    return ($data) ?: [];
  }

}