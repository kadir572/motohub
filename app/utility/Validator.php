<?php

class Validator {
  public static function redirectWithError($error, $redirectPath, $queries = []) {
    $focusId = '';
    
      if (strpos($redirectPath, '#')) {
        $strArr = explode('#', $redirectPath);
        $focusId = $strArr[1];
        $redirectPath = $strArr[0];
      }
      if (strpos($redirectPath, '?')) {
        $redirectPath = $redirectPath."&error=$error";
      } else {
        $redirectPath = $redirectPath."?error=$error";
      }
      
      if (count($queries) > 0) {
        foreach ($queries as $key => $value) {
          $redirectPath .= "&".$key."=".$value;
        }
    
      if ($focusId) {
        $redirectPath .= '#' . $focusId;
      }
      }
      header("Location: ".ROOT.$redirectPath);
  }

  public static function validatePassword($password, $password2, $redirect, $queries = []) {
    if ($password !== $password2) {
      self::redirectWithError('Passwords must match', $redirect, $queries);
      return false;
     }
  
     if (strlen($password) < 8) {
      self::redirectWithError('Password must be atleast 8 characters long', $redirect, $queries);
      return false;
     }
  
     if (!preg_match('/[a-z]/', $password)) {
      self::redirectWithError('Password must contain lowercase characters', $redirect, $queries);
      return false;
     }
  
     if (!preg_match('/[A-Z]/', $password)) {
      self::redirectWithError('Password must contain uppercase characters', $redirect, $queries);
      return false;
     }
  
     if(!preg_match('/[0-9]/', $password)) {
      self::redirectWithError('Password must contain numbers', $redirect, $queries);
      return false;
     }
   
     if(!preg_match('/(?=.*[^\w])/', $password)) {
      self::redirectWithError('Password must contain special characters', $redirect, $queries);
      return false;
     }
  
     if (preg_match('/\s/',$password)) {
      self::redirectWithError('Password can not contain blank spaces', $redirect, $queries);
      return false;
     }
  
     return true;
  }

  public static function validateUsername($username, $redirectPath, $queries = []) {
    if (strlen($username) < 4) {
      self::redirectWithError('Username can not be shorter than 4 characters', $redirectPath, $queries);
      return false;
    }
  
    if (strlen($username) > 16) {
      self::redirectWithError('Username can not be longer than 16 characters', $redirectPath, $queries);
      return false;
    }
  
    if (preg_match('/\s/',$username)) {
      self::redirectWithError('Username can not contain blank spaces', $redirectPath, $queries);
      return false;
    }
  
    if (preg_match("/[!\\[\\^\'£$%^&*()}{@:\'#~?><>,;@\\|\\\=\-_+\\-¬\`\\]]/", $username)) {
      self::redirectWithError('Username can not contain special characters', $redirectPath, $queries);
      return false;
    }
  
    return true;
  }

  public static function validateEmail($email, $redirectPath, $queries = []) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      self::redirectWithError('Invalid email', $redirectPath, $queries);
      return false;
    }
  
    return true;
  }
}