<?php

class AdminController {

  public function view($name, $data = []) {
    $filename = '../app/views/admin/'.$name.".view.php";

    if (!file_exists($filename)) 
      $filename = '../app/views/404.view.php';
    $data = $data;
    require $filename;
  }
}