<?php

class User {

  use Model;

  protected $table = 'user';

  protected $allowedColumns = [
    'username',
    'email',
    'password'
  ];

  
}