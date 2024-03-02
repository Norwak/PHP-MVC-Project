<?php
namespace App\Controllers;
use Framework\Viewer;

class Home {

  function index() {
    $viewer = new Viewer();

    echo $viewer->render('shared/header.php', [
      "title" => "Homepage"
    ]);

    echo $viewer->render('Home/index.php');
  }

}