<?php

session_start();
require '../app/core/init.php';

ini_set('display_errors', DEBUG ? 1: 0);

$app = new App;