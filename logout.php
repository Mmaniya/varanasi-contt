<?php 
ob_start();
session_start();

foreach($_SESSION as $K=>$V){
	unset($_SESSION[$K]);
}
session_destroy();
session_unset();
header("location:index.php");

exit();
?>

