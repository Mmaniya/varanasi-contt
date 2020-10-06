<?php require ("../includes.php");  

if($_POST['action'] == service_categorys){   
    ob_clean(); 
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; 
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value
    

     ## Total number of records without filtering
     $param = 'SELECT *  FROM '.TBL_SERVICE_CATEGORIES.'';    
     $categorysList = dB::mExecuteSql($param); 
     $totalRecords = count($categorysList);
 
 
     ## Fetch records

     $qry = "SELECT * FROM ".TBL_SERVICE_CATEGORIES."";
 
     $getcategorys = dB::mExecuteSql($qry); 
     
     foreach ($getcategorys as $key =>$value){
        // <a href="javascript:void(0);" class="btn hor-grd btn-grd-info btn-mini waves-effect waves-light" onclick="viewCategory('.$value->id.')">View</a>
        $action='';
        $action .= '<div class="btn-group " role="group" data-toggle="tooltip" data-placement="top" title="" data-original-title=".btn-xlg">
        <a href="javascript:void(0);" class="btn btn-primary btn-mini waves-effect waves-light" onclick="editCategory('.$value->id.')" >Edit</a>';
        if($value->status == 'A'){
            $action .= '<a href="javascript:void(0);" class="btn btn-danger btn-mini waves-effect waves-light" onclick="statusCategory(\''.$value->id.'\',\'I\')">Change Inactive</a>';
        } else {
            $action .= '<a href="javascript:void(0);" class="btn btn-success btn-mini waves-effect waves-light" onclick="statusCategory(\''.$value->id.'\',\'A\')">Change Active</a>';
        }
        $action .= '</div>';
    if($value->status == 'A'){
    $status = '<div class="label-main"><label class="label label-success">Active</label></div>';
    }else {
        $status = '<div class="label-main"><label class="label label-danger">Inactive</label></div>';
    }
     $data[] = array(
         'row'                   =>$key+1,
         'id'                    =>$value->id, 
         'category_name'         =>$value->category_name,  
         'category_abbr'         =>$value->category_abbr,      
         'category_description'  =>$value->category_description,  
         'status'                =>$status,  
         'action'                =>$action,
         );
     }
 
     ## Response
     $response = array(
     // "draw" => intval($draw),
     "iTotalRecords" => $totalRecords,
     "iTotalDisplayRecords" => $totalRecordwithFilter,
     // "meeetingId" =>count($attendeesListArr),
     "aaData" => $data,
 
     );
 
     echo json_encode($response);
 
     exit();
 } 

if($_POST['action'] == service){   
    ob_clean(); 
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; 
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value
    

     ## Total number of records without filtering
     $param = 'SELECT *  FROM '.TBL_SERVICE.'';    
     $categorysList = dB::mExecuteSql($param); 
     $totalRecords = count($categorysList);
 
 
     ## Fetch records

     $qry = "SELECT * FROM ".TBL_SERVICE."";
 
     $getservices = dB::mExecuteSql($qry); 
     
     foreach ($getservices as $key =>$value){
        // <a href="javascript:void(0);" class="btn hor-grd btn-grd-info btn-mini waves-effect waves-light" onclick="viewCategory('.$value->id.')">View</a>
        $action='';
        $action .= '<div class="btn-group " role="group" data-toggle="tooltip" data-placement="top" title="" data-original-title=".btn-xlg">
        <a href="javascript:void(0);" class="btn btn-primary btn-mini waves-effect waves-light" onclick="editCategory('.$value->id.')" >Edit</a>';
        if($value->status == 'A'){
            $action .= '<a href="javascript:void(0);" class="btn btn-danger btn-mini waves-effect waves-light" onclick="statusCategory(\''.$value->id.'\',\'I\')">Change Inactive</a>';
        } else {
            $action .= '<a href="javascript:void(0);" class="btn btn-success btn-mini waves-effect waves-light" onclick="statusCategory(\''.$value->id.'\',\'A\')">Change Active</a>';
        }
        $action .= '</div>';
    if($value->status == 'A'){
    $status = '<div class="label-main"><label class="label label-success">Active</label></div>';
    }else {
        $status = '<div class="label-main"><label class="label label-danger">Inactive</label></div>';
    }
     $data[] = array(
         'row'                   =>$key+1,
         'id'                    =>$value->id, 
         'service_name'          =>$value->service_name,  
         'service_price'         =>$value->service_price,  
         'status'                =>$status,  
         'action'                =>$action,
         );
     }
 
     ## Response
     $response = array(
     // "draw" => intval($draw),
     "iTotalRecords" => $totalRecords,
     "iTotalDisplayRecords" => $totalRecordwithFilter,
     // "meeetingId" =>count($attendeesListArr),
     "aaData" => $data,
 
     );
 
     echo json_encode($response);
 
     exit();
 } ?>