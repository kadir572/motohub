<?php

class User extends Controller {

  public function __construct() {
    $this->directory = 'user';
  }

  public function index() {
    if (empty($_SESSION['username'])) {
      return redirectWithError('401 - Unauthorized', '/home/login');
    }
    $this->dashboard();
  }

  public function dashboard() {
    $this->view('dashboard');
  }

  public function settings() {
    $this->view('settings');
  }

  public function delete() {

    if ($_SESSION['permission'] !== 0) {
      redirectWithError('401 - Unauthorized', '/user/settings');
      return;
    } 

    $user = UserModel::first(['username' => $_SESSION['username']]);
    if ($user->isAdmin) {
      redirectWithError('401 - Unauthorized', '/user/settings');
      return;
    }

    UserModel::delete(sanitize($_GET['id']));
    clearSessionLogin();
    header("Location: ".ROOT);
  }

  public function edit() {

      
      $id = sanitize(trim($_POST['id']));
      $username = sanitize(trim($_POST['username']));
      $email = sanitize(trim($_POST['email']));
      $currentPassword = sanitize(trim($_POST['currentPassword']));
      $password = sanitize(trim($_POST['password']));
      $password2 = sanitize(trim($_POST['password2']));

      $inputsArr = ['username' => $username, 'email' => $email];

      $redirectPath = '/user/settings';

      $newPwdHash = '';

      $userFromId = UserModel::first(['id' => $id]);

      if (!$userFromId) return redirectWithError('User not found', $redirectPath, $inputsArr);

      if ($username && !validateUsername($username, $redirectPath, $inputsArr)) return; 

      if ($email && !validateEmail($email, $redirectPath, $inputsArr)) return;

      if ($username && $username === $userFromId->username) return redirectWithError('Username can not be the same as current username', $redirectPath, $inputsArr);

      if ($email && $email === $userFromId->email) return redirectWithError('Email can not be the same as current email', $redirectPath, $inputsArr);

      if ($username && $username !== $userFromId->username && UserModel::first(['username' => $username])) return redirectWithError('Username is taken', $redirectPath, $inputsArr);

      if ($email && $email !== $userFromId->email && UserModel::first(['email' => $email])) return redirectWithError('Email is taken', $redirectPath, $inputsArr);

      if ($username && !$currentPassword || $email && !$currentPassword) return redirectWithError('Current password is required', $redirectPath, $inputsArr);

      if ($currentPassword && !$username && !$email && !$password && !$password2) return redirectWithError('Please fill out fields you would like to update', $redirectPath);

      if ($password || $password2) {
        if(!validatePassword($password, $password2, $redirectPath, $inputsArr)) return;

        $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
      }

      $pwdMatch = password_verify($currentPassword, $userFromId->hash);

      if (!$pwdMatch) return redirectWithError('Incorrect password', $redirectPath, $inputsArr);

      $finalArr = [];

      if ($email) $finalArr['email'] = $email;
      if ($username) $finalArr['username'] = $username;
      if ($password) $finalArr['hash'] = $newPwdHash;

      UserModel::update($id, $finalArr);

      if ($username) $_SESSION['username'] = ucfirst($username);

      header("Location: ".ROOT.'/user/settings?success=User settings have been updated successfully');
  }
}