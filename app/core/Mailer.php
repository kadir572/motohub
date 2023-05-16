<?php

use PHPMailer\PHPMailer\PHPMailer;

// Require PHP Mailer
require_once '../app/libs/PHPMailer/src/PHPMailer.php';
require_once '../app/libs/PHPMailer/src/Exception.php';
require_once '../app/libs/PHPMailer/src/SMTP.php';


class Mailer {
  private $resetModel;
  private $userModel;
  private $mail;

  public function __construct() 
  {
    $this->resetModel = new ResetPassword;
    $this->userModel = new User;
    // taken from MailTrap SMTP settings
    $this->mail = new PHPMailer();
    $this->mail->isSMTP();
    $this->mail->Host = MAILHOST;
    $this->mail->SMTPAuth = true;
    $this->mail->Port = MAILPORT;
    $this->mail->Username = MAILUSERNAME;
    $this->mail->Password = MAILPASS;
  }

  public function sendPwdReset($email) {

    // Will be used to query the user from the database
    $selector = bin2hex(random_bytes(8));

    // Will be used for confirmation once the database entry has been matched
    $token = random_bytes(32);

    $url = ROOT."/resetpwd/resetPasswordForm?selector=".$selector."&validator=".bin2hex($token);

    // Expiration date will last for half an hour
    $expires = date("U") + 1800;

    $this->resetModel->delete($email, 'email');

    $user = $this->userModel->first(['email' => $email]);

    if (!$user) {
      // For security: To simulate the process time of sending the email
      sleep(2.5);
      header("Location: ".ROOT."/resetpwd?success=Reset link was sent to your email");
      return;
    }

    $hashedToken = password_hash($token, PASSWORD_DEFAULT);

    $this->resetModel->insert(['email' => $email, 'selector' => $selector, 'token' => $hashedToken, 'expires' => $expires]);

    $subject = "Reset your password";
    $message = "<p>We received a password reset request.</p>";
    $message .= "<p>Here is your password reset link: </p>";
    $message .= "<a href=".$url.">".$url."</a>";

    $this->send($subject, $message, 'support@motohub.com', $email);

    header("Location: ".ROOT."/resetpwd?success=Reset link was sent to your email");
  }

  public function send($subject, $message, $sender, $receiver) {
    $this->mail->setFrom($sender);
    $this->mail->isHTML(true);
    $this->mail->Subject = $subject;
    $this->mail->Body = $message;
    $this->mail->addAddress($receiver);

    $this->mail->send();

  }
}