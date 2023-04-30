<?php

class PublicController {

  public function view($name, $data = []) {
    $filename = '../app/views/public/'.$name.".view.php";

    if (!file_exists($filename)) 
      $filename = '../app/views/404.view.php';

    if (!empty($data)) {
      $data = $data;
    }
    
    require $filename;
  }
}