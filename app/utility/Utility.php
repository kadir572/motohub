<?php

class Utility {
  public static function show($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
  }
  
  public static function splitUrl() {
    $URL = $_GET['url'] ?? 'home';
    $URL = explode('/', trim($URL, '/'));
    return $URL;
  }
  
  public static function splitParams() {
    $splittedUrl = explode('?', $_GET['url']);
    parse_str($splittedUrl[1], $paramsArr);
    return $paramsArr;
  }
  
  public static function sanitize($str) {
    $sanitized = htmlspecialchars(strip_tags(preg_replace('/\x00|<[^>]*>/', '', $str)));
    return $sanitized;
  }
  
  public static function getCurrentDate() {
    return date('d-m-y h:i:s');
  }
  
  
  
  public static function capitalizeWordsInString($str) {
    $strArr = explode(" ", $str);
    $capitalizedArr = array_map('ucfirst', $strArr);
    $capitalizedStr = implode(' ', $capitalizedArr);
    return $capitalizedStr;
  }
}