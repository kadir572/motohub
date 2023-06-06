<?php

class MotorcycleModel {
  
  use Model;

  protected $table = 'motorcycle';

  protected $allowedColumns = [
    'make',
    'model',
    'year',
    'imagePath',
    'displacement',
    'horsepower',
    'peakHorsepowerRpm',
    'torque',
    'peakTorqueRpm'
  ];

  public static function validate($inputsArr, $redirectPath) {
    $hasErr = false;
    $errMsg = '';

    foreach($inputsArr as $key => $value) {
      if (!$value) {
        $hasErr = true;
        $errMsg = ucfirst($key) . " can not be empty";
        break;
      }
    }

    if ($hasErr) {
      redirectWithError($errMsg, $redirectPath, $inputsArr);
      return false;
    }

    if (strlen($inputsArr['year']) !== 4 || !preg_match('/[0-9]/', $inputsArr['year'])) {
      $hasErr = true;
      $errMsg = 'Year must consist of 4 digits (0-9)';
    } elseif (!preg_match('/[0-9]/', $inputsArr['displacement'])) {
      $hasErr = true;
      $errMsg = 'Displacement must only consist of digits (0-9)';
    } elseif (!preg_match('/\d+\.?\d*/', $inputsArr['horsepower'])) {
      $hasErr = true;
      $errMsg = 'Horsepower can only be an integer or decimal number';
    } elseif (!preg_match('/[0-9]/', $inputsArr['peakHorsepowerRpm'])) {
      $hasErr = true;
      $errMsg = 'Peak horsepower rpm must consist of digits (0-9)';
    } elseif (!preg_match('/\d+\.?\d*/', $inputsArr['torque'])) {
      $hasErr = true;
      $errMsg = 'Torque can only be an integer or decimal number';
    } elseif (!preg_match('/[0-9]/', $inputsArr['peakTorqueRpm'])) {
      $hasErr = true;
      $errMsg = 'Peak torque rpm must consist of digits (0-9)';
    }

    if ($hasErr) {
      redirectWithError($errMsg, $redirectPath, $inputsArr);
      return false;
    }

    return true;
    
  }
}