<?php

class ResetPasswordModel extends Model {

  protected static $table = 'pwdreset';

  protected static $allowedColumns = [
    'email',
    'selector',
    'token',
    'expires'
  ];
}