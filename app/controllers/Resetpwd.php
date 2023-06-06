<?php

class Resetpwd extends Controller {

  public function __construct() {
    $this->directory = 'public';
  }

  public function index() {
    $this->view('forgottenPassword');
  }

  // Initial request from {ROOT}/public/resetpwd
  public function sendRequest() {
    if (isset($_POST['email']) && empty($_POST['email'])) {
      redirectWithError('Missing email', '/resetpwd');
      return;
    }

    $email = sanitize(trim($_POST['email']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      redirectWithError('Invalid email', '/resetpwd');
      return;
    }

    $mailer = new Mailer;
    $mailer->sendPwdReset($email);
  }

  public function resetPasswordForm() {
    $this->view('resetPassword');
  }

  // after successful validation, updates the password for the user and deletes the reset password request from the database
  public function reset() {
    $selector = sanitize(trim($_POST['selector']));
    $validator = sanitize(trim($_POST['validator']));
    $password = sanitize(trim($_POST['password']));
    $password2 = sanitize(trim($_POST['password2']));

    if (empty($password) || empty($password2)) {
      redirectWithError('Please fill out all fields', '/resetpwd/resetPasswordForm', ['selector' => $selector, 'validator' => $validator]);
      return;
    }

    if (!validatePassword($password, $password2, '/resetpwd/resetPasswordForm', ['selector' => $selector, 'validator' => $validator])) return;

     $currentDate = date("U");
     
     $resetRequest = ResetPasswordModel::first(['selector' => $selector]);

     if (!$resetRequest) {
      redirectWithError('Sorry. The link is no longer valid.', "/resetpwd");
      return;
     }

     if (!$resetRequest->expires >= $currentDate) {
      redirectWithError('Sorry. The link is no longer valid.', "/resetpwd");
      return;
     }

     $tokenBin = hex2bin($validator);
     $tokenCheck = password_verify($tokenBin, $resetRequest->token);

     if (!$tokenCheck) {
      redirectWithError('You need to resubmit your reset request', '/resetpwd/resetPasswordForm', ['selector' => $selector, 'validator' => $validator]);
      return;
     }

     $email = $resetRequest->email;
     $user = UserModel::first(['email' => $email]);
     if (!$user) {
      redirectWithError('There was an error', '/resetpwd');
      return;
     }

     $hash = password_hash($password, PASSWORD_DEFAULT);

     UserModel::update($email, ['hash' => $hash], 'email');

     ResetPasswordModel::delete($email, 'email');

     setSessionLogin($user->username, $user->isAdmin);

     header("Location: ".ROOT."/resetpwd?success=Password was updated successfully");
  }
}