
<?php

//require configuration file
require_once('../configuration/configuration.php');
//require database connection
require_once(ROOT .'application/database.php');

//require helper function
require_once(ROOT . 'helper/redirect.php');

//require helper function
require_once(ROOT . 'helper/messages.php');

session_destroy();
To('admin/login');
