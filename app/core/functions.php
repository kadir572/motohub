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

function sanitize($str) {
  $sanitized = htmlspecialchars(strip_tags(preg_replace('/\x00|<[^>]*>/', '', $str)));
  return $sanitized;
}

function validateEmail($email, $redirectPath, $queries = []) {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirectWithError('Invalid email', $redirectPath, $queries);
    return false;
  }

  return true;
}

function validateUsername($username, $redirectPath, $queries = []) {
  if (strlen($username) < 4) {
    redirectWithError('Username can not be shorter than 4 characters', $redirectPath, $queries);
    return false;
  }

  if (strlen($username) > 16) {
    redirectWithError('Username can not be longer than 16 characters', $redirectPath, $queries);
    return false;
  }

  if (preg_match('/\s/',$username)) {
    redirectWithError('Username can not contain blank spaces', $redirectPath, $queries);
    return false;
  }

  if (preg_match("/[!\[^\'£$%^&*()}{@:\'#~?><>,;@\|\\\-=\-_+\-¬\`\]]/", $username)) {
    redirectWithError('Username can not contain special characters', $redirectPath, $queries);
    return false;
  }

  return true;
}

function validatePassword($password, $password2, $redirect, $queries = []) {
  if ($password !== $password2) {
    redirectWithError('Passwords must match', $redirect, $queries);
    return false;
   }

   if (strlen($password) < 8) {
    redirectWithError('Password must be atleast 8 characters long', $redirect, $queries);
    return false;
   }

   if (!preg_match('/[a-z]/', $password)) {
    redirectWithError('Password must contain lowercase characters', $redirect, $queries);
    return false;
   }

   if (!preg_match('/[A-Z]/', $password)) {
    redirectWithError('Password must contain uppercase characters', $redirect, $queries);
    return false;
   }

   if(!preg_match('/[0-9]/', $password)) {
    redirectWithError('Password must contain numbers', $redirect, $queries);
    return false;
   }
 
   if(!preg_match('/(?=\S*[^a-zA-Z0-9])/', $password)) {
    redirectWithError('Password must contain special characters', $redirect, $queries);
    return false;
   }

   if (preg_match('/\s/',$password)) {
    redirectWithError('Password can not contain blank spaces', $redirect, $queries);
    return false;
   }

   return true;
}

function redirectWithError($error, $redirectPath, $queries = []) {
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

function checkError($inputArr, $redirectPath) {
  $hasErr = false;
  $errMsg = '';

  foreach($inputArr as $key => $value) {
    if (!$value) {
      $hasErr = true;
      $errMsg = ucfirst($key) . " can not be empty";
      break;
    }
  }

  if ($hasErr) {
    redirectWithError($errMsg, $redirectPath, $inputArr);
    return false;
  }

  return true;
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

function capitalizeWordsInString($str) {
  $strArr = explode(" ", $str);
  $capitalizedArr = array_map('ucfirst', $strArr);
  $capitalizedStr = implode(' ', $capitalizedArr);
  return $capitalizedStr;
}

function formatNumber($num) {
  if (str_contains($num, '.')) {
    $numArr = explode('.', $num);
    if ($numArr[1] && $numArr[1] > 0) {
      return $num;
    }
    return $numArr[0];
  }
  return $num;
}