<?php  
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";

 if($_POST['act']=='add_voters_details') {
	ob_clean(); 
    $param=array(); 

       $jsonString = $_POST['json_data'];
              
       $params = array('booth_id','ward_id','branch_id','pc_name','st_code','ps_lat_long_1_coordinate','gender','rln_name_v2','rln_name_v1','rln_name_v3','name_v1','epic_no','ac_name','name_v2','name_v3','ps_lat_long','pc_no','last_update','id','dist_no','ps_no','ps_name','ps_name_v1','st_name','dist_name','rln_type','pc_name_v1','part_name_v1','ac_name_v1','part_no','dist_name_v1','ps_lat_long_0_coordinate','_version_','name','section_no','ac_no','slno_inpart','rln_name','age','part_name');
    
       $myJSON = json_decode($jsonString);
       $response = $myJSON->response;

       for($i =0; $i< count($response->docs); $i++){
       $result = $response->docs[$i];
             
       foreach($params as $field)  {
       $param[$field]= $result->$field;
       }
      
        $param['name'] =  ucwords(strtolower(str_replace("","-", $result->name))); 
        $param['rln_name'] = ucwords(strtolower(str_replace("","-", $result->rln_name))); 
        $param['booth_id'] = $_POST['booth_id'];	
        $param['branch_id'] = $_POST['branch_id'];	
        $param['ward_id']= $_POST['ward_id'];	

    if(empty($_POST['id'])){

        $query = Table::insertData(array('tableName' => TBL_VOTERS_LIST, 'fields' => $param, 'showSql' => 'N'));
        echo 'Records Added Successfully';

    }else {
       $where= array('id'=>$_POST['id']);	
       $result = Table::updateData(array('tableName' => TBL_VOTERS_LIST, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
       echo 'Records Updated Successfully';
    }
       }
    exit();

 }

 if($_POST['act'] =='add_edit_voters') {
    ob_clean();    
        $voters = Voters::getVotersDetails($_POST['id']);
    ?>

    <input type="hidden" value="add_voters_details" name="act" id="act" />
    <input type="hidden" value="<?php echo $_POST['id'] ?>" name="id" />

    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 col-form-label">Captch</label>
        <div class="col-sm-8">
            <input  name="captch" id="captch" placeholder="Captch Code"  class="form-control"  value="<?php echo $voters->serial_no; ?>" type="text">  
            <a href="https://electoralsearch.in/##resultArea" target="_blank"> Get Captch</a>
        </div>
    </div>

    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 col-form-label">Voter Id</label>
        <div class="col-sm-8">
            <input  name="voterid" placeholder="Voter id"  class="form-control"  minlength="10" value="<?php echo $voters->voterid; ?>" id="voterid" type="text">                    
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 col-form-label">Json Data</label>
        <div class="col-sm-8">
            <textarea name="json_data" class="form-control" id="json_data" value="" rows="11"></textarea>
        </div>
    </div>

    <div class="form-group">
        <input type="submit" id="submitBtn" class="btn btn-success float-right" value="Submit">
    </div>
    <br>

<script>
   
    
    
window.addEventListener("message", function(ev) {
    if (ev.data.message === "deliverResult") {
        alert("result: " + ev.data.result);
        ev.source.close();
    }
});
    
    
function GoURL(url) {
     var child = window.open(url, "_blank", "height=400,width=400");
        child.focus();
    
   
    var leftDomain = false;
    var interval = setInterval(function() {
        try {
            //if (child.document.domain === document.domain) 
        if(1)    {
                if (leftDomain && child.document.readyState === "complete") {
                    // we're here when the child window returned to our domain
                    
                    alert("returned: " + child.document.URL);
                    child.postMessage({ message: "requestResult" }, "*");
                } 
            }
            else {
                // this code should never be reached, 
                // as the x-site security check throws
                // but just in case
                leftDomain = true;
               // child.close();
            }
        }
        catch(e) {
            // we're here when the child window has been navigated away or closed
            if (child.closed) {
                clearInterval(interval);
                alert("closed");
                return; 
            }
           // alert('exe'+e.message);
            // navigated to another domain  
            leftDomain = true;
        }
    }, 500);
}

    $(document).ready(function(){ 

        
        
        $("#voterid").blur(function(){
          
            var captch = $('#captch').val();
            var voterid = $('#voterid').val();
            GoURL('https://electoralsearch.in/Home/searchVoter?epic_no='+voterid+'&page_no=1&results_per_page=10&reureureired=ca3ac2c8-4676-48eb-9129-4cdce3adf6ea&search_type=epic&state=S22&txtCaptcha='+captch); 
        });
        

        $("#voterid").bind('keyup', function (e) {
            if (e.which >= 97 && e.which <= 122) {
                var newKey = e.which - 32;
                e.keyCode = newKey;
                e.charCode = newKey;
            }
            $("#voterid").val(($("#voterid").val()).toUpperCase());
        });


        $("#h_f_name").keypress(function(){
            // alert('dd');
        });
    });
    </script>

    <?php exit();
 }

 if($_POST['act'] =='delete_voters') {
    ob_clean(); 
    echo $resultData = Voters::deleteVotersDetails($_POST['id']);
    exit();
 }

 if($_POST['act'] == 'get_branch_details'){
    ob_clean();  ?>
        <div class="form-group row text-center">
            <label for="inputEmail3" class="col-sm-4 col-form-label">Select Branch</label>
            <div class="col-sm-4 justify-content-md-center"> 
                <select class="form-control"  name="branch">
                <?php $branch = Voters::getbranchDetails($_POST['id']); 
                        foreach($branch as $branch=>$value){ ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->branch_name ?></option>
                        <?php   }
                    ?>            
                </select>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <input type="submit" class="btn btn-info" value="Next">
        </div>
    <?php
    exit();
 }

 if($_POST['act'] =='voterDetails') { 
    $result = Voters::getvoterDetails($_POST['voter_id']);?>

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="color:orange"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> VOTER DETAILS (<?php echo $result->slno_inpart ?>)</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-3">Voter ID:</label>
                <div class="col-sm-9">
                    <h5><?php echo str_replace('-','',ucwords($result->epic_no)) ?></h5>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-3">Name:</label>
                <div class="col-sm-9">
                    <h5><?php echo str_replace('-','',ucwords($result->name)); ?> - <?php echo str_replace('-','',$result->name_v1)?></h5>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-3">Gender:</label>
                <div class="col-sm-3">
                    <h5><?php if($result->gender == 'M') { echo 'Male'; } if($result->gender == 'F') { echo 'Female'; } ?></h5>
                </div>
                <label for="staticEmail" class="col-sm-3">Age:</label>
                <div class="col-sm-3">
                    <h5><?php echo $result->age; ?></h5>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <!-- <label for="staticEmail" class="col-sm-3">Relative's Name:</label> -->
                <label  class="col-sm-3"><?php if($result->rln_type == 'F') { ?> Father Name: <?php } else if($result->rln_type == 'M') { ?> Mother name : <?php } else if($result->rln_type == 'H') { ?> Husband name : <?php } else if($result->rln_type == 'W') { ?> Wife name : <?php } else if($result->rln_type == 'O') { ?> Others name : <?php } ?></label>
                <div class="col-sm-9">
                    <h5><?php echo str_replace('-','',ucwords($result->rln_name)); ?> - <?php echo str_replace('-','',$result->rln_name_v1)?></h5>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-3">Polling Station:</label>
                <div class="col-sm-9">
                    <h5><?php echo str_replace('-','',ucwords($result->ps_name)); ?></h5>
                </div>
            </div>

      </div>
   </div>

 <?php } 

 if($_POST['act'] == 'voterReligion'){

    $param['religion'] = $_POST['religion'];	
    if(!empty($_POST['id'])){

        $where= array('id'=>$_POST['id']);	
        $query = Table::updateData(array('tableName' => TBL_VOTERS_DETAILS, 'fields' => $param, 'where' => $where, 'showSql' => 'Y'));
        echo 'Records Updated Successfully';

    } 
 }

 if($_POST['act'] == 'addfamilyinfo'){
     
    $param['family_slno'] = $_POST['family_slno'];	
    if(!empty($_POST['id'])){

        $where= array('id'=>$_POST['id']);	
        $query = Table::updateData(array('tableName' => TBL_VOTERS_DETAILS, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        echo 'Records Updated Successfully';

    } 
 }
 
if($_POST['act'] == 'getallVotersList'){
    ob_clean();

    $searchValue ='';
    $limit = "limit ".$_POST['limit'].",20";

    $boothQry ='';
    $boothid = $_POST['booth_id'];
    if(!empty($_POST['booth_id'])){ { $boothQry= " and booth_id ='$boothid'"; } }

    $voters ="SELECT * FROM `".TBL_VOTERS_DETAILS."` WHERE `status`='A' ".$boothQry." AND `family_slno` = '0'  ORDER BY updated_at  ASC "; 
    $voters_list = dB::mExecuteSql($voters);

    // $voters = array('tableName' => TBL_VOTERS_DETAILS, 'fields' => array('*'), 'showSql' => 'N', 'orderby' => 'slno_inpart', 'sortby' => 'desc');
    // $voters_list = Table::getData($voters);

    if ($_POST['page'] == '') $page = 1;
    else $page = $_POST['page'];
    $TotalCount = count($voters_list);
    $totalPages = ceil(($TotalCount) / (PAGE_LIMIT));
    if ($totalPages == 0) $totalPages = PAGE_LIMIT;
    $StartIndex = ($page - 1) * PAGE_LIMIT;
    if (count($voters_list) > 0) $ListingParentCatListArr = array_slice($voters_list, $StartIndex, PAGE_LIMIT, true);
    include 'family_table.php'; 

    exit();
}

if ($_POST['act'] == 'parentListpagination') {
    ob_clean();

    $boothid = $_POST['booth_id'];
    $boothQry= " and booth_id ='$boothid'";

    // $param = array('tableName' => TBL_VOTERS_DETAILS, 'fields' => array('*'),'showSql' => 'N', 'orderby' => 'id', 'sortby' => 'desc');
    // $district_list = Table::getData($param);

    $voters ="SELECT * FROM `".TBL_VOTERS_DETAILS."` WHERE `status`='A' ".$boothQry." AND `family_slno` = '0'  ORDER BY slno_inpart  DESC "; 
    $voters_list = dB::mExecuteSql($voters);

    if ($_POST['page'] == '') $page = 1;
    else $page = $_POST['page'];
    $TotalCount = count($voters_list);
    $totalPages = ceil(($TotalCount) / (PAGE_LIMIT));
    if ($totalPages == 0) $totalPages = PAGE_LIMIT;
    $StartIndex = ($page - 1) * PAGE_LIMIT;
    if (count($voters_list) > 0) $ListingParentCatListArr = array_slice($voters_list, $StartIndex, PAGE_LIMIT, true);
    include 'family_table.php';

    exit();
}

if($_POST['act'] == 'votersfamilydetailsupdate'){

    $getvoter = Votersdetails::getvotersByid($_POST['family_head']);

    $familymem = explode(',', $_POST['family_members']);

    $param['family_slno'] = $getvoter->slno_inpart;

    if(!empty($getvoter->id)){
        $where= array('id'=> $getvoter->id);	
        $query = Table::updateData(array('tableName' => TBL_VOTERS_DETAILS, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        echo 'Records Updated Successfully';
    }
    foreach($familymem as $value){
        if(!empty($value)){
            $where= array('id'=>$value);	
            $query = Table::updateData(array('tableName' => TBL_VOTERS_DETAILS, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
            // echo 'Records Updated Successfully';            
        } 
    }

}

if($_POST['act'] == 'viewfamilyMembers'){
    ob_clean();

    $boothQry ='';
    $boothid = $_POST['booth_id'];
    if(!empty($_POST['booth_id'])){ { $boothQry= " and booth_id ='$boothid'"; } }

    $voters ="SELECT `family_slno`, COUNT( * ) as total_count,booth_id FROM `".TBL_VOTERS_DETAILS."` WHERE `status`='A' ".$boothQry." and family_slno!=0 group by `family_slno` HAVING COUNT(*)>=2  ORDER BY updated_at  DESC" ; 
    $voters_list = dB::mExecuteSql($voters);

    if ($_POST['page'] == '') $page = 1;
    else $page = $_POST['page'];
    $TotalCount = count($voters_list);
    $totalPages = ceil(($TotalCount) / (PAGE_LIMIT));
    if ($totalPages == 0) $totalPages = PAGE_LIMIT;
    $StartIndex = ($page - 1) * PAGE_LIMIT;
    if (count($voters_list) > 0) $ListingParentCatListArr = array_slice($voters_list, $StartIndex, PAGE_LIMIT, true);
    include 'family_members_table.php'; 

    exit();
}
