<?

$dev_server = TRUE;
define("LOCAL", true);
session_start();

if ($dev_server) {

	// Dev Database credentials
	define("BA_DBHOST", "localhost");
	define("BA_DBUSER", "root");
	define("BA_DBPASSWORD", "");
	define("BA_DBNAME", "db_mms_automation");		
	define('BASE_URL', 'http://192.168.0.109/mms/');

	// DB connection 
	$con = mysqli_connect(BA_DBHOST,BA_DBUSER,BA_DBPASSWORD,BA_DBNAME);
	//Constants


} else {

	// define("BA_DBHOST", "Localhost");
	// define("BA_DBUSER", "isvirtwo_isvir14");
	// define("BA_DBPASSWORD", "IpE3.x5!tk-!");
	// define("BA_DBNAME", "isvirtwo_isvir2014");  

    // //Constants
	// define('BASE_URL', 'http://www.greenindiaecoproducts.com/');
	// define('BASE_ADMIN_URL', 'http://www.greenindiaecoproducts.com/admin');
	// define('ERROR_EMAIL_ADDRESSES', 'kavitharjn@gmail.com');
	// define("SUBDIR", "/");

} 

define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]."/");
define("SITE_DOCUMENT_ROOT", DOCUMENT_ROOT . SUBDIR );
define("HTTP_HOST", $_SERVER["HTTP_HOST"]);
define("REMOTE_ADDR", $_SERVER["REMOTE_ADDR"]);
define("SERVER_ADDR", $_SERVER["SERVER_ADDR"]);
define("SERVER_NAME", $_SERVER["SERVER_NAME"]);
define("REQUEST_URI", $_SERVER["REQUEST_URI"]);
define("SCRIPT_NAME", $_SERVER["SCRIPT_NAME"]);
define("PHP_SELF", $_SERVER["PHP_SELF"]);
define("PATH_ROOT", dirname(PHP_SELF)=='/'?'':dirname(PHP_SELF));
define("FILE_NAME", basename(PHP_SELF));
define("SITE_HTTP", BASE_URL);
define("SITE_HTTPS", BASE_URL);

// ADMIN
define("ADMIN_URL", BASE_URL.'aPanel');
define("ADMIN_ASSETS", BASE_URL.'assets');
define("ADMIN_CSS", BASE_URL.'assets/css');
define("ADMIN_JS", BASE_URL.'assets/js');
define("ADMIN_IMAGES", BASE_URL.'assets/images');
define("ADMIN_ICON", BASE_URL.'assets/icon');

define("SERVICE_IMGES", BASE_URL.'aPanel/uploads/');

define('PAGE_LIMIT',10);


$confval = ini_get("upload_max_filesize");
$confval = substr($confval,0,strlen($confval)-1);
$max_file_size = $confval * 1024 * 1024; 
	

define("FROM_EMAIL", "kavitharjn@greenindiaecoproducts.com");
define("TO_EMAIL", "kavitharjn@gmail.com");
define("SITE_EMAIL", "info@greenindiaecoproducts.com");

$GLOBALS['monthName'] = array('01'=>array('January',31),
	'02'=>array('February',28),
	'03'=>array('March',31),
	'04'=>array('April',30),
	'05'=>array('May',31),
	'06'=>array('June',30),
	'07'=>array('July',31),
	'08'=>array('August',31),
	'09'=>array('September',30),
	'10'=>array('October',31),
	'11'=>array('November',30),
	'12'=>array('December',31)
	);
?>