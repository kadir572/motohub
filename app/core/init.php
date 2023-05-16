<?php

require_once 'config.php';
require_once 'functions.php';
require_once 'Database.php';
require_once 'Model.php';
require_once 'PublicController.php';
require_once 'AdminController.php';
require_once 'Mailer.php';

require_once '../app/models/Motorcycle.php';
require_once '../app/models/User.php';
require_once '../app/models/ResetPassword.php';

/** Load this last to make sure everything else is loaded already */
require_once 'App.php';