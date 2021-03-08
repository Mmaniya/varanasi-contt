<?php 
define('ABSPATH',  dirname(__DIR__, 2));
require ABSPATH . "/includes.php";

ini_set('max_execution_time', '0'); // for infinite time of execution 
ini_set("auto_detect_line_endings", true);


// $part_no=314;
// $ac_no=390;
// $filePath='hindi_text.txt'; 
$state_id = $_POST['state_id'];
$dist_id = $_POST['dist_id'];
$conts_id = $_POST['conts_id'];
$booth_id = $_POST['booth_id'];

if ($_FILES['fileToUpload']['name'] != '') {
	$newFileName = '';
	$filename = basename($_FILES['fileToUpload']['name']);
	$file_tmp = $_FILES['fileToUpload']["tmp_name"];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	$baseName = basename($filename, $ext);
	// $baseName = . $ext;
	$newFileName = rand() . '.' . $ext;
   // $param['fileToUpload'] = $newFileName;
	move_uploaded_file($file_tmp = $_FILES['fileToUpload']["tmp_name"], "uploads/" . $newFileName) or die('image upload fail');
}

$file = 'uploads/'.$newFileName;

// $file = 'uploads/364766559.txt';
//$allowed_letters=array("a","o","e","u","ñ","p","y","f");
// $file = 'hindi_text.txt';
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
			$param['state_id'] =  $state_id;
			$param['district_id'] = $dist_id;
			$param['const_id'] = $conts_id;
			$param['booth_id'] = $booth_id;

			$param['address'] = input_string($voterAddress);
			$param['slno_inpart'] = $addressCnt;				
			
			$qry = array('tableName' => TBL_VOTERS_LIST, 'fields' => array('*'),'condition'=>array('state_id'=>$state_id.'-INT','district_id'=>$dist_id.'-INT','const_id'=>$conts_id.'-INT','booth_id'=>$booth_id.'-INT','slno_inpart'=>$addressCnt.'-INT'), 'showSql' => 'N');
			$result = Table::getData($qry);
			if(count($result)>0){

			$where= array('state_id'=>$state_id,'district_id'=>$dist_id,'const_id'=>$conts_id,'booth_id'=>$booth_id,'slno_inpart'=>$addressCnt);	
			$result = Table::updateData(array('tableName' => TBL_VOTERS_LIST, 'fields' => $param, 'where' => $where, 'showSql' => 'Y'));  

			}else{
				$query = Table::insertData(array('tableName' => TBL_VOTERS_LIST, 'fields' => $param, 'showSql' => 'N'));
			}
			
			// $where= array('state_id'=>$state_id,'dist_id'=>$dist_id,'conts_id'=>$conts_id,'booth_id'=>$booth_id);	
			// $result = Table::updateData(array('tableName' => TBL_VOTERS_RAW_DATA, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));  
			// echo  $voterAddress; 
			 				
				$addressCnt++;	
				}
			    
			}
		
			
		}
}
}

fclose($f); 
// print_r($addressArr);

exit();

?>