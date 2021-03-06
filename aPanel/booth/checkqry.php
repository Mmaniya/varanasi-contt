<?php  
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";

ini_set('max_execution_time', '0'); // for infinite time of execution 
$rawDataObj = new VotersRawData;
$voterNewqQry = "SELECT * FROM `".TBL_VOTERS_RAW_DATA."` WHERE raw_data != '' AND is_inserted ='Y' AND updated_date LIKE '2021-01-09%' ORDER BY `updated_date` DESC";
$rsDtls = dB::mExecuteSql($voterNewqQry);
foreach($rsDtls as $key => $value ){
    $voiter_id[] = $value->voter_id;
 
    $voters_dts = "SELECT * FROM `".TBL_VOTERS_DETAILS."` WHERE epic_no IN ('$value->voter_id') AND updated_at LIKE '2021-01-09%'";
    $rsssssDtls[] = dB::mExecuteSql($voters_dts);

}
$sdsd = "SELECT * FROM `".TBL_VOTERS_DETAILS."` WHERE  updated_at LIKE '2021-01-09%' ORDER BY `updated_at` DESC";
$sdsdsd = dB::mExecuteSql($sdsd);
print_r(count($sdsdsd));

?>