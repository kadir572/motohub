<?php

class User extends Controller {

  public function __construct() {
    $this->directory = 'user';
  }

  public function index() {
    if (empty($_SESSION['username'])) {
      return redirectWithError('401 - Unauthorized', '/home/login');
    }
    $this->dashboard();
  }

  public function dashboard() {
    $this->view('dashboard');
  }

  public function settings() {
    $this->view('settings');
  }

  public function delete() {
    $userModel = new UserModel;

    if ($_SESSION['permission'] !== 0) {
      redirectWithError('401 - Unauthorized', '/user/settings');
      return;
    } 

    $user = $userModel->first(['username' => $_SESSION['username']]);
    if ($user->isAdmin) {
      redirectWithError('401 - Unauthorized', '/user/settings');
      return;
    }

    $userModel->delete(sanitize($_GET['id']));
    clearSessionLogin();
    header("Location: ".ROOT);
  }

  public function edit() {
      $userModel = new UserModel;
      
      $username = sanitize(trim($_POST['username']));
      $email = sanitize(trim($_POST['email']));
      $password = sanitize(trim($_POST['password']));
      $password2 = sanitize(trim($_POST['password2']));
  }
}