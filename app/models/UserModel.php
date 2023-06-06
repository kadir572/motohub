<?php

class UserModel extends Model {

  protected static $table = 'user';

  protected static $allowedColumns = [
    'username',
    'email',
    'hash'
  ];

  
}