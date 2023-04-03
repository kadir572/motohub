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