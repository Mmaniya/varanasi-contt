<?php  define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php"; 

ini_set('max_execution_time', '0'); // for infinite time of execution 
ini_set("auto_detect_line_endings", true);

$part_no=314;
$ac_no=390;

//$allowed_letters=array("a","o","e","u","ñ","p","y","f");
$file = 'hindi_text.txt';
$lines=array();
$voterline=1;
$f=fopen($file,"r");
$addressCnt=1; $voters=0;
while(!feof($f)){
    $line=fgets($f);
	$lines[]=$line;

	  if( strpos( $line, 'आयु' ) !== false) {
	  $voters = $voters+3;
	}
	
	
  if( strpos( $line, 'मकान' ) !== false) {
	$addresses = explode('मकान',trim($line));
	if(count($addresses)>0) {
	//	$rawAddress[$voterline]=$addresses;
	//	$voterline++;
		foreach($addresses as $K=>$V) {
			
			if(!empty($V)&&($V!=''))  {
				$actualAddress = explode(':',$V);	
				$voterAddress = end($actualAddress);
				$addressArr[$addressCnt]=$voterAddress;
				//update address=$voterAddress  where part_no=314 and serial_no=addressCnt;
			//$param['updated_by'] = '901';
			$param['address'] = $voterAddress;
			 
			$where= array('part_no'=>$part_no,'slno_inpart'=>$addressCnt,'ac_no'=>$ac_no);	
			$result = Table::updateData(array('tableName' => TBL_VOTERS_DETAILS, 'fields' => $param, 'where' => $where, 'showSql' => 'Y'));  
			echo  $voterAddress; echo $addressCnt;
			 
				
				$addressCnt++;	
				}
			    
			}
		
			
		}
}
}

fclose($f);
echo '<pre>';
print_r($addressArr);
echo '</pre>';
exit();

?>