<?php

class ProductsController {

  function index() {
    require "src/models/products.model.php";
    $model = new ProductsModel;

    $products = $model->getData();

    require "views/products_index.view.php";
  }

}