<?php

class Admin extends Controller {

  public function __construct() {
    $this->directory = 'admin';
  }

  public function index() {
    if (empty($_SESSION['username'])) {
      header("Location: ".ROOT."/admin/login");
    } else {
      if (!empty($_SESSION['permission'] && $_SESSION['permission'] == 1)) {
        header("Location: ".ROOT."/admin/dashboard");
      } else {
        Validator::redirectWithError('401 - Unauthorized', '/auth/logout');
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

      switch ($_GET['type']) {
        case 'remove':
          $id = Utility::sanitize($_GET['id']);
          $motorcycle = MotorcycleModel::first(['id' => $id]);
          $imagePath = $motorcycle->imagePath;
          FileHandler::removeFile($imagePath);
          MotorcycleModel::delete($id);
          header("Location: ".ROOT."/admin/motorcycles");
          break;
        case 'edit':
          $this->view('editMotorcycle', ['id' => Utility::sanitize($_GET['id'])]);
          break;
        case 'update':
          $id = Utility::sanitize($_GET['id']);

          $originalMake = strtolower(Utility::sanitize($_POST['originalMake']));
          $originalModel = strtolower(Utility::sanitize($_POST['originalModel']));

          $make = strtolower(Utility::sanitize($_POST['make']));
          $model = strtolower(Utility::sanitize($_POST['model']));
          $year = Utility::sanitize($_POST['year']);
          $displacement = Utility::sanitize($_POST['displacement']);
          $horsepower = Utility::sanitize($_POST['horsepower']);
          $peakHorsepowerRpm = Utility::sanitize($_POST['peakHorsepowerRpm']);
          $torque = Utility::sanitize($_POST['torque']);
          $peakTorqueRpm = Utility::sanitize($_POST['peakTorqueRpm']);

          $inputsArr = ['make' => $make, 'model' => $model, 'year' => $year, 'displacement' => $displacement, 'horsepower' => $horsepower,'peakHorsepowerRpm' => $peakHorsepowerRpm, 'torque' => $torque, 'peakTorqueRpm' => $peakTorqueRpm];

          $redirectPath = '/admin/motorcycles?type=edit&id='.$id;

          $foundMotorcycle = MotorcycleModel::first(['make' => $make, 'model' => $model]);

          if ($originalMake !== $make && $originalModel !== $model && $foundMotorcycle) return Validator::redirectWithError("Motorcycle $make $model already exists", $redirectPath);

          if (!MotorcycleModel::validate($inputsArr, $redirectPath)) return;
          
          if ($_FILES['imageUpload']['error'] === 0) {
            if (!FileHandler::upload($_FILES['imageUpload'], $redirectPath)) return;
            $imagePath = FileHandler::moveFile('assets/images/motorcycles', ucfirst($make).'_'.ucfirst($model).'_'.'image', true);
            $inputsArr['imagePath'] = $imagePath;
            MotorcycleModel::update(Utility::sanitize($_GET['id']), $inputsArr);
          } else {
            MotorcycleModel::update(Utility::sanitize($_GET['id']), $inputsArr);
          }

          
          header("Location: ".ROOT."/admin/motorcycles");
          break;
        case 'new':
          $this->view('newMotorcycle');
          break;
        case 'create':
          $make = strtolower(Utility::sanitize($_POST['make']));
          $model = strtolower(Utility::sanitize($_POST['model']));
          $year = Utility::sanitize($_POST['year']);
          $displacement = Utility::sanitize($_POST['displacement']);
          $horsepower = Utility::sanitize($_POST['horsepower']);
          $peakHorsepowerRpm = Utility::sanitize($_POST['peakHorsepowerRpm']);
          $torque = Utility::sanitize($_POST['torque']);
          $peakTorqueRpm = Utility::sanitize($_POST['peakTorqueRpm']);

          $inputsArr = ['make' => $make, 'model' => $model, 'year' => $year, 'displacement' => $displacement, 'horsepower' => $horsepower,'peakHorsepowerRpm' => $peakHorsepowerRpm, 'torque' => $torque, 'peakTorqueRpm' => $peakTorqueRpm];

          $redirectPath = '/admin/motorcycles?type=new';

          $foundMotorcycle = MotorcycleModel::first(['make' => $make, 'model' => $model]);

          if ($foundMotorcycle) return Validator::redirectWithError("Motorcycle $make $model already exists", $redirectPath, $inputsArr);

          if (!MotorcycleModel::validate($inputsArr, $redirectPath)) return;

          if (!FileHandler::upload($_FILES['imageUpload'], $redirectPath, $inputsArr)) return;
          $imagePath = FileHandler::moveFile('assets/images/motorcycles', ucfirst($make).'_'.ucfirst($model).'_'.'image');

          $inputsArr += ['imagePath' => $imagePath];

          MotorcycleModel::insert($inputsArr);
          header("Location:".ROOT."/admin/motorcycles");
          break;
      }
      
    } else {
      $this->view('motorcycles');
    }
    
  }
}