<?php

class AdminController {

  public function view($name) {
    $filename = '../app/views/admin/'.$name.".view.php";

    if (!file_exists($filename)) 
      $filename = '../app/views/404.view.php';

    require $filename;
  }
}