<?php

class Admin extends AdminController {
  public function index() {
    if (empty($_SESSION['username'])) {
      header("Location: ".ROOT."/admin/login");
    } else {
      if (!empty($_SESSION['permission'] && $_SESSION['permission'] === 1)) {
        header("Location: ".ROOT."/admin/dashboard");
      } else {
        array_push($_SESSION['errors'], '401 - Unauthorized');

        header("Location: ".ROOT."/auth/logout");
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
      $motorcycleModel = new Motorcycle();

      switch ($_GET['type']) {
        case 'remove':
          $motorcycleModel->delete(desinfect($_GET['id']));
          header("Location: ".ROOT."/admin/motorcycles");
          // $this->view('motorcycles');
          break;
        case 'edit':
          $this->view('editMotorcycle', ['id' => desinfect($_GET['id'])]);
          break;
        case 'update':
          $make = desinfect($_POST['make']);
          $model = desinfect($_POST['model']);
          $imageUrl = desinfect($_POST['imageUrl']);

          $motorcycleModel->update(desinfect($_GET['id']), ['make' => $make, 'model' => $model, 'imageUrl' => $imageUrl]);
          header("Location: ".ROOT."/admin/motorcycles");
          // $this->view('motorcycles');
          break;
        case 'new':
          $this->view('newMotorcycle');
          break;
        case 'create':
          $make = desinfect($_POST['make']);
          $model = desinfect($_POST['model']);
          $imageUrl = desinfect($_POST['imageUrl']);

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