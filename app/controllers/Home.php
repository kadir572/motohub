<?php

class Home extends PublicController {
  public function index() {
    $this->view('home');
  }

  public function motorcycles() {

    if (isset($_GET['type'])) {

      switch ($_GET['type']) {
        case 'details':
          $this->view('motorcycleDetails', ['id' => desinfect($_GET['id'])]);
          break;
      }

    } else {
      $this->view('motorcycles');
    }
    
  }

  public function contact() {
    if (isset($_GET['type'])) {
      switch ($_GET['type']) {
        case 'send':
          header("Location: ".ROOT."/home/contact?success=Your message was successfully sent");
          break;
        default:
          header("Location: ".ROOT);
          break;
      }
     return; 
    }

    $this->view('contact');
  }

  public function login() {
    $this->view('login');
  }

  public function register() {
    $this->view('register');
  }

  public function user() {
    if (isset($_GET['type'])) {

      $userModel = new User();
      switch ($_GET['type']) {
        case 'delete':
          $userModel->delete(desinfect($_GET['id']));
          clearSessionLogin();
          header("Location: ".ROOT);
          break;
        case 'edit':
          $username = desinfect(trim($_POST['username']));
          $email = desinfect(trim($_POST['email']));
          $password = desinfect(trim($_POST['password']));
          $password2 = desinfect(trim($_POST['password2']));

          
          break;

      }
    }
  }

  public function userSettings() {
    $this->view('userSettings');
  }

  public function dashboard() {
    $this->view('dashboard');
  }

}