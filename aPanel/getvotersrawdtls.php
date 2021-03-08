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
        $subQry[] = "dist_id =".$_POST['searchByDistrict'];
    }
    if($_POST['searchByConstituency'] != ''){
        $subQry[] = "conts_id =".$_POST['searchByConstituency'];
    }
    if($_POST['searchByBooth'] != ''){
        $subQry[] = "booth_id =".$_POST['searchByBooth'];
    }
    if($searchValue != ''){
        $subQry[] = " voter_id like '%".$searchValue."%'";
    }

    if(count($subQry)>0) {
        $subQuery = " WHERE ".implode(' AND ',$subQry).""; 
    }   

    $query ="SELECT count(*) AS total FROM ".TBL_VOTERS_RAW_DATA. $subQuery; 
    $rsTotal = dB::sExecuteSql($query);	
    $totalRecords = $rsTotal->total;
    
    $query ="select count(*) as allcount from ".TBL_VOTERS_RAW_DATA. $subQuery; 
    $records = dB::sExecuteSql($query);	
    $totalRecordwithFilter = $records->allcount;
    
    $query ="SELECT * FROM ".TBL_VOTERS_RAW_DATA." $subQuery ORDER BY id  ASC limit ".$row.",".$rowperpage.""; 
    $result = dB::mExecuteSql($query);

    foreach ($result as $key =>$value){    
            // $value->raw_data, 
            // $json_model = '<button type="button" class="btn btn-primary waves-effect btn-sm" data-toggle="modal" data-target="#view-data'.$k.'">View</button>
            // <div class="modal fade" id="view-data'.$k.'" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
            //     <div class="modal-dialog modal-lg" role="document">
            //         <div class="modal-content">
            //             <div class="modal-header">
            //                 <h4 class="modal-title">JSON DATA</h4>
            //                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            //                 <i class="fa fa-times" aria-hidden="true"></i></button>
            //             </div>
            //             <div class="modal-body">                            
            //                 '.$json_pretty.'                            
            //             </div>                        
            //         </div>
            //     </div>
            // </div>',
        $rawData = '<a href="viewjsonfile.php?data= '.$value->voter_id.'" class="btn btn-primary waves-effect btn-sm" target="_blank">View</a>';

        if($value->is_inserted == 'Y'){
            $inserted = '<span style="color:green">YES</span>';
        }else if($value->is_inserted == 'N'){
            $inserted = '<span style="color:red">NO</span>';
        }

        $qry = "SELECT * FROM ".TBL_ADMIN_USER." WHERE id =".$value->added_by;   
        $rsUser = dB::sExecuteSql($qry); 

        $data[] = array(
            $k = $key+1,           
            $voter_id = '<span style="font-weight:bold;">'.$value->voter_id.'</span></span>',      
            $rawData,
            $inserted,  
            $rsUser->name,              
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