<?php
namespace App;
use PDO;

class Database {

  function getConnection(): PDO {
    $host = 'localhost';
    $db   = 'product_db';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $data_source = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    return new PDO($data_source, $user, $pass, $options);
  }

}