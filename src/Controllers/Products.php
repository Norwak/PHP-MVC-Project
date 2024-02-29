<?php

class Products {

  function index() {
    require "src/models/product.php";

    $model = new Product;
    $products = $model->getData();

    require "views/products_index.php";
  }

  function show() {
    require "views/products_show.php";
  }

}