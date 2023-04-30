<?php

require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'PublicController.php';
require 'AdminController.php';

/** Mock data */
require '../app/mockData/Motorcycles.php';
require '../app/models/Motorcycle.php';

/** Load this last to make sure everything else is loaded already */
require 'App.php';