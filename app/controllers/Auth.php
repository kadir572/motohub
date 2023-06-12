<?php

class Auth {

  public function index() {
    
    if (!empty($_POST['type'])) {
      switch ($_POST['type']) {
        case 'login':
          _SessionHandler::clearSessionLogin();

          $username = $_POST['username'] ?? '';
          $password = $_POST['password'] ?? '';

          $this->login(['username' => Utility::sanitize(trim($username)), 'password' => Utility::sanitize(trim($password)), 'user' => Utility::sanitize($_POST['user'])]);
          break;
        case 'register':
          _SessionHandler::clearSessionLogin();
          
          $username = $_POST['username'] ?? '';
          $email = $_POST['email'] ?? '';
          $password = $_POST['password'] ?? '';
          $password2 = $_POST['password2'] ?? '';

          $this->register(
            [
              'username' => Utility::sanitize(trim($username)), 
              'email' => Utility::sanitize(trim($email)), 
              'password' => Utility::sanitize(trim($password)), 
              'password2' => Utility::sanitize(trim($password2)), 
              'user' => Utility::sanitize($_POST['user'])
              ]
          );

          break;
        default:
          header("Location: ".ROOT);
          break;
      }
    } else {
      header("Location: ".ROOT);
    }
  }
  private function login($data) {
      switch ($data['user']) {
        case 'user':
          if (empty($data['username']) || empty($data['password'])) {
            Validator::redirectWithError('Missing credentials', '/home/login');
            return;
          }

          $timePassed = date('U') - LoginLimiter::getLastLoginAttempt();
          if ($timePassed > 60) LoginLimiter::reset();

          if (!LoginLimiter::canLogin()) {
            $timeRequired = 60 - $timePassed;
            return Validator::redirectWithError("Please wait $timeRequired seconds before trying to log in again.", '/home/login');
          }

          $foundUser = UserModel::first(['username' => $data['username']]);

          if (empty($foundUser)) {
            $attemptsLeft = LoginLimiter::setLoginAttempt();
            if ($attemptsLeft > 0) {
              Validator::redirectWithError("Invalid credentials. Attempts left: $attemptsLeft", '/home/login');
              return;
            } else {
              $timePassed = date('U') - LoginLimiter::getLastLoginAttempt();
              $timeRequired = 60 - $timePassed;
              return Validator::redirectWithError("Please wait $timeRequired seconds before trying to log in again.", '/home/login');
            }
          }

          if ($foundUser->isAdmin != 0) {
            $attemptsLeft = LoginLimiter::setLoginAttempt();
            if ($attemptsLeft > 0) {
              Validator::redirectWithError("Invalid credentials. Attempts left: $attemptsLeft", '/home/login');
              return;
            } else {
              $timePassed = date('U') - LoginLimiter::getLastLoginAttempt();
              $timeRequired = 60 - $timePassed;
              return Validator::redirectWithError("Please wait $timeRequired seconds before trying to log in again.", '/home/login');
            }
          }

          $pwdMatches = password_verify($data['password'], $foundUser->hash);

          if (!$pwdMatches) {
            $attemptsLeft = LoginLimiter::setLoginAttempt();
            if ($attemptsLeft > 0) {
              Validator::redirectWithError("Invalid credentials. Attempts left: $attemptsLeft", '/home/login');
              return;
            } else {
              $timePassed = date('U') - LoginLimiter::getLastLoginAttempt();
              $timeRequired = 60 - $timePassed;
              return Validator::redirectWithError("Please wait $timeRequired seconds before trying to log in again.", '/home/login');
            }
          }

          LoginLimiter::reset();

          _SessionHandler::setSessionLogin(ucfirst($foundUser->username), $foundUser->isAdmin);
          header("Location: ".ROOT."/user");
          break;
        case 'admin':
          if (empty($data['username']) || empty($data['password'])) {
            Validator::redirectWithError('Missing credentials', '/admin/login');
            return;
          }

          $timePassed = date('U') - LoginLimiter::getLastLoginAttempt();
          if ($timePassed > 60) LoginLimiter::reset();

          if (!LoginLimiter::canLogin()) {
            $timeRequired = 60 - $timePassed;
            return Validator::redirectWithError("Please wait $timeRequired seconds before trying to log in again.", '/admin/login');
          }

          $foundUser = UserModel::first(['username' => $data['username']]);

          if (empty($foundUser)) {
            $attemptsLeft = LoginLimiter::setLoginAttempt();
            if ($attemptsLeft > 0) {
              Validator::redirectWithError("Invalid credentials. Attempts left: $attemptsLeft", '/admin/login');
              return;
            } else {
              $timePassed = date('U') - LoginLimiter::getLastLoginAttempt();
              $timeRequired = 60 - $timePassed;
              return Validator::redirectWithError("Please wait $timeRequired seconds before trying to log in again.", '/admin/login');
            }
          }

          if ($foundUser->isAdmin != 1) {
            $attemptsLeft = LoginLimiter::setLoginAttempt();
            if ($attemptsLeft > 0) {
              Validator::redirectWithError("Invalid credentials. Attempts left: $attemptsLeft", '/admin/login');
              return;
            } else {
              $timePassed = date('U') - LoginLimiter::getLastLoginAttempt();
              $timeRequired = 60 - $timePassed;
              return Validator::redirectWithError("Please wait $timeRequired seconds before trying to log in again.", '/admin/login');
            }
          }

          $pwdMatches = password_verify($data['password'], $foundUser->hash);

          if (!$pwdMatches) {
            $attemptsLeft = LoginLimiter::setLoginAttempt();
            if ($attemptsLeft > 0) {
              Validator::redirectWithError("Invalid credentials. Attempts left: $attemptsLeft", '/admin/login');
              return;
            } else {
              $timePassed = date('U') - LoginLimiter::getLastLoginAttempt();
              $timeRequired = 60 - $timePassed;
              return Validator::redirectWithError("Please wait $timeRequired seconds before trying to log in again.", '/admin/login');
            }
          }

          LoginLimiter::reset();

          _SessionHandler::setSessionLogin(ucfirst($foundUser->username), $foundUser->isAdmin);
          header("Location: ".ROOT."/admin");
          break;
        default:
          header("Location: ".ROOT);
          break;
      }   
  }

  private function register($data) {
    $redirectPath = '/home/register';

    $inputsArr = ['username' => $data['username'], 'email' => $data['email']];

    // user defines whether the register form is for a regular user or an admin. Currently only regular users can register.
    if ($data['user'] !== 'user') {
      Validator::redirectWithError('401 - Permission denied', $redirectPath, $inputsArr);
      return;
    }

    if (empty($data['username']) || empty($data['password']) || empty($data['password2']) || empty($data['email'])) {
      Validator::redirectWithError('Missing credentials', $redirectPath, $inputsArr);
      return;
      
    }

    $foundUserByUsername = UserModel::first(['username' => $data['username']]);

    if ($foundUserByUsername) {
      Validator::redirectWithError('Username not available', $redirectPath, $inputsArr);
      return;
    }

    if (!Validator::validateUsername($data['username'], $redirectPath, $inputsArr)) return;

    if (!Validator::validateEmail($data['email'], $redirectPath, $inputsArr)) return;

    $foundUserByEmail = UserModel::first(['email' => $data['email']]);

    if ($foundUserByEmail) {
      Validator::redirectWithError('Email not available', $redirectPath, $inputsArr);
      return;
    }

    if (!Validator::validatePassword($data['password'], $data['password2'], $redirectPath, $inputsArr)) return;

    $hash = password_hash($data['password'], PASSWORD_DEFAULT);

    // User registered
    UserModel::insert(['username' => $data['username'], 'email' => $data['email'], 'hash' => $hash]);

    $foundUser = UserModel::first(['username' => $data['username']]);

    // Log in if successfully created
    if ($foundUser) {
      _SessionHandler::setSessionLogin(ucfirst($foundUser->username), $foundUser->isAdmin);

      header("Location: ".ROOT."/user");
    } else {
      header("Location: ".ROOT);
    }
  }

  public function logout() {
    $permission = $_SESSION['permission'];
    _SessionHandler::clearSessionLogin();

    // if admin
    if ($permission == 1) {
      if (!empty($_GET['error'])) {
        header("Location: ".ROOT."/admin/login?error=".$_GET['error']);
      } else {
        header("Location: ".ROOT."/admin");
      }
      
      // if user
    } else {
      if (!empty($_GET['error'])) {
        header("Location: ".ROOT."/home/login?error=".$_GET['error']);
      } else {
        header("Location: ".ROOT."/home/login");
      }
    }
  }
}