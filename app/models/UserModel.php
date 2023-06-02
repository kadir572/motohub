<?php

class UserModel {

  use Model;

  protected $table = 'user';

  protected $allowedColumns = [
    'username',
    'email',
    'hash'
  ];

  
}