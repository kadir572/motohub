<?php

class Auth {

  public function index() {
    
    if (!empty($_POST['type'])) {
      switch ($_POST['type']) {
        case 'login':
          clearSessionLogin();

          $username = $_POST['username'] ?? '';
          $password = $_POST['password'] ?? '';

          $this->login(['username' => desinfect(trim($username)), 'password' => desinfect(trim($password)), 'user' => desinfect($_POST['user'])]);
          break;
        case 'register':
          clearSessionLogin();
          
          $username = $_POST['username'] ?? '';
          $email = $_POST['email'] ?? '';
          $password = $_POST['password'] ?? '';
          $password2 = $_POST['password2'] ?? '';

          $this->register(['username' => desinfect(trim($username)), 'email' => desinfect(trim($email)), 'password' => desinfect(trim($password)), 'password2' => desinfect(trim($password2)), 'user' => desinfect($_POST['user'])]);

          break;
        default:
          header("Location: ".ROOT);
          break;
      }
    }
  }
  public function login($data) {
    
      switch ($data['user']) {
        case 'user':
          if (empty($data['username']) || empty($data['password'])) {
            redirectWithError('Missing credentials', '/home/login');
            return;
          }

          $userModel = new User();
          $foundUser = $userModel->first(['username' => $data['username']]);

          if (empty($foundUser)) {
            redirectWithError('Invalid credentials', '/home/login');
            return;
          }

          if ($foundUser->isAdmin !== 0) {
            redirectWithError('Invalid credentials', '/home/login');
            return;
          }

          $pwdMatches = password_verify($data['password'], $foundUser->hash);

          if (!$pwdMatches) {
            redirectWithError('Invalid credentials', '/home/login');
            return;
          }

          setSessionLogin(ucfirst($foundUser->username), $foundUser->isAdmin);
          header("Location: ".ROOT."/home/dashboard");
          break;
        case 'admin':
          if (empty($data['username']) || empty($data['password'])) {
            redirectWithError('Missing credentials', '/admin/login');
            return;
          }

          $userModel = new User();
          $foundUser = $userModel->first(['username' => $data['username']]);

          if (empty($foundUser)) {
            redirectWithError('Invalid credentials', '/admin/login');
            return;
          }

          if ($foundUser->isAdmin !== 1) {
            redirectWithError('Invalid credentials', '/admin/login');
            return;
          }

          $pwdMatches = password_verify($data['password'], $foundUser->hash);

          if (!$pwdMatches) {
            redirectWithError('Invalid credentials', '/admin/login');
            return;
          }

          setSessionLogin(ucfirst($foundUser->username), $foundUser->isAdmin);
          header("Location: ".ROOT."/admin");
          break;
        default:
          header("Location: ".ROOT);
          break;
      }   
  }

  public function register($data) {
    // user defines whether the register form is for a regular user or an admin. Currently only regular users can register.
    if ($data['user'] !== 'user') {
      redirectWithError('401 - Permission denied', '/home/register');
      return;
    }

    if (empty($data['username']) || empty($data['password']) || empty($data['password2']) || empty($data['email'])) {
      redirectWithError('Missing credentials', '/home/register');
      return;
      
    }

    $userModel = new User();
    $foundUserByUsername = $userModel->first(['username' => $data['username']]);

    if ($foundUserByUsername) {
      redirectWithError('Username not available', '/home/register');
      return;
    }

    if (!validateUsername($data['username'])) return;

    if (!validateEmail($data['email'])) return;

    $foundUserByEmail = $userModel->first(['email' => $data['email']]);

    if ($foundUserByEmail) {
      redirectWithError('Email not available', '/home/register');
      return;
    }

    if (!validatePassword($data['password'], $data['password2'])) return;

    $hash = password_hash($data['password'], PASSWORD_DEFAULT);

    // User registered
    $userModel->insert(['username' => $data['username'], 'email' => $data['email'], 'hash' => $hash]);

    $foundUser = $userModel->first(['username' => $data['username']]);

    // Log in if successfully created
    if ($foundUser) {
      setSessionLogin(ucfirst($foundUser->username), $foundUser->isAdmin);

      header("Location: ".ROOT."/home/dashboard");
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