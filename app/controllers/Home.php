<?php

class Home extends PublicController {
  public function index() {
    $this->view('home');
  }

  public function motorcycles() {
    
    $this->view('motorcycles');
  }

  public function contact() {
    $this->view('contact');
  }
}