<?php
ini_set('display_errors',0);
require_once("includes/Config.tbl.inc.php");

require_once("config/config.php");

require_once("includes/functions.php");
require_once("includes/Session.php");

require_once("classes/DatabaseConnection.php");
require_once("classes/dB.php");
require_once("classes/service_function.php");

//classes
require_once("classes/Table.php");
require_once("classes/Users.php");

require_once("classes/admin_user.php");

session_start();
//ob_start();
ini_set('display_errors',0);
date_default_timezone_set('America/New_York');

?>

