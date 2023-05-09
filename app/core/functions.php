<?php

function show($data) {
  echo "<pre>";
  print_r($data);
  echo "</pre>";
}

function esc($string) {
  return htmlspecialchars($string);
}

function splitUrl() {
  $URL = $_GET['url'] ?? 'home';
  $URL = explode('/', trim($URL, '/'));
  return $URL;
}

function desinfect($str) {
  $str1 = strip_tags($str);
  $str2 = preg_replace('/\x00|<[^>]*>?/', '', $str1);
  $str3 = str_replace(["'", '"'], ['&#39;', '&#34;'], $str2);
  $str4 = htmlspecialchars($str3);
  return $str4;
}