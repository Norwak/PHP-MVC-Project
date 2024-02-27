<?php

class ProductsController {

  function showAll() {
    require "products.model.php";
    $model = new ProductsModel;

    $products = $model->getData();

    require "products_all.view.php";
  }

  function showSingle() {
    require "products_single.view.php";
  }

}