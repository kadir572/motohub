<?php

class Home extends Controller {

  public function __construct() {
    $this->directory = 'public';
  }

  public function index() {
    $this->view('home');
  }

  public function motorcycles() {

    if (isset($_GET['type'])) {

      switch ($_GET['type']) {
        case 'details':
          $this->view('motorcycleDetails', ['id' => sanitize($_GET['id'])]);
          break;
      }

    } else {
      $this->view('motorcycles');
    }
    
  }

  public function contact() {
    if (isset($_GET['type'])) {
      switch ($_GET['type']) {
        case 'send':
          $pronounce = sanitize(trim($_POST['pronounce']));
          $name = sanitize(trim($_POST['name']));
          $email = sanitize(trim($_POST['email']));
          $reason = sanitize(trim($_POST['reason']));
          $message = sanitize(trim($_POST['message']));
          $getCopy = sanitize(trim($_POST['getCopy']));
          $formInfo = ['pronounce' => $pronounce, 'name' => $name, 'email' => $email, 'reason' => $reason, 'message' => $message, 'getCopy' => $getCopy];

          if (empty($pronounce)) {
            redirectWithError('Pronounce is required', '/home/contact', $formInfo);
            return;
          }

          if (empty($name)) {
            redirectWithError('Name is required', '/home/contact', $formInfo);
            return;
          }

          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            redirectWithError('Invalid email', '/home/contact', $formInfo);
            return;
          }

          if (empty($reason)) {
            redirectWithError('Reason is required', '/home/contact', $formInfo);
            return;
          }

          if (empty($message)) {
            redirectWithError('Message is required', '/home/contact', $formInfo);
            return;
          }

          $capitalizedName = capitalizeWordsInString($name);

          $msg = "<p>From: ".$email."</p>";
          $msg .= "<p>To: support@motohub.com</p>";
          $msg .= "<br>";
          $msg .= "<p>From ".ucfirst($pronounce)." ".$capitalizedName."</p>";
          $msg .= "<p>".$message."</p>";

          $mailer = new Mailer;
          $mailer->send($reason, $msg, $email, 'support@motohub.com');

          if ($getCopy === "on") {
            $msg .= "<p>This is a copy of the original message that was sent to support@motohub.com. Please do not reply to this message.</p>";
            $mailer->send($reason, $msg, $email, $email);
          }
          
          
          header("Location: ".ROOT."/home/contact?success=Your message was successfully sent");
          break;
        default:
          header("Location: ".ROOT);
          break;
      }
     return; 
    }

    $this->view('contact');
  }

  public function login() {
    $this->view('login');
  }

  public function register() {
    $this->view('register');
  }

  public function test() {
    $this->view('test');
  }

}