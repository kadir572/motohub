<?php

require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'PublicController.php';
require 'AdminController.php';

require '../app/models/Motorcycle.php';
require '../app/models/User.php';

/** Load this last to make sure everything else is loaded already */
require 'App.php';