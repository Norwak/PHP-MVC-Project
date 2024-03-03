<?php
declare(strict_types=1);
namespace Framework;

class Viewer {

  function render(string $template, array $data = []) {
    extract($data, EXTR_SKIP, );

    ob_start();

    require "views/$template";

    return ob_get_clean();
  }

}