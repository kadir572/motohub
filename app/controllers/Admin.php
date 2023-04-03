<?php

class Admin extends AdminController {
  function index() {
    $this->view('dashboard');
  }
}