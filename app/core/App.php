<?php

class App {
  function __construct() {
    $this->loadController();
  }

  private $controller = 'Home';
  private $method = 'index';

  private function loadController() {
    $URL = splitUrl();
    $filename = '../app/controllers/'. ucfirst($URL[0]) . '.php';

    if (file_exists($filename)) {
      $this->controller = ucfirst($URL[0]);
    } else {
      $filename = '../app/controllers/_404.php';
      $this->controller = '_404';
    }

    require $filename;
    $controller = new $this->controller;

    if (!empty($URL[1])) {
      if (method_exists($controller, $URL[1])) {
        // Reflection is used to check if method is public
        $reflection = new ReflectionMethod($controller, $URL[1]);
        if (!$reflection->isPublic()) return header("Location: ".ROOT);
        $this->method = $URL[1];
      } else {
        $filename = '../app/controllers/_404.php';
        $this->controller = '_404';
        $this->method = 'index';
        require $filename;
        $controller = new $this->controller;
      }
    }
    call_user_func_array([$controller, $this->method], []);
  }
}