<?php

class Home extends PublicController {
  public function index() {
    $this->view('home');
  }

  public function motorcycles() {
    $motorcycle = new Motorcycle;
    $data = $motorcycle->findAll();
    $this->view('motorcycles', $data);
  }

  public function contact() {
    $this->view('contact');
  }
}