<?php

function show($data) {
  echo "<pre>";
  print_r($data);
  echo "</pre>";
}

function splitUrl() {
  $URL = $_GET['url'] ?? 'home';
  $URL = explode('/', trim($URL, '/'));
  return $URL;
}

function splitParams() {
  $splittedUrl = explode('?', $_GET['url']);
  parse_str($splittedUrl[1], $paramsArr);
  return $paramsArr;
}

function desinfect($str) {
  $str1 = strip_tags($str);
  $str2 = preg_replace('/\x00|<[^>]*>?/', '', $str1);
  $str3 = str_replace(["'", '"'], ['&#39;', '&#34;'], $str2);
  $str4 = htmlspecialchars($str3);
  return $str4;
}

function validateEmail($email) {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirectWithError('Invalid email', '/home/register');
    return false;
  }

  return true;
}

function validateUsername($username) {
  if (strlen($username) < 4) {
    redirectWithError('Username can not be shorter than 4 characters', '/home/register');
    return false;
  }

  if (strlen($username) > 16) {
    redirectWithError('Username can not be longer than 16 characters', '/home/register');
    return false;
  }

  if (preg_match('/\s/',$username)) {
    redirectWithError('Username can not contain blank spaces', '/home/register');
    return false;
  }

  if (preg_match("/[!\[^\'£$%^&*()}{@:\'#~?><>,;@\|\\\-=\-_+\-¬\`\]]/", $username)) {
    redirectWithError('Username can not contain special characters', '/home/register');
    return false;
  }

  return true;
}

function validatePassword($password, $password2) {
  if ($password !== $password2) {
    redirectWithError('Passwords must match', '/home/register');
    return false;
   }

   if (strlen($password) < 8) {
    redirectWithError('Password must be atleast 8 characters long', '/home/register');
    return false;
   }

   if (!preg_match('/[a-z]/', $password)) {
    redirectWithError('Password must contain lowercase characters', '/home/register');
    return false;
   }

   if (!preg_match('/[A-Z]/', $password)) {
    redirectWithError('Password must contain uppercase characters', '/home/register');
    return false;
   }

   if(!preg_match('/[0-9]/', $password)) {
    redirectWithError('Password must contain numbers', '/home/register');
    return false;
   }

   if(!preg_match("/[!\[^\'£$%^&*()}{@:\'#~?><>,;@\|\\\-=\-_+\-¬\`\]]/", $password)) {
    redirectWithError('Password must contain special characters', '/home/register');
    return false;
   }

   if (preg_match('/\s/',$password)) {
    redirectWithError('Password can not contain blank spaces', '/home/register');
    return false;
   }

   return true;
}

function redirectWithError($error, $redirectPath) {
  $redirectPath = $redirectPath."?error=$error";
  header("Location: ".ROOT.$redirectPath);
}

function getCurrentDate() {
  return date('d-m-y h:i:s');
}

function clearSessionLogin() {
  unset($_SESSION['username']);
  unset($_SESSION['permission']);
  unset($_SESSION['loginDate']);
}

function setSessionLogin($username, $permission) {
  $_SESSION['username'] = $username;
  $_SESSION['permission'] = $permission;
  $_SESSION['loginDate'] = getCurrentDate();
}