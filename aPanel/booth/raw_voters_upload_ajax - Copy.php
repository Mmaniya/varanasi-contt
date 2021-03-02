<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
ini_set('max_execution_time', '0'); // for infinite time of execution 

 
    if ($_FILES['fileToUpload']['name'] != '') {
        $newFileName = '';
        $filename = basename($_FILES['fileToUpload']['name']);
        $file_tmp = $_FILES['fileToUpload']["tmp_name"];
        //$ext = pathinfo($filename, PATHINFO_EXTENSION);
       // $baseName = basename($filename, $ext);
       // $baseName =. $ext;
       // $newFileName = rand() . '.' . $ext;
       // $param['fileToUpload'] = $newFileName;
        move_uploaded_file($file_tmp = $_FILES['fileToUpload']["tmp_name"], "uploads/" . $filename) or die('image upload fail');
    }

	$file = 'uploads/'.$filename;
	$searchfor = '/[INB|DDR|JVZ]{3}\d{7}|[[UP\/52\/241\/]{10}\d{7}/';
	$contents = htmlspecialchars(file_get_contents($file));
   
    
    // echo '<pre>', htmlspecialchars(file_get_contents($file)), '</pre>';
    
     $cnt=0;
    if(preg_match_all($searchfor, $contents, $matches, PREG_SET_ORDER, 0)){          
       foreach($matches as $match) {
        $voterIds[$match[0]]=$match[0];    
       }
       foreach($voterIds as $K=>$V){
        $voterDtls[]=$V;
       }  
	  
        
      foreach($voterDtls as $key => $value){ 
        
            $voter ="SELECT * FROM `".TBL_VOTERS_RAW_DATA."` WHERE voter_id ='$value'"; 
            $result = dB::mExecuteSql($voter);
          if(empty(count($result))){   	                
                $param['voter_id']= $value;
                $param['added_by']= $_POST['added_by'];
                $query = Table::insertData(array('tableName' => TBL_VOTERS_RAW_DATA, 'fields' => $param, 'showSql' => 'N'));
           $cnt++; }    
       }
	   
	   echo 'Total Records Found : '.count($voterIds).' <br/> Total Records Inserted: '.$cnt;
    
    }
     else  { 
       echo "No matches found";
    }
        

    ?>