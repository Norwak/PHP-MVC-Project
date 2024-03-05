<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Models\Product;
use Framework\Exceptions\NotFoundException;
use Framework\Controller;

class Products extends Controller {

  function __construct(
    private Product $model,
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

    echo $this->viewer->render('Products/index.engine.php', [
      "title" => "All products",
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
    $post = $this->request->post();

    $data = [
      "name" => $post['name'],
      "description" => $post['description'] ?: null,
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
    $post = $this->request->post();

    $product['name'] = $post['name'];
    $product['description'] = $post['description'] ?: null;

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


  function delete(string $id) {
    $product = $this->getProduct($id);

    echo $this->viewer->render('shared/header.php', [
      "title" => "Delete product"
    ]);

    echo $this->viewer->render('Products/delete.php', [
      "product" => $product
    ]);
  }


  function remove(string $id) {
    $product = $this->getProduct($id);

    $this->model->remove($id);
    header('Location: /products');
    exit();
  }

}