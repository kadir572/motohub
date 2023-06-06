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
          $year = sanitize($_POST['year']);
          $displacement = sanitize($_POST['displacement']);
          $horsepower = sanitize($_POST['horsepower']);
          $peakHorsepowerRpm = sanitize($_POST['peakHorsepowerRpm']);
          $torque = sanitize($_POST['torque']);
          $peakTorqueRpm = sanitize($_POST['peakTorqueRpm']);

          $inputsArr = ['make' => $make, 'model' => $model, 'year' => $year, 'displacement' => $displacement, 'horsepower' => $horsepower,'peakHorsepowerRpm' => $peakHorsepowerRpm, 'torque' => $torque, 'peakTorqueRpm' => $peakTorqueRpm];

          $redirectPath = '/admin/motorcycles?type=edit';

          if (!MotorcycleModel::validate($inputsArr, $redirectPath)) return;

          if ($_FILES['imageUpload']['error'] === 0) {
            FileHandler::upload($_FILES['imageUpload'], '/admin/motorcycles');
            $imagePath = FileHandler::moveFile('assets/images/motorcycles', $make.'_'.$model.'_'.'image');
            $inputsArr += ['imagePath' => $imagePath];
            $motorcycleModel->update(sanitize($_GET['id']), $inputsArr);
          } else {
            $motorcycleModel->update(sanitize($_GET['id']), $inputsArr);
          }

          
          header("Location: ".ROOT."/admin/motorcycles");
          break;
        case 'new':
          $this->view('newMotorcycle');
          break;
        case 'create':
          $make = sanitize($_POST['make']);
          $model = sanitize($_POST['model']);
          $year = sanitize($_POST['year']);
          $displacement = sanitize($_POST['displacement']);
          $horsepower = sanitize($_POST['horsepower']);
          $peakHorsepowerRpm = sanitize($_POST['peakHorsepowerRpm']);
          $torque = sanitize($_POST['torque']);
          $peakTorqueRpm = sanitize($_POST['peakTorqueRpm']);

          $inputsArr = ['make' => $make, 'model' => $model, 'year' => $year, 'displacement' => $displacement, 'horsepower' => $horsepower,'peakHorsepowerRpm' => $peakHorsepowerRpm, 'torque' => $torque, 'peakTorqueRpm' => $peakTorqueRpm];

          $redirectPath = '/admin/motorcycles?type=new';

          if (!MotorcycleModel::validate($inputsArr, $redirectPath)) return;

          FileHandler::upload($_FILES['imageUpload'], $redirectPath, $inputsArr);
          $imagePath = FileHandler::moveFile('assets/images/motorcycles', $make.'_'.$model.'_'.'image');

          $inputsArr += ['imagePath' => $imagePath];

          $motorcycleModel->insert($inputsArr);
          header("Location:".ROOT."/admin/motorcycles");
          break;
      }
      
    } else {
      $this->view('motorcycles');
    }
    
  }
}