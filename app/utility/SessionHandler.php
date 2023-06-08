<?php

class SessionHandler {
  public static function clearSessionLogin() {
    unset($_SESSION['username']);
    unset($_SESSION['permission']);
    unset($_SESSION['loginDate']);
  }
  
  public static function setSessionLogin($username, $permission) {
    $_SESSION['username'] = $username;
    $_SESSION['permission'] = $permission;
    $_SESSION['loginDate'] = Utility::getCurrentDate();
  }
}