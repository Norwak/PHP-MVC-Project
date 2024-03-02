<?php
namespace App\Controllers;
use App\Models\Product;
use Framework\Viewer;

class Products {

  function index() {
    $model = new Product;
    $products = $model->getData();

    $viewer = new Viewer;

    echo $viewer->render('shared/header.php', [
      "title" => "All products"
    ]);

    echo $viewer->render('Products/index.php', [
      "products" => $products
    ]);
  }

  function show(string $id) {
    $viewer = new Viewer;

    echo $viewer->render('shared/header.php', [
      "title" => "A single product"
    ]);

    echo $viewer->render('Products/show.php', [
      "id" => $id
    ]);
  }

  function showPage(string $title, string $id, string $page) {

  }
}