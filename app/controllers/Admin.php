<?php

class Admin extends Controller {

  public function __construct() {
    $this->directory = 'admin';
  }

  public function index() {
    if (empty($_SESSION['username'])) {
      header("Location: ".ROOT."/admin/login");
    } else {
      if (!empty($_SESSION['permission'] && $_SESSION['permission'] === 1)) {
        header("Location: ".ROOT."/admin/dashboard");
      } else {
        redirectWithError('401 - Unauthorized', '/auth/logout');
      }
    }
  }

  public function dashboard() {
    $this->view('dashboard');
  }

  public function login() {
    $this->view('login');
  }

  public function pages() {
    $this->view('pages');
  }

  public function motorcycles() {
    if (isset($_GET['type'])) {
      $motorcycleModel = new MotorcycleModel();

      switch ($_GET['type']) {
        case 'remove':
          $motorcycleModel->delete(sanitize($_GET['id']));
          header("Location: ".ROOT."/admin/motorcycles");
          // $this->view('motorcycles');
          break;
        case 'edit':
          $this->view('editMotorcycle', ['id' => sanitize($_GET['id'])]);
          break;
        case 'update':
          $make = sanitize($_POST['make']);
          $model = sanitize($_POST['model']);
          $imageUrl = sanitize($_POST['imageUrl']);

          $motorcycleModel->update(sanitize($_GET['id']), ['make' => $make, 'model' => $model, 'imageUrl' => $imageUrl]);
          header("Location: ".ROOT."/admin/motorcycles");
          // $this->view('motorcycles');
          break;
        case 'new':
          $this->view('newMotorcycle');
          break;
        case 'create':
          $make = sanitize($_POST['make']);
          $model = sanitize($_POST['model']);
          $imageUrl = sanitize($_POST['imageUrl']);

          $motorcycleModel->insert(['make' => $make, 'model' => $model, 'imageUrl' => $imageUrl]);
          header("Location:".ROOT."/admin/motorcycles");
          // $this->view('motorcycles');
          break;
      }
      
    } else {
      $this->view('motorcycles');
    }
    
  }
}