<?php

class Model {

  use Database;

  protected static $limit = 10;
  protected static $offset = 0;
  protected static $order_type = 'desc';
  protected static $order_column = 'id';
  public $errors = [];
  protected static $table = '';
  protected static $allowedColumns = [];

  public static function findAll() {
    $query = "select * from " . static::$table . " order by " . self::$order_column . " " . self::$order_type . " limit " . self::$limit . " offset " . self::$offset;

    return self::query($query);
  }

  public static function where($data, $data_not = []) {
    $keys = array_keys($data);
    $keys_not = array_keys($data_not);
    $query = "select * from " . static::$table . " where ";

    foreach ($keys as $key) {
      $query .= $key . " =:". $key . " && ";
    }

    foreach ($keys_not as $key) {
      $query .= $key . " != :" . $key . " && ";
    }

    $query = trim($query, " && ");

    $query .= " order by " . self::$order_column . " " . self::$order_type . " limit " . self::$limit . " offset " . self::$offset;
    $data = array_merge($data, $data_not);

    return self::query($query, $data);
  }

  public static function first($data, $data_not = []) {
    $keys = array_keys($data);
    $keys_not = array_keys($data_not);
    $query = "select * from " . static::$table . " where ";

    foreach ($keys as $key) {
      $query .= $key . " = :". $key . " && ";
    }

    foreach ($keys_not as $key) {
      $query .= $key . " != :". $key . " && ";
    }

    $query = trim($query, " && ");

    $query .= " limit " . self::$limit . " offset " . self::$offset;
    $data = array_merge($data, $data_not);

    $result = self::query($query, $data);
    if ($result) {
      return $result[0];
    }

    return false;
  }

  public static function insert($data) {
    /** remove unwated data */
    if(!empty(static::$allowedColumns)) {
      foreach ($data as $key => $value) {
        if (!in_array($key, static::$allowedColumns)) {
          unset($data[$key]);
        }
      }
    }

    $keys = array_keys($data);

    $query = "insert into " . static::$table . " (".implode(",", $keys).") values (:".implode(",:", $keys).")";
    self::query($query, $data);

    return false;
  }

  public static function update($id, $data, $id_column = "id") {
    /** remove unwated data */
    if (!empty(static::$allowedColumns)) {
      foreach ($data as $key => $value) {
        if (!in_array($key, static::$allowedColumns)) {
          unset($data[$key]);
        }
      }
    }

    $keys = array_keys($data);
    $query = "update " . static::$table . " set ";

    foreach ($keys as $key){
      $query .= $key . " = :". $key . ", ";
    }

    $query = trim($query, ", ");

    $query .= " where $id_column = :$id_column";

    $data[$id_column] = $id;

    self::query($query, $data);
    return false;
  }

  public static function delete($id, $id_column = 'id') {
    $data[$id_column] = $id;
    $query = "delete from " . static::$table . " where $id_column = :$id_column ";
    self::query($query, $data);

    return false;
  }
}