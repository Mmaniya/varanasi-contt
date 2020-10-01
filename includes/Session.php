<?
function GetSessionID(){
	session_start();
	$SessionID = session_id();
	session_write_close();
	return $SessionID ;
}
function SetSessionID($SessionID){
	session_start();
	session_id($SessionID);;
	session_write_close();
}
function SessionWrite($SessionName, $String){
	session_start();
	$_SESSION[$SessionName] = $String;
	session_write_close();
}
function SessionRead($SessionName){
	return $_SESSION[$SessionName];
}
function isExistsSession($SessionName){	
	return isset($_SESSION[$SessionName]) && $_SESSION[$SessionName] != "";	
}
function issetSession($SessionName){
	return isset($_SESSION[$SessionName]);
}
function isEmptySession($SessionName){
	return $_SESSION[$SessionName] != "";
}
function doUnsetSessionVar($SessionName){
	// session_start();
	unset($_SESSION[$SessionName]) ;
	session_write_close();	
}
function doEmptySessionVar($SessionName){
	session_start();
	$_SESSION[$SessionName] = '' ;
	session_write_close();	
}
?>