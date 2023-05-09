<?php

class Auth {
  public function login() {
    unset($_SESSION['username']);
    unset($_SESSION['permission']);
    unset($_SESSION['errors']);
    $_SESSION['errors'] = [];
    if (!empty($_POST['type']) && $_POST['type'] === 'login') {
      if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $_POST['username'] = desinfect($_POST['username']);
        $_POST['password'] = desinfect($_POST['password']);
        $userModel = new User();
        $foundUser = $userModel->first(['username' => $_POST['username']]);

        if (!empty($foundUser)) {
          // User found in database
          if ($foundUser->isAdmin === 1) {
            // User is an admin
            $pwdMatches = password_verify($_POST['password'], $foundUser->hash);

            if ($pwdMatches) {
              // Pasword matches
              $_SESSION['username'] = ucfirst($foundUser->username);
              $_SESSION['permission'] = $foundUser->isAdmin;
              $_SESSION['errors'] = [];
              header("Location: ".ROOT."/admin");
            } else {
              array_push($_SESSION['errors'], 'Incorrect credentials');
              header("Location: ".ROOT."/admin/login");
            }
          } else {
            array_push($_SESSION['errors'], 'Incorrect credentials');
            header("Location: ".ROOT."/admin/login");
          }
        } else {
          array_push($_SESSION['errors'], 'Incorrect credentials');
          header("Location: ".ROOT."/admin/login");
        }
      } else {
        array_push($_SESSION['errors'], 'Credentials missing');
        header("Location: ".ROOT."/admin/login");
      }
    } else {
      array_push($_SESSION['errors'], 'Incorrect action type');
      header("Location: ".ROOT."/admin/login");
    }
  }

  public function logout() {
    unset($_SESSION['username']);
    unset($_SESSION['permission']);
    header("Location: ".ROOT."/admin");
  }
}