<?php

class ProductsController {

  function index() {
    require "products.model.php";
    $model = new ProductsModel;

    $products = $model->getData();

    require "products_index.view.php";
  }

}