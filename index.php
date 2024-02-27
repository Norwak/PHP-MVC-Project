<?php

require "src/controllers/products.controller.php";
$controller = new ProductsController;

$controller->index();