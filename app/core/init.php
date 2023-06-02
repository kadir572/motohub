<?php

require_once 'config.php';
require_once 'functions.php';
require_once 'Database.php';
require_once 'Model.php';
require_once 'Controller.php';
require_once 'Mailer.php';

require_once '../app/models/MotorcycleModel.php';
require_once '../app/models/UserModel.php';
require_once '../app/models/ResetPasswordModel.php';

/** Load this last to make sure everything else is loaded already */
require_once 'App.php';