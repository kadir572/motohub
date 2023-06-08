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
      Validator::redirectWithError('Missing email', '/resetpwd');
      return;
    }

    $email = Utility::sanitize(trim($_POST['email']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      Validator::redirectWithError('Invalid email', '/resetpwd');
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
    $selector = Utility::sanitize(trim($_POST['selector']));
    $validator = Utility::sanitize(trim($_POST['validator']));
    $password = Utility::sanitize(trim($_POST['password']));
    $password2 = Utility::sanitize(trim($_POST['password2']));

    if (empty($password) || empty($password2)) {
      Validator::redirectWithError('Please fill out all fields', '/resetpwd/resetPasswordForm', ['selector' => $selector, 'validator' => $validator]);
      return;
    }

    if (!Validator::validatePassword($password, $password2, '/resetpwd/resetPasswordForm', ['selector' => $selector, 'validator' => $validator])) return;

     $currentDate = date("U");
     
     $resetRequest = ResetPasswordModel::first(['selector' => $selector]);

     if (!$resetRequest) {
      Validator::redirectWithError('Sorry. The link is no longer valid.', "/resetpwd");
      return;
     }

     if (!$resetRequest->expires >= $currentDate) {
      Validator::redirectWithError('Sorry. The link is no longer valid.', "/resetpwd");
      return;
     }

     $tokenBin = hex2bin($validator);
     $tokenCheck = password_verify($tokenBin, $resetRequest->token);

     if (!$tokenCheck) {
      Validator::redirectWithError('You need to resubmit your reset request', '/resetpwd/resetPasswordForm', ['selector' => $selector, 'validator' => $validator]);
      return;
     }

     $email = $resetRequest->email;
     $user = UserModel::first(['email' => $email]);
     if (!$user) {
      Validator::redirectWithError('There was an error', '/resetpwd');
      return;
     }

     $hash = password_hash($password, PASSWORD_DEFAULT);

     UserModel::update($email, ['hash' => $hash], 'email');

     ResetPasswordModel::delete($email, 'email');

     SessionHandler::setSessionLogin($user->username, $user->isAdmin);

     header("Location: ".ROOT."/resetpwd?success=Password was updated successfully");
  }
}