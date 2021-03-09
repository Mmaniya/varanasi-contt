<?php  function main() {   
  
  if($_POST['act']=='get_role_by_state') {
         ob_clean();
         $user_id = $_POST['user_id'];  
         $admin_role = $_SESSION['admin_role'];        
         $UserStateId =  $_SESSION['state_id'];
         $subQry = "where id in($UserStateId)"; 
        $orderBy = ' order by state_name asc';
         if($admin_role=='SA') {    $subQry='';   }
               $state ="SELECT * FROM `".TBL_STATE."` ".$subQry.$orderBy; 
         $rsState = dB::mExecuteSql($state);   
         if($admin_role=='SA') {   echo  '<option value="" selected disabled>Select State</option>';  }  
           if(count($rsState)>0) {
        foreach($rsState as $key => $value){   ?>            
            <option value="<?php echo $value->id ?>"><?php echo $value->state_name ?></option>        
        <?php } }
     
 exit();
 }
 
  if($_POST['act']=='get_role_by_district') {
     ob_clean(); 
     
     $admin_role = $_SESSION['admin_role'];    
     $state_id =  $_POST['state_id'];
     $userDistrictId = $_SESSION['district_id'];    
 
     $subQry = " and id in($userDistrictId)"; 
     $stateQry = 'where state_id='.$state_id;
     if($admin_role=='SA') {    $subQry='';   }
       $orderBy = ' order by district_name asc';
          $districtQry ="SELECT * FROM `".TBL_DISTRICT."` ".$stateQry.$subQry.$orderBy; 
          $rsDistrict = dB::mExecuteSql($districtQry);   
 
     if($admin_role=='SA') {   echo  '<option value="" selected disabled>Select District</option>';  }  
 
       if(count($rsDistrict)>0) {
          foreach($rsDistrict as $key => $value){   ?>            
             <option value="<?php echo $value->id ?>"><?php echo $value->district_name ?></option>        
    <?php } }
 
 exit();
 }  
 
 
 if($_POST['act']=='get_role_by_const') {
     ob_clean(); 
     
     $admin_role = $_SESSION['admin_role'];    
     $district_id =  $_POST['district_id'];
     $userConstId = $_SESSION['lg_const_id'];    
 
     $subQry = " and id in($userConstId)"; 
     $districtQry = 'where district_id='.$district_id;
     if($admin_role=='SA') {    $subQry='';   }
       $orderBy = ' order by lg_const_name asc';
         $constQry ="SELECT * FROM `".TBL_LG_CONSTITUENCY."` ".$districtQry.$subQry.$orderBy; 
          $rsLgConst = dB::mExecuteSql($constQry);   
 
     if($admin_role=='SA') {   echo  '<option value="" selected >Select Constituency</option>';  }  
 
       if(count($rsLgConst)>0) {
          foreach($rsLgConst as $key => $value){   ?>            
             <option value="<?php echo $value->id ?>"><?php echo $value->lg_const_name ?></option>        
    <?php } }
 
 exit();
 } 
 
 
 if($_POST['act']=='get_role_by_booth') {
     ob_clean(); 
     
     $admin_role = $_SESSION['admin_role'];    
     $lg_const_id =  $_POST['lg_const_id'];
     $userBoothId = $_SESSION['booth_id'];    
 
     $subQry = " and id in($userBoothId)"; 
     $boothSubQry = 'where lg_id='.$lg_const_id;
     if($admin_role=='SA' || $admin_role=='A') {    $subQry='';   }
       $orderBy = ' order by booth_no asc';
         echo    $boothQry ="SELECT * FROM `".TBL_BOOTH."` ".$boothSubQry.$subQry.$orderBy; 
          $rsBoothQry = dB::mExecuteSql($boothQry);   
 
       echo  '<option value="" selected disabled>Select Booth</option>';   
 
       if(count($rsBoothQry)>0) {
          foreach($rsBoothQry as $key => $value){   ?>            
             <option value="<?php echo $value->id ?>"><?php echo $value->booth_no.' - '.$value->booth_name; ?></option>        
    <?php } }
 
 exit();
 } 
     
     
     ?>
 
 
 
 <div class="row">
     <div class="col-md-12">
         <div class="card">
             <div class="card-body">
 
                 <form method="post" enctype="multipart/form-data" class="form-horizontal" name="test_details_form" id="test_details_form">
     
                     <div class="form-group row text-center">
                         <div class="col-lg-2 col-md-3 col-sm-6">
                         <label for="inputEmail3" class="col-form-label">Captcha</label>
                             <input  name="captch" id="captch" placeholder="Captch Code"  class="form-control"   type="text">  
                             <a href="https://electoralsearch.in/##resultArea" target="_blank" style="color:blue"> Get Captcha</a>
                         </div>
                         <!-- <div class="col-4">
                             <label for="inputEmail3" class="col-form-label">Select User</label>
                             <select name="users" class="form-control" id="usersDetails">
                                 <option value="">Select User</option>
                                     <?php 
                                         $users ="SELECT * FROM `".TBL_VOTERS_RAW_DATA."` group by added_by";
                                         $result = dB::mExecuteSql($users);
                                         if(count($result)>0) {
                                         foreach($result as $key=>$val) {
                                         $voter1 ="SELECT * FROM `".TBL_USERS."` where id=".$val->added_by;
                                         $Userresult = dB::sExecuteSql($voter1);
                                         echo '<option value="'.$Userresult->id.'">'.$Userresult->name.'</option>';
                                         
                                         }}
                                     ?> 
                             </select>
                         </div> -->
                   
                         <div class="col-2"> 
                             <label for="inputEmail3" class="col-form-label">Select State</label>
                             <div style="display:flex;">
                                 <select class="form-control"  onchange="getDistrictList(this.value)" id="select_state">   </select>
                                 <!-- <a href="javascript:void(0);" onclick="updatevotersrecords()" class="btn btn-info"><i class="fa fa-recycle" aria-hidden="true"></i></a> -->
                             </div>
                         </div>
 
                         <div class="col-2"> 
                             <label for="inputEmail3" class="col-form-label">Select District</label>
                             <div style="display:flex;">
                                 <select class="form-control"  onchange="getConstByDistrict(this.value)" id="select_district">   </select>                                 
                             </div>                                
                         </div> 
 
                         <div class="col-2"> 
                             <label for="inputEmail3" class="col-form-label">Select Constituency</label>
                             <div style="display:flex;">
                                 <select class="form-control"  onchange="getBoothByConst(this.value)" id="select_constituency">   </select>                                 
                             </div>                                
                         </div>   
 
                         <div class="col-2"> 
                             <label for="inputEmail3" class="col-form-label">Select Booth Number</label>
                             <div style="display:flex;">
                                 <select class="form-control" onchange="updatevotersrecords()" id="select_booth">
                                 </select>
                                 <!-- <a href="javascript:void(0);" onclick="updatevotersrecords()" class="btn btn-info"><i class="fa fa-recycle" aria-hidden="true"></i></a> -->
                             </div>
                                 <label><span class="votersCount"></span></label>
                         </div>
                         <!-- select all booth number -->
 
                         <!-- <div class="col-4">
                                 <label for="inputEmail3" class="col-form-label">Select Booth Number</label>
                                 <select class="form-control"  id="filterbyBoothno">
                                     <option value="">Select Booth Number</option>
                                         <?php 
                                             $users ="SELECT * FROM ".TBL_VOTERS_RAW_DATA." group by booth_number";
                                             $result = dB::mExecuteSql($users);
                                             if(count($result)>0) {
                                                 foreach($result as $key=>$val) {  
                                                     echo '<option value="'.$val->booth_number.'">'.$val->booth_number.'</option>'; 
                                                 }
                                             }
                                         ?> 
                                 </select>
                                 <label><span class="votersCount"></span></label>
                             </div> -->
 
                         <!-- select all booth number -->
 
 
                         
                     </div>
                     
 
                 <div class="form-group row">
                     <input type="hidden" value="0" id="loadmoredata">   
                     <table class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>No</th>
                                 <th>Voter Id</th>
                                 <!-- <th>Address</th> -->
                                 <th>Data</th>
                                 <th>Action</th>                              
                             </tr>
                         </thead>  
                         <tbody id="displayvoters"></tbody>   
                     </table>
                 </div>
 
                 <div class="form-group row text-center" id="loadmore" style="display:block;">
                     <a href="javascript:void(0);" class="btn btn-info" onclick="getmoreData()">Load more</a>
                 </div>
 
 
                 </form> 
             </div>
         </div>
     </div> 
 
 </div>  
 
 <div class="preloader" style="display:none;">
     <div id="loader"></div>
 </div>
 
 <input type="hidden" value="<?php echo $_SESSION['lg_const_id'] ?>" id="lg_const_id">
 <input type="hidden" value="<?php echo $_SESSION['district_id'] ?>" id="district_id">
 <input type="hidden" value="<?php echo $_SESSION['state_id'] ?>" id="state_id">
 <input type="hidden" value="<?php echo $_SESSION['booth_id'] ?>" id="booth_id">
 <input type="hidden" value="<?php echo $_SESSION['user_id'] ?>" id="usersDetails"> 
 
 <script> 
 $( document ).ready(function() {
     var boothid = $('#booth_id').val();
     getvoterbooth(boothid);
     getDistrictList($('#state_id').val());
     getConstByDistrict($('#district_id').val());
     getBoothByConst($('#lg_const_id').val());
     loadStateList();
 
 });
 </script>
 <?php }include '../admin_template.php';?>