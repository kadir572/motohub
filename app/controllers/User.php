<?php

class User extends Controller {

  public function __construct() {
    $this->directory = 'user';
  }

  public function index() {
    if (empty($_SESSION['username'])) {
      return Validator::redirectWithError('401 - Unauthorized', '/home/login');
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
      Validator::redirectWithError('401 - Unauthorized', '/user/settings');
      return;
    } 

    $user = UserModel::first(['username' => $_SESSION['username']]);
    if ($user->isAdmin) {
      Validator::redirectWithError('401 - Unauthorized', '/user/settings');
      return;
    }

    UserModel::delete(Utility::sanitize($_GET['id']));
    SessionHandler::clearSessionLogin();
    header("Location: ".ROOT);
  }

  public function edit() {

      
      $id = Utility::sanitize(trim($_POST['id']));
      $username = Utility::sanitize(trim($_POST['username']));
      $email = Utility::sanitize(trim($_POST['email']));
      $currentPassword = Utility::sanitize(trim($_POST['currentPassword']));
      $password = Utility::sanitize(trim($_POST['password']));
      $password2 = Utility::sanitize(trim($_POST['password2']));

      $inputsArr = ['username' => $username, 'email' => $email];

      $redirectPath = '/user/settings';

      $newPwdHash = '';

      $userFromId = UserModel::first(['id' => $id]);

      if (!$userFromId) return Validator::redirectWithError('User not found', $redirectPath, $inputsArr);

      if ($username && !Validator::validateUsername($username, $redirectPath, $inputsArr)) return; 

      if ($email && !Validator::validateEmail($email, $redirectPath, $inputsArr)) return;

      if ($username && $username === $userFromId->username) return Validator::redirectWithError('Username can not be the same as current username', $redirectPath, $inputsArr);

      if ($email && $email === $userFromId->email) return Validator::redirectWithError('Email can not be the same as current email', $redirectPath, $inputsArr);

      if ($username && $username !== $userFromId->username && UserModel::first(['username' => $username])) return Validator::redirectWithError('Username is taken', $redirectPath, $inputsArr);

      if ($email && $email !== $userFromId->email && UserModel::first(['email' => $email])) return Validator::redirectWithError('Email is taken', $redirectPath, $inputsArr);

      if ($username && !$currentPassword || $email && !$currentPassword) return Validator::redirectWithError('Current password is required', $redirectPath, $inputsArr);

      if ($currentPassword && !$username && !$email && !$password && !$password2) return Validator::redirectWithError('Please fill out fields you would like to update', $redirectPath);

      if ($password || $password2) {
        if(!Validator::validatePassword($password, $password2, $redirectPath, $inputsArr)) return;

        $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
      }

      $pwdMatch = password_verify($currentPassword, $userFromId->hash);

      if (!$pwdMatch) return Validator::redirectWithError('Incorrect password', $redirectPath, $inputsArr);

      $finalArr = [];

      if ($email) $finalArr['email'] = $email;
      if ($username) $finalArr['username'] = $username;
      if ($password) $finalArr['hash'] = $newPwdHash;

      UserModel::update($id, $finalArr);

      if ($username) $_SESSION['username'] = ucfirst($username);

      header("Location: ".ROOT.'/user/settings?success=User settings have been updated successfully');
  }
}