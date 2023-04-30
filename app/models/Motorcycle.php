<?php

class Motorcycle {
  
  use Model;

  protected $table = 'motorcycle';

  protected $allowedColumns = [
    'make',
    'model',
    'imageUrl'
  ];

  public function validate($data) {
    $this->errors = [];

    if (empty($data['make'])) {
      $this->errors['make'] = "Motorcycle make is required";
    }

    if (empty($data['model'])) {
      $this->errors['model'] = 'Motorcycle model is required';
    }

    if (empty($data['imageUrl'])) {
      $this->errors['imageUrl'] = 'Motorcycle image url is required';
    }

    if (empty($this->errors)) {
      return true;
    }
    return false;
  }
  
}