<?php

class ResetPassword {

  use Model;

  protected $table = 'pwdreset';

  protected $allowedColumns = [
    'email',
    'selector',
    'token',
    'expires'
  ];
}