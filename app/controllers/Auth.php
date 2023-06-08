<?php

class Auth {

  public function index() {
    
    if (!empty($_POST['type'])) {
      switch ($_POST['type']) {
        case 'login':
          clearSessionLogin();

          $username = $_POST['username'] ?? '';
          $password = $_POST['password'] ?? '';

          $this->login(['username' => sanitize(trim($username)), 'password' => sanitize(trim($password)), 'user' => sanitize($_POST['user'])]);
          break;
        case 'register':
          clearSessionLogin();
          
          $username = $_POST['username'] ?? '';
          $email = $_POST['email'] ?? '';
          $password = $_POST['password'] ?? '';
          $password2 = $_POST['password2'] ?? '';

          $this->register(['username' => sanitize(trim($username)), 'email' => sanitize(trim($email)), 'password' => sanitize(trim($password)), 'password2' => sanitize(trim($password2)), 'user' => sanitize($_POST['user'])]);

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
            redirectWithError('Missing credentials', '/home/login');
            return;
          }

          if (!LoginLimiter::canLogin()) {
            $timePassed = date('U') - LoginLimiter::getLastLoginAttempt();
            $timeRequired = 60 - $timePassed;
            return redirectWithError("Please wait $timeRequired seconds before trying to log in again.", '/home/login');
          }

          $foundUser = UserModel::first(['username' => $data['username']]);

          if (empty($foundUser)) {
            $attemptsLeft = LoginLimiter::setLoginAttempt();
            if ($attemptsLeft > 0) {
              redirectWithError("Invalid credentials. Attempts left: $attemptsLeft", '/home/login');
              return;
            } else {
              $timePassed = date('U') - LoginLimiter::getLastLoginAttempt();
              $timeRequired = 60 - $timePassed;
              return redirectWithError("Please wait $timeRequired seconds before trying to log in again.", '/home/login');
            }
          }

          if ($foundUser->isAdmin !== 0) {
            $attemptsLeft = LoginLimiter::setLoginAttempt();
            if ($attemptsLeft > 0) {
              redirectWithError("Invalid credentials. Attempts left: $attemptsLeft", '/home/login');
              return;
            } else {
              $timePassed = date('U') - LoginLimiter::getLastLoginAttempt();
              $timeRequired = 60 - $timePassed;
              return redirectWithError("Please wait $timeRequired seconds before trying to log in again.", '/home/login');
            }
          }

          $pwdMatches = password_verify($data['password'], $foundUser->hash);

          if (!$pwdMatches) {
            $attemptsLeft = LoginLimiter::setLoginAttempt();
            if ($attemptsLeft > 0) {
              redirectWithError("Invalid credentials. Attempts left: $attemptsLeft", '/home/login');
              return;
            } else {
              $timePassed = date('U') - LoginLimiter::getLastLoginAttempt();
              $timeRequired = 60 - $timePassed;
              return redirectWithError("Please wait $timeRequired seconds before trying to log in again.", '/home/login');
            }
          }

          LoginLimiter::reset();

          setSessionLogin(ucfirst($foundUser->username), $foundUser->isAdmin);
          header("Location: ".ROOT."/user");
          break;
        case 'admin':
          if (empty($data['username']) || empty($data['password'])) {
            redirectWithError('Missing credentials', '/admin/login');
            return;
          }

          if (!LoginLimiter::canLogin()) {
            $timePassed = 60 - LoginLimiter::getLastLoginAttempt();
            $timeRequired = 60 - $timePassed;
            return redirectWithError("Please wait $timeRequired seconds before trying to log in again.", '/home/login');
          }

          $foundUser = UserModel::first(['username' => $data['username']]);

          if (empty($foundUser)) {
            $attemptsLeft = LoginLimiter::setLoginAttempt();
            if ($attemptsLeft > 0) {
              redirectWithError("Invalid credentials. Attempts left: $attemptsLeft", '/admin/login');
              return;
            } else {
              $timePassed = date('U') - LoginLimiter::getLastLoginAttempt();
              $timeRequired = 60 - $timePassed;
              return redirectWithError("Please wait $timeRequired seconds before trying to log in again.", '/admin/login');
            }
          }

          if ($foundUser->isAdmin !== 1) {
            $attemptsLeft = LoginLimiter::setLoginAttempt();
            if ($attemptsLeft > 0) {
              redirectWithError("Invalid credentials. Attempts left: $attemptsLeft", '/admin/login');
              return;
            } else {
              $timePassed = date('U') - LoginLimiter::getLastLoginAttempt();
              $timeRequired = 60 - $timePassed;
              return redirectWithError("Please wait $timeRequired seconds before trying to log in again.", '/admin/login');
            }
          }

          $pwdMatches = password_verify($data['password'], $foundUser->hash);

          if (!$pwdMatches) {
            $attemptsLeft = LoginLimiter::setLoginAttempt();
            if ($attemptsLeft > 0) {
              redirectWithError("Invalid credentials. Attempts left: $attemptsLeft", '/admin/login');
              return;
            } else {
              $timePassed = date('U') - LoginLimiter::getLastLoginAttempt();
              $timeRequired = 60 - $timePassed;
              return redirectWithError("Please wait $timeRequired seconds before trying to log in again.", '/admin/login');
            }
          }

          LoginLimiter::reset();

          setSessionLogin(ucfirst($foundUser->username), $foundUser->isAdmin);
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
      redirectWithError('401 - Permission denied', $redirectPath, $inputsArr);
      return;
    }

    if (empty($data['username']) || empty($data['password']) || empty($data['password2']) || empty($data['email'])) {
      redirectWithError('Missing credentials', $redirectPath, $inputsArr);
      return;
      
    }

    $foundUserByUsername = UserModel::first(['username' => $data['username']]);

    if ($foundUserByUsername) {
      redirectWithError('Username not available', $redirectPath, $inputsArr);
      return;
    }

    if (!validateUsername($data['username'], $redirectPath, $inputsArr)) return;

    if (!validateEmail($data['email'], $redirectPath, $inputsArr)) return;

    $foundUserByEmail = UserModel::first(['email' => $data['email']]);

    if ($foundUserByEmail) {
      redirectWithError('Email not available', $redirectPath, $inputsArr);
      return;
    }

    if (!validatePassword($data['password'], $data['password2'], $redirectPath, $inputsArr)) return;

    $hash = password_hash($data['password'], PASSWORD_DEFAULT);

    // User registered
    UserModel::insert(['username' => $data['username'], 'email' => $data['email'], 'hash' => $hash]);

    $foundUser = UserModel::first(['username' => $data['username']]);

    // Log in if successfully created
    if ($foundUser) {
      setSessionLogin(ucfirst($foundUser->username), $foundUser->isAdmin);

      header("Location: ".ROOT."/user");
    } else {
      header("Location: ".ROOT);
    }
  }

  public function logout() {
    $permission = $_SESSION['permission'];
    clearSessionLogin();

    if ($permission === 1) {
      header("Location: ".ROOT."/admin");
    } else {
      header("Location: ".ROOT."/home/login");
    }
  }
}