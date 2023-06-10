<?php

class MotorcycleComparer {

  private static $sessionName = 'compareMotorcycles';

  public static function removeOne($id) {
    if (!empty($_SESSION[self::$sessionName][$id])) {
      unset($_SESSION[self::$sessionName][$id]);
    }
    return self::getAll();
  }

  public static function addOne($id) {
    if (empty($_SESSION[self::$sessionName])) self::createSessionVar();
    array_push($_SESSION[self::$sessionName], $id);
    return self::getAll();
  }

  public static function getAll() {
    if (empty($_SESSION[self::$sessionName])) self::createSessionVar();
    return $_SESSION[self::$sessionName];
  }

  private static function createSessionVar() {
    $_SESSION[self::$sessionName] = [];
  }
}