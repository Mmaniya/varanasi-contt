<?php  require "includes.php";

$rawDataObj = new VotersRawData;
$action = $_POST['act'];

if($action == 'getpartiesForm'){ 
    
    $query ="SELECT * FROM `".TBL_PARTY."` WHERE `id`=".$_POST['party_id'] .""; 
    $prlst = dB::sExecuteSql($query);
    ?> 

    <form action="javascript:void(0);" method="post" id="parties_form">
        <input type="hidden" value="<?php echo $prlst->id ?>" name="id">
        <input type="hidden" value="add_edit_party" name="act">
        <div class="card border-primary rounded-0">
            <div class="card-header p-0">
                <div class="bg-info text-white text-center py-2">
                    <h3> Add New Political Parties </h3>
                    <p class="m-0"></p>
                </div>
            </div>
            <div class="card-body p-3">

                <!--Body-->
                <div class="form-group">
                    <div class="input-group mb-2">                            
                
                        <select name="st_code" class="form-control statesList" required>
                        </select>   

                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group mb-2">                           
                        <input type="text" class="form-control" value="<?php echo $prlst->partie_name ?>" id="add_party_name" name="partie_name" placeholder="Partie Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-2">                           
                        <input type="text" class="form-control" value="<?php echo $prlst->partie_abbr ?>" id="add_party_abbr" name="partie_abbr" placeholder="Abbreviations" >
                    </div>
                </div>
            
                <div class="text-center">
                    <input type="submit" value="submit" class="btn btn-info btn-block rounded-0 py-2">
                </div>
            </div>

        </div>
    </form>

    <script>
            $("#parties_form").submit(function(e) {
            var form = $("form#parties_form").serialize(); 
            param = {'act':'getpartiesForm'}
            ajax({
                a:"parties_ajax",
                b:form,
                c:function(){},
                d:function(data){
                    getForm();
                    getallstate('');
                }
            });

        });

    </script>

<?php } 

if($action == 'getallState'){ 
    $stcode = $_POST['st_code'];
    ?>

    <option value="" selected disabled> Select State </option> 
    <option value='NP' <?php if($stcode == 'NP') { ?> selected <?php } ?>> National party </option>
    <?php 
    $getState = $rawDataObj->get_state_dts();

    foreach($getState as $key => $value){  if($value->st_code != '') { ?>
            <option value="<?php echo $value->st_code ?>" <?php if($stcode == $value->st_code) { ?> selected <?php } ?> ><?php echo $value->state_name ?></option>
    <?php } }

}

if($action == 'add_edit_party'){

    $param['partie_name'] = $_POST['partie_name'];
    $param['partie_abbr'] = $_POST['partie_abbr'];	
    $param['st_code'] = $_POST['st_code'];	
	
    if(!empty($_POST['id'])){

        $where= array('id'=>$_POST['id']);	
        $query = Table::updateData(array('tableName' => TBL_PARTY, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        echo 'Records Updated Successfully';

    }  else{

        $query = Table::insertData(array('tableName' => TBL_PARTY, 'fields' => $param, 'showSql' => 'N')); 
        $rsRecords = explode('::',$query);
        $districtId =  $rsRecords[2];
    }
}

if($action == 'deleteparties'){

    if(!empty($_POST['party_id'])){

        $where= array('id'=>$_POST['party_id']);	
        $query = Table::deleteData(array('tableName' => TBL_PARTY, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    }

}

if($action == 'getPartyTable'){

    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; 

    if(!empty($_POST['searchByState'])){
        $searchByState = $_POST['searchByState'];
    }
    if($searchValue != ''){
            $searchQuery .= " and (partie_name like '%".$searchValue."%' or party_abbr like '%".$searchValue."%') ";
        }

    $query ="SELECT count(*) AS total FROM `".TBL_PARTY."` WHERE `status`='A'"; 
    $rsTotal = dB::sExecuteSql($query);	
    $totalRecords = $rsTotal->total;
    
    $query ="select count(*) as allcount from ".TBL_PARTY." WHERE `st_code`='$searchByState'" . $searchQuery ; 
    $records = dB::sExecuteSql($query);	
    $totalRecordwithFilter = $records->allcount;
    
    $query ="SELECT * FROM ".TBL_PARTY." WHERE `st_code`= '".$searchByState ."'".$searchQuery." ORDER BY id  DESC limit ".$row.",".$rowperpage.""; 
    $result = dB::mExecuteSql($query);

    foreach ($result as $key =>$value){
        $action = "<a href='javascript:void(0)'  onclick='view_party_details(\"".$value->id."\",\"".$value->st_code."\")'>View</a> &nbsp;<a href='javascript:void(0)'  onclick='delete_party(".$value->id.")' >Delete</a>";
        $data[] = array(
            $value->st_code,  
            $value->partie_name,  
            $value->partie_abbr,  
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

} ?>