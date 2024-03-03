<?php
namespace App\Controllers;
use App\Models\Product;
use Framework\Viewer;

class Products {

  function __construct(
    private Product $productModel,
    private Viewer $viewer,
  ) {}

  function index() {
    $products = $this->productModel->getData();

    echo $this->viewer->render('shared/header.php', [
      "title" => "All products"
    ]);

    echo $this->viewer->render('Products/index.php', [
      "products" => $products
    ]);
  }

  function show(string $id) {
    echo $this->viewer->render('shared/header.php', [
      "title" => "A single product"
    ]);

    echo $this->viewer->render('Products/show.php', [
      "id" => $id
    ]);
  }

  function showPage(string $title, string $id, string $page) {

  }
}