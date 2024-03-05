<?php
declare(strict_types=1);
namespace Framework;
use Framework\Request;

abstract class Controller {

  protected Request $request;
  protected Viewer $viewer;


  function setRequest(Request $request): void {
    $this->request = $request;
  }


  function setViewer(Viewer $viewer): void {
    $this->viewer = $viewer;
  }

}