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


  private function getProduct(string $id): array {
    $product = $this->model->find($id);

    if (!$product) {
      throw new NotFoundException('Product not found');
    }

    return $product;
  }


  function index() {
    $products = $this->model->findAll();

    echo $this->viewer->render('shared/header.php', [
      "title" => "All products"
    ]);

    echo $this->viewer->render('Products/index.php', [
      "products" => $products,
      "total" => $this->model->getTotal(),
    ]);
  }


  function show(string $id) {
    $product = $this->getProduct($id);

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
        "product" => $data,
      ]);
    };
  }


  function edit(string $id) {
    $product = $this->getProduct($id);

    echo $this->viewer->render('shared/header.php', [
      "title" => "Edit Product"
    ]);

    echo $this->viewer->render('Products/edit.php', [
      "product" => $product
    ]);
  }


  function update(string $id) {
    $product['name'] = $_POST['name'];
    $product['description'] = $_POST['description'] ?: null;

    $result = $this->model->update($id, $product);
    if ($result) {
      header("Location: /products/{$result['id']}/show");
      exit();
    } else {
      $product['id'] = $id;

      echo $this->viewer->render('shared/header.php', [
        "title" => "Edit product"
      ]);
  
      echo $this->viewer->render('Products/edit.php', [
        "errors" => $this->model->getErrors(),
        "product" => $product
      ]);
    };
  }


  function remove(string $id) {
    $product = $this->getProduct($id);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $this->model->remove($id);
      header('Location: /products');
      exit();
    }

    echo $this->viewer->render('shared/header.php', [
      "title" => "Delete product"
    ]);

    echo $this->viewer->render('Products/remove.php', [
      "product" => $product
    ]);
  }

}