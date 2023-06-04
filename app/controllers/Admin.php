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
          $id = sanitize($_GET['id']);
          $motorcycle = $motorcycleModel->first(['id' => $id]);
          $imagePath = $motorcycle->imagePath;
          FileHandler::removeFile($imagePath);
          $motorcycleModel->delete($id);
          header("Location: ".ROOT."/admin/motorcycles");
          break;
        case 'edit':
          $this->view('editMotorcycle', ['id' => sanitize($_GET['id'])]);
          break;
        case 'update':
          $make = sanitize($_POST['make']);
          $model = sanitize($_POST['model']);
          if ($_FILES['imageUpload']['error'] === 0) {
            FileHandler::upload($_FILES['imageUpload'], '/admin/motorcycles');
            $imagePath = FileHandler::moveFile('assets/images/motorcycles', $make.'_'.$model.'_'.'image');
            $motorcycleModel->update(sanitize($_GET['id']), ['make' => $make, 'model' => $model, 'imagePath' => $imagePath]);
          } else {
            $motorcycleModel->update(sanitize($_GET['id']), ['make' => $make, 'model' => $model]);
          }

          
          header("Location: ".ROOT."/admin/motorcycles");
          break;
        case 'new':
          $this->view('newMotorcycle');
          break;
        case 'create':
          $make = sanitize($_POST['make']);
          $model = sanitize($_POST['model']);

          $inputsArr = ['make' => $make, 'model' => $model];

          if (!$make) return redirectWithError('Make can not be empty', '/admin/motorcycles?type=new', $inputsArr);
          if (!$model) return redirectWithError('Model can not be empty', '/admin/motorcycles?type=new', $inputsArr);

          FileHandler::upload($_FILES['imageUpload'], '/admin/motorcycles?type=new', $inputsArr);
          $imagePath = FileHandler::moveFile('assets/images/motorcycles', $make.'_'.$model.'_'.'image');

          $motorcycleModel->insert(['make' => $make, 'model' => $model, 'imagePath' => $imagePath]);
          header("Location:".ROOT."/admin/motorcycles");
          break;
      }
      
    } else {
      $this->view('motorcycles');
    }
    
  }
}