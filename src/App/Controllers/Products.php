<?php
namespace App\Controllers;
use App\Models\Product;

class Products {

  function index() {
    $model = new Product;
    $products = $model->getData();

    require "views/products_index.php";
  }

  function show() {
    require "views/products_show.php";
  }

}