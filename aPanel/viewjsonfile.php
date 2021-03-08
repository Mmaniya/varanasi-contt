<?php
define('ABSPATH',  dirname(__DIR__, 1));
require ABSPATH . "/includes.php";
header('Content-Type: application/json');

$query ="SELECT * FROM ".TBL_VOTERS_RAW_DATA." WHERE voter_id = '".trim($_GET['data'])."'"; 
$result = dB::sExecuteSql($query);

$json_pretty = json_encode(json_decode($result->raw_data), JSON_PRETTY_PRINT);

var_dump($json_pretty);
