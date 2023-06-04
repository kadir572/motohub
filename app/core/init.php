<?php

require_once 'config.php';
require_once 'functions.php';
require_once 'Database.php';
require_once 'Model.php';
require_once 'Controller.php';

foreach (glob('../app/models/*.php') as $filename) {
  require_once $filename;
}

foreach (glob('../app/utility/*.php') as $filename) {
  require_once $filename;
}

/** Load this last to make sure everything else is loaded already */
require_once 'App.php';