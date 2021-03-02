


<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";

$boothNo= array(1=>1382,46=>891,47=>816,48=>808,49=>781,50=>1158,51=>736,52=>725,53=>1282,54=>1232,55=>952,56=>714,57=>757,58=>1054);
$cBoothNo=$_GET['BNo'];
$totalCnt = $boothNo[$cBoothNo];
$boothRs ="SELECT * FROM `".TBL_VOTERS_LIST."` WHERE part_no=".$cBoothNo; 
$result = dB::mExecuteSql($boothRs);
$totalBCnt = count($result);

if($totalBCnt!=$totalCnt) {
for($i=1;$i<=$totalCnt;$i++) {
$boothRs ="SELECT slno_inpart FROM `".TBL_VOTERS_LIST."` WHERE slno_inpart =".$i." and part_no=".$cBoothNo; 
$result = dB::sExecuteSql($boothRs);
if($result->slno_inpart>0) { }
else $missingSL[]=$i;

}
echo '<pre>';
print_r($missingSL);
echo '</pre>';
exit();
} else
echo 'total Count: '.$totalBCnt.' - actual cnt: '.$totalCnt;
exit();
?>
