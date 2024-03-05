<?php
declare(strict_types=1);
namespace Framework;
use Framework\Request;

abstract class Controller {

  protected Request $request;
  protected TemplateInterface $viewer;


  function setRequest(Request $request): void {
    $this->request = $request;
  }


  function setViewer(TemplateInterface $viewer): void {
    $this->viewer = $viewer;
  }

}