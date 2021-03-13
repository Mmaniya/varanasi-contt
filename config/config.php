<?

$dev_server = true;
define("LOCAL", true);
session_start();

if ($dev_server) {

    // Dev Database credentials
    define("BA_DBHOST", "localhost");
    define("BA_DBUSER", "root");
    define("BA_DBPASSWORD", "");
    define("BA_DBNAME", "covai_voters");
    define('BASE_URL', 'http://localhost/coimbatore/');

    // define("BA_DBHOST", "localhost");
    // define("BA_DBUSER", "masterm6_voterslist");
    // define("BA_DBPASSWORD", "C=LWj(SsCIl4");
    // define("BA_DBNAME", "masterm6_voterslist");
    // define('BASE_URL', 'http://mastermindsolutionsonline.com/varanasi/');

    // DB connection
    $con = mysqli_connect(BA_DBHOST, BA_DBUSER, BA_DBPASSWORD, BA_DBNAME);

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

define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"] . "/");
define("SITE_DOCUMENT_ROOT", DOCUMENT_ROOT . SUBDIR);
define("HTTP_HOST", $_SERVER["HTTP_HOST"]);
define("REMOTE_ADDR", $_SERVER["REMOTE_ADDR"]);
define("SERVER_ADDR", $_SERVER["SERVER_ADDR"]);
define("SERVER_NAME", $_SERVER["SERVER_NAME"]);
define("REQUEST_URI", $_SERVER["REQUEST_URI"]);
define("SCRIPT_NAME", $_SERVER["SCRIPT_NAME"]);
define("PHP_SELF", $_SERVER["PHP_SELF"]);
define("PATH_ROOT", dirname(PHP_SELF) == '/' ? '' : dirname(PHP_SELF));
define("FILE_NAME", basename(PHP_SELF));
define("SITE_HTTP", BASE_URL);
define("SITE_HTTPS", BASE_URL);

// ADMIN
define("ADMIN_URL", BASE_URL . 'aPanel');
define("ADMIN_ASSETS", BASE_URL . 'assets');
define("ADMIN_CSS", BASE_URL . 'assets/css');
define("ADMIN_JS", BASE_URL . 'assets/js');
define("ADMIN_IMAGES", BASE_URL . 'assets/images');
define("ADMIN_ICON", BASE_URL . 'assets/icon');

define("USERS_DIR", ADMIN_URL . '/users');
define("BOOTH_DIR", ADMIN_URL . '/newbooth');
define("ENTRY_DIR", ADMIN_URL . '/entry');

