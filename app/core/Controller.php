<?php

abstract class Controller {

  protected $directory;

  protected function view($name, $data = []) {
    $filename = '../app/views/'.$this->directory.'/'.$name.".view.php";

    if (!file_exists($filename)) 
      $filename = '../app/views/common/404.view.php';
    
      if (!empty($data)) {
        $data = $data;
      }

    require $filename;
  }
}