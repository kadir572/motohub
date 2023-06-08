<?php

class _SessionHandler {
  private static $sessionTimeoutDuration = SESSION_TIMEOUT_DURATION ?? 1800;

  public static function clearSessionLogin() {
    unset($_SESSION['username']);
    unset($_SESSION['permission']);
    unset($_SESSION['loginDate']);
    unset($_SESSION['lastActivity']);
  }
  
  public static function setSessionLogin($username, $permission) {
    $_SESSION['username'] = $username;
    $_SESSION['permission'] = $permission;
    $_SESSION['loginDate'] = Utility::getCurrentDate();
    self::setSessionActivity();
  }

  public static function checkSessionActivity() {
    if (isset($_SESSION['username'])) {
      if (date('U') - $_SESSION['lastActivity'] > self::$sessionTimeoutDuration) {
        return header("Location: ".ROOT."/auth/logout?error=You've been logged out due to inactivity");
      } else {
        self::setSessionActivity();
      }
    }
  }

  public static function setSessionActivity() {
    $_SESSION['lastActivity'] = date('U');
  }
}