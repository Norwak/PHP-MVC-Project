<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Models\Product;
use Framework\Viewer;
use Framework\Exceptions\NotFoundException;

class Products {

  function __construct(
    private Product $model,
    private Viewer $viewer,
  ) {}


  function index() {
    $products = $this->model->findAll();

    echo $this->viewer->render('shared/header.php', [
      "title" => "All products"
    ]);

    echo $this->viewer->render('Products/index.php', [
      "products" => $products
    ]);
  }


  function show(string $id) {
    $product = $this->model->find($id);

    if (!$product) {
      throw new NotFoundException('Product not found');
    }

    echo $this->viewer->render('shared/header.php', [
      "title" => "A single product"
    ]);

    echo $this->viewer->render('Products/show.php', [
      "product" => $product
    ]);
  }


  function showPage(string $title, string $id, string $page) {
    echo $title, " ", $id, " ", $page;
  }


  function new() {
    echo $this->viewer->render('shared/header.php', [
      "title" => "New product"
    ]);

    echo $this->viewer->render('Products/new.php');
  }


  function create() {
    $data = [
      "name" => $_POST['name'],
      "description" => $_POST['description'] ?: null,
    ];

    $result = $this->model->create($data);
    if ($result) {
      header("Location: /products/{$result['id']}/show");
      exit();
    } else {
      echo $this->viewer->render('shared/header.php', [
        "title" => "New product"
      ]);
  
      echo $this->viewer->render('Products/new.php', [
        "errors" => $this->model->getErrors(),
      ]);
    };
  }

}