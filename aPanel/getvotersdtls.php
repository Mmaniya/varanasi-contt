<?php  
define('ABSPATH',  dirname(__DIR__, 1));
require ABSPATH . "/includes.php";

    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; 
        
    $subQry = array();
    if($_POST['searchByState'] != ''){
        $subQry[] = "state_id =".$_POST['searchByState'];
    }
    if($_POST['searchByDistrict'] != ''){
        $subQry[] = "lg_const_id =".$_POST['searchByDistrict'];
    }
    if($_POST['searchByConstituency'] != ''){
        $subQry[] = "lg_const_id =".$_POST['searchByConstituency'];
    }
    if($_POST['searchByBooth'] != ''){
        $subQry[] = "booth_id =".$_POST['searchByBooth'];
    }
    if($searchValue != ''){
        $subQry[] = " name like '%".$searchValue."%' or slno_inpart like '%".$searchValue."%' or epic_no like '%".$searchValue."%'";
    }

    if(count($subQry)>0) {
        $subQuery = " WHERE ".implode(' AND ',$subQry).""; 
    }   

    $query ="SELECT count(*) AS total FROM ".TBL_VOTERS_DETAILS. $subQuery; 
    $rsTotal = dB::sExecuteSql($query);	
    $totalRecords = $rsTotal->total;
    
    $query ="select count(*) as allcount from ".TBL_VOTERS_DETAILS. $subQuery; 
    $records = dB::sExecuteSql($query);	
    $totalRecordwithFilter = $records->allcount;
    
    $query ="SELECT * FROM ".TBL_VOTERS_DETAILS." $subQuery ORDER BY slno_inpart  ASC limit ".$row.",".$rowperpage.""; 
    $result = dB::mExecuteSql($query);

    foreach ($result as $key =>$value){
        $username = '<span style="font-weight:bold;">'. str_replace('-','',ucwords($value->name)).'&nbsp <span style="color:'.$color.'">'.$value->gender.'</span></span>';        

 
        $data[] = array(
            $key+1,           
            $username = '<span style="font-weight:bold;">'. str_replace('-','',ucwords($value->name)).'<br>'.str_replace('-','',$value->name_v1).'</span>',
            $value->epic_no, 
            $value->age,  
            $value->gender,              
           // $action ='<span><a href="javascript:void(0);" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal'.$value->id.'"> View <i class="fa fa-eye"></i></a><div id="myModal'.$value->id.'" class="modal fade" role="dialog"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" style="right:20px;position:absolute" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true"><i class="fa fa-times"></i></span> </button></div> <div class="modal-body"> <p>Some text in the modal.</p> </div> <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div> </div> </div> </div></span>',
           );
    }

    $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data,
        );
        echo json_encode($response);
?>