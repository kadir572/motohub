<?php

class LoginLimiter {
  private static $maxAllowedLoginAttemps = 3;

  public static function setLoginAttempt() {
    if (!isset($_SESSION['loginAttempts'])) {
      $_SESSION['loginAttempts'] = 1;
    } else {
      ++$_SESSION['loginAttempts'];
    }
    if (self::getAttemptsLeft() >= 0) {
      $_SESSION['lastLoginAttempt'] = date('U');
    }

    return self::getAttemptsLeft();
  }

  public static function getLastLoginAttempt() {
    return $_SESSION['lastLoginAttempt'];
  }

  public static function getLoginAttempts() {
    if (isset($_SESSION['loginAttempts'])) {
      return $_SESSION['loginAttempts'];
    }
    return 0;
  }

  public static function getAttemptsLeft() {
    if (isset($_SESSION['loginAttempts'])) {
      return self::$maxAllowedLoginAttemps - self::getLoginAttempts();
    }
    return self::$maxAllowedLoginAttemps;
  }

  public static function reset() {
    unset($_SESSION['loginAttempts']);
  }

  public static function canLogin() {
    if (self::getAttemptsLeft() > 0) {
      return true;
    } elseif (self::getAttemptsLeft() <= 0 && date('U') - self::getLastLoginAttempt() > 60) {
      self::reset();
      return true;
    } else {
      return false;
    }  
  }
}