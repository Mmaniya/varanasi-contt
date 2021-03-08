<?php  
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";

ini_set('max_execution_time', '0'); // for infinite time of execution 


ini_set("auto_detect_line_endings", true);

 function getBetween($content, $start, $end) {
    $n = explode($start, $content);
    $result = Array();
    foreach ($n as $val) {
        $pos = strpos($val, $end);
        if ($pos !== false) {
            $result[] = substr($val, 0, $pos);
        }
    }
    return $result;
}


    // if($_POST['booth_number'] == '' && $_POST['booth_id'] !=''){
    //     $getBooth = Votersdetails::getBooth($_POST['booth_id']);
    //         $booth_number = $getBooth->booth_no;
    //        
    // }else{
    //     $booth_id = 0;
    //     $booth_number = $_POST['booth_number'];
    // }
    // $ac_no = $_POST['ac_no'];
    $state_id = $_POST['state_id'];
    $dist_id = $_POST['dist_id'];
    $conts_id = $_POST['conts_id'];

    if($_POST['booth_id'] != ''){
        $booth_id = $_POST['booth_id'];
    }else{
        $param['lg_id'] = $_POST['conts_id'];
        $param['booth_no'] = $_POST['booth_no'];
        $param['booth_name'] = $_POST['booth_name'];
        $param['booth_tname'] = $_POST['booth_tname'];
        $param['ps_no'] = $_POST['booth_no'];
        $param['ps_name'] = $_POST['ps_name'];
        $param['ps_tname'] = $_POST['ps_tname'];
        $getBooth = VotersRawData::addNewBooth($param);        
        $booth_id = $getBooth;
    }



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

$searchfor = '/[INB|DDR|DNV|JVZ]{3}\d{7}|[[UP\/52\/241\/]{10}\d{7}/';
//$fileContents = htmlspecialchars(nl2br(file_get_contents($file)));
//$lineArr = explode('<br>',$fileContents);
//echo '<pre>', htmlspecialchars(file_get_contents($file)), '</pre>';

$f = fopen($file, "r");
$lineArr = array();
$lineNum=0;$cnt=0;
$addressArr=array();
while(!feof($f)){
    $line = fgets($f);

   $contents = mb_convert_encoding($line, "HTML-ENTITIES", "UTF-8");
  // $contents=$line;
   	$matches=array();
    if(preg_match_all($searchfor, $contents, $matches, PREG_SET_ORDER, 0)){
       // $voterIds[]=$matches;
      foreach($matches as $match) {
        $voters[]=$match[0]; 
       
      }
      
     if(count($voters)>0) {
       $voterIds[$cnt]['voters']=$voters;
       $totalVoters = $totalVoters+count($voters);
        $voterIds[$cnt]['votersCnt'] = $totalVoters;
        $voters=array();$cnt++;
       if(count($addressArr)>0) {
           $addressArr=array();
        }
      }
   }
   
if($booth_number=='259')  { $address1 = (getBetween($contents, "roo", "Photo"));
                          
                           if(count($address1)>0) {
                               $address=array();
foreach($address1 as $K=>$V)
echo $address[] = end(explode(' ', $V));
                               echo '<pre>';
                               print_r($address);
                               echo '</pre>';
                         }
                          }
    else
   $address = (getBetween($contents, ":", "Photo"));
   if(count($address)>0) {// $addressArr[]=$address;
   $voterIds[$cnt-1]['address']=$address;
    $totalAddress = $totalAddress+count($address);
   }
     
   $lineNum++;
   // if($lineNum>2500) break;
 }

// echo '<pre>';
// print_r($voterIds);
// echo '</pre>';
 


  $totalVotersArr = array();
foreach($voterIds as $K=>$V) {
    foreach($V['voters'] as $K1=>$V1) { 
          $totalVotersArr[$V1]=$V1;
        
    }
} 



$insertedCount = 0;	
$updatedCount = 0;	
$totalRecords =0;


 foreach($voterIds as $K=>$V) {
    if(!empty($V['voters'])){ 
        foreach($V['voters'] as $K1=>$V1) 
         $votersArr[]=$V1.':::'.input_string($V['address'][$K1]);
    }
 }
       
 foreach($votersArr as $K=>$V) {
    $voterDetails = explode(':::',$V);
     
    $voterId=$voterDetails[0];
 
    if(count($voterDetails)>1)
      $address=$voterDetails[1];
     
    $voter ="SELECT * FROM `".TBL_VOTERS_RAW_DATA."` WHERE voter_id ='$voterId'"; 
    ob_flush();
    flush();
    $result = dB::sExecuteSql($voter);
    
    if($result->id==''){ 
			// $param['ac_no']= $ac_no;
            $param['state_id']= $state_id;
			$param['dist_id']= $dist_id;
			$param['conts_id']= $conts_id;
            $param['booth_id']= $booth_id;
			// $param['booth_number']= $booth_number;
			$param['voter_id']= $voterId;
			// $param['address']=input_string($address);
			$param['added_by']= $_POST['added_by'];
			//echo $V1.'--'.trim($V['address'][$K1]);    exit();
			$query = Table::insertData(array('tableName' => TBL_VOTERS_RAW_DATA, 'fields' => $param, 'showSql' => 'N')); 
			$insertedCount++;       
        }else {
            //if($address!='') {
				$param=array();	
			    // $param['ac_no']= $ac_no;
                $param['state_id']= $state_id;
                $param['dist_id']= $dist_id;
                $param['conts_id']= $conts_id;
                $param['booth_id']= $booth_id;
                // $param['booth_number']= $booth_number;				
				// $param['address']=input_string($address);
				$where= array('voter_id'=>$voterId);	
				$result = Table::updateData(array('tableName' => TBL_VOTERS_RAW_DATA, 'fields' => $param, 'where' => $where, 'showSql' => 'N')); 
				$updatedCount++;
		//	}			
        }
   	$totalRecords++;
   }
        $return = array('result'=>'success','total' => count($totalRecords), 'inserted' => $insertedCount, 'updated' => $updatedCount, 'state_id' => $state_id, 'dist_id' => $dist_id, 'const_id'=>$conts_id, 'booth_id'=>$booth_id);
        echo json_encode($return);
//    echo 'Total Records Found : '.count($totalRecords).' <br/> Total Records Inserted: '.$insertedCount.'<br/> Total Records Updated: '.$updatedCount;
	 
		
/*
      foreach($voterDtls as $key => $value){ 
          $voter ="SELECT * FROM `".TBL_VOTERS_RAW_DATA."` WHERE voter_id ='$value'"; 
          $result = dB::mExecuteSql($voter);
          if(empty(count($result))){   	                
                $param['voter_id']= $value;
                $param['added_by']= $_POST['added_by'];
                $query = Table::insertData(array('tableName' => TBL_VOTERS_RAW_DATA, 'fields' => $param, 'showSql' => 'N'));
           $cnt++; }    
       }

( 
	   echo 'Total Records Found : '.count($voterIds).' <br/> Total Records Inserted: '.$cnt;
    
    }
     else  { 
       echo "No matches found";
    }*/
        

    ?>