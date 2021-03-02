<?php  
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";

$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; 
$searchByBranch = $_POST['searchByBranch'];
    
if($searchValue != ''){
        $searchQuery .= " and (name like '%".$searchValue."%' or slno_inpart like '%".$searchValue."%' or rln_name like '%".$searchValue."%' ) ";
    }

    $query ="SELECT count(*) AS total FROM `".TBL_VOTERS_DETAILS."` WHERE `booth_id`= $searchByBranch  "; 
    $rsTotal = dB::sExecuteSql($query);	
    $totalRecords = $rsTotal->total;
    
    $query ="select count(*) as allcount from ".TBL_VOTERS_DETAILS." WHERE `booth_id`= $searchByBranch " . $searchQuery ; 
    $records = dB::sExecuteSql($query);	
    $totalRecordwithFilter = $records->allcount;
    
    // AND `family_slno` = '0'
    $query ="SELECT * FROM ".TBL_VOTERS_DETAILS." WHERE  `booth_id`= $searchByBranch  ".$searchQuery."  ORDER BY slno_inpart  DESC limit ".$row.",".$rowperpage.""; 
    $result = dB::mExecuteSql($query);

    foreach ($result as $key =>$value){
        // $action = '<a href="javascript:void(0)" data-toggle="modal" data-target=".memberModel" onclick="view_voter_details('.$value->vid.')" >View</a> &nbsp;<a href="javascript:void(0)"   onclick="delete_voter('.$value->vid.')" >Delete</a>';
        $username = '<span style="font-weight:bold;">'. str_replace('-','',ucwords($value->name)).'&nbsp <span style="color:'.$color.'">'.$value->gender.'</span></span>';        

        if($value->family_slno == '0'){
            $action = '<input type="text" id="'.$value->id .'" value="" onblur="saveRelation(this.value,this.id)"> ';
        }else{
            $action = '<input type="text" id="'.$value->id .'" value="'.$value->family_slno.'" onblur="saveRelation(this.value,this.id)"> ';
        }
        $data[] = array(
            $username = '<span style="font-weight:bold;">'. str_replace('-','',ucwords($value->name)).'<br>'.str_replace('-','',$value->name_v1).'</span>',
            $value->rln_type,  
            $relationname = '<span style="font-weight:bold;">'. str_replace('-','',ucwords($value->rln_name)).'<br>'.str_replace('-','',$value->rln_name_v1).'</span>',
            $value->age,  
            //$value->epic_no,
            getroll($value->slno_inpart),            
            $action,
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