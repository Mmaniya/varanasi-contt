<?php  require "includes.php"; 

$voterObj = new Votersdetails;
$rawDataObj = new VotersRawData; 

$action = $_POST['act'];
/*****************************/
/*      ADMIN SIGNIN         */
/*****************************/

if ($action == 'signInAdmin') {
    ob_clean();
        $resultData = Admin::checkCredentials($_POST['phone'], $_POST['password']);
        SessionWrite('userdetails', $resultData[1]);
        echo json_encode($resultData);
    exit();
} ?>


<?php if($action == 'getallVoters'){   
  
    //  $voterObj->ward_id= '1';
    $voterObj->booth_id= $_POST['boothid'];
    $voterObj->branchid= $_POST['branchid'];
    $voterObj->limit= $_POST['limit'];
    $voterObj->search= $_POST['search'];
    $voterObj->filter_type= $_POST['filter_type'];
 
    $voterObj->getType= $_POST['getType'];
    $voterObj->filterBy= $_POST['filterBy'];

    $getAllvoters = $voterObj->getallvoters();
    if(count($getAllvoters) > 0 ){
    foreach($getAllvoters as $key => $value){ 
    $getMmeber = Votersdetails::getmemberDetails($value->epic_no);  ?>

    <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-3">
        <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">  
            <div id="voter-card-<?php echo $value->id;?>">   
                <div class="row">
                    <div class="col-5 col-md-5 col-lg-5 col-xl-5">
                        <span class="badge badge-warning" style="font-size: 1.1rem;"><?php echo getroll($value->slno_inpart); ?></span><?php if($value->is_verified == 'Y'){ ?> <img src="userassets/image/verified.png" width="20"> <?php } else if($value->is_verified == 'R'){ ?> <img src="userassets/image/rejected.png" width="30"> <?php } ?>
                    </div>
                    <!-- <div class="col-1 col-md-1 col-lg-1 col-xl-1">
                        <a href="javascript:void(0);" onclick="updateKeyVoters('<?php echo $value->id; ?>','<?php echo $value->key_voter; ?>')" class="update"><span class="fa fa-star" <?php if($value->key_voter == 'N'){ ?> style="color: gray;" <?php } ?> <?php if($value->key_voter == 'Y'){ ?> style="color: goldenrod;" <?php } ?>></span></a>
                    </div> -->
                    <div class="col-6 col-md-6 col-lg-6 col-xl-6 text-right">
                        <?php // if(!empty($getMmeber)){ 
                        if($value->is_member == 'Y' && $value->voter_category == 'A') { ?>                               
                            <img src="userassets/image/bjp.png" width="30"> 
                        <?php } ?>
                        <strong><?php echo $value->epic_no; ?></strong>
                    </div>
                </div>
                <hr>
                <div class="row">
                
                    <div class="col-9 col-md-9 col-lg-8 col-xl-9 ">

                        <div class="row mb-2">
                            <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                                Name: 
                            </div>
                            <div class="col-9 col-md-9 col-lg-9 col-xl-9">
                                <strong><span> <?php echo str_replace('-','',ucwords($value->name)); ?> </span></strong>
                                <p style="margin-bottom: 0;"><strong><span> <?php echo str_replace('-','',$value->name_v1) ?> </span></strong></p>
                            </div>
                        </div>
              
                      
                    </div>

                    <div class="col-2 col-md-3 col-lg-2 col-xl-2">
                        <?php if($value->is_verified == 'N'){ ?>
                            <a href="javascript:void(0);" class="badge badge-success"  title="verify voter" data-toggle="modal" data-target=".displayModel" onclick="verify_voters('<?php echo $value->id ?>')" ><i class="fa fa-check" aria-hidden="true"></i></a>
                            <a href="javascript:void(0);" class="badge badge-danger" title="cancel voter" data-toggle="modal" data-target=".displayModel" onclick="rejected_voters('<?php echo $value->id ?>')" ><i class="fa fa-times" aria-hidden="true"></i></a>
                        <?php } else if($value->is_verified == 'Y') { ?>
                            <a href="javascript:void(0);" class="badge badge-info" data-toggle="modal" data-target=".displayModel" onclick="voter_info('<?php echo $value->id ?>')" title="Voter Info">Info</a>
                            <a href="javascript:void(0);" class="badge badge-info" data-toggle="modal" data-target=".displayModel" onclick="voter_scheme('<?php echo $value->id ?>')" title="Scheme">Scheme</a>
                            <?php if($value->voter_category == 'A'){ ?>           
                                <a href="javascript:void(0);" class="badge badge-info" data-toggle="modal" data-target=".displayModel" onclick="voter_party('<?php echo $value->id ?>')" title="Party">Party</a>
                            <?php } ?>
                            <a href="javascript:void(0);" class="badge badge-danger" data-toggle="modal" data-target=".displayModel" onclick="rejected_voters('<?php echo $value->id ?>')" title="Reject">Reject</a>
                        <?php } else if($value->is_verified == 'R') { ?> 
                            <a href="javascript:void(0);" class="badge badge-success"  title="verify voter" data-toggle="modal" data-target=".displayModel" onclick="verify_voters('<?php echo $value->id ?>')" ><i class="fa fa-check" aria-hidden="true"></i></a>
                        <?php } ?> 
                    </div>


                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">

                        <div class="row mb-2">
                            <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                                <?php if($value->rln_type == 'F') { ?> Father Name: <?php } else if($value->rln_type == 'M') { ?> Mother name : <?php } else if($value->rln_type == 'H') { ?> Husband name : <?php } else if($value->rln_type == 'W') { ?> Wife name : <?php } else if($value->rln_type == 'O') { ?> Others name : <?php } ?>
                            </div>
                            <div class="col-9 col-md-9 col-lg-9 col-xl-9">
                                <span style="font-weight: 500;"><?php echo str_replace('-','', ucwords(strtolower(str_replace("","-", $value->rln_name)))) ?> </span>
                                <p style="margin-bottom: 0;"><span style="font-weight: 500;"><?php echo str_replace('-','', str_replace("","-", $value->rln_name_v1)) ?> </span></p>
                            </div>
                        </div>   

                        <div class="row mb-2">                           
                            <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                                Address:
                            </div>
                            <div class="col-9 col-md-9 col-lg-9 col-xl-9">
                                <span style="font-weight: 500;"> <?php echo $value->address ?></span>
                            </div>                                                    
                        </div>
                    

                        <div class="row mb-2 ">
                            <div class="col-2 col-md-2 col-lg-2 col-xl-2">
                                Age:  
                            </div>                         
                            <div class="col-2 col-md-2 col-lg-2 col-xl-2">
                                <span style="font-weight: 500;"><?php echo $value->age ?> </span>
                            </div>
                            <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                                Gender:
                            </div>
                            <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                                <span style="font-weight: 500;"> <?php  if($value->gender == 'F'){ ?> Female <?php } else if($value->gender == 'M'){?> Male <?php } else { ?> Others <?php } ?></span>
                            </div>                                                    
                        </div>

                        <div class="row mb-0">
                            <div class="col-4 col-md-4 col-lg-4 col-xl-4">
                                Booth No:
                            </div>
                            <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                                <span style="font-weight: 500;"> <?php echo $value->part_no; ?></span>
                            </div>
                        </div>


                        
                            
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


<?php } } else { echo 'No Records Found.!'; } } ?>

<?php if($action == 'getallVotersCount'){ 
    
    // conunt deatails

    // if($_POST['ward_id'] !='') {
    //     $wardQry = 'ward_id ='.$_POST['ward_id'];
    // }
    $branchQry ='';  $boothQry='';

    $subQry=array();
    if($_POST['branch_id']!='') {   
       $subQry[]= " branch_id =".$_POST['branch_id']."";  
     }

     if($_POST['booth_id']!='') {
        $subQry[] = " booth_id =".$_POST['booth_id']."";
     }

    if(count($subQry)>0) {
      $subQuery = " WHERE ".implode(' AND ',$subQry).""; 
    }
   $qry ="select id, count(*) as total,
    sum(case when gender = 'M' then 1 else 0 end) total_male,
    sum(case when gender = 'F' then 1 else 0 end) total_female,
    sum(case when gender = 'T' then 1 else 0 end) total_others,
    sum(case when religion = 'Hindu' then 1 else 0 end) total_hindu,
    sum(case when religion = 'Christian' then 1 else 0 end) total_christian,
    sum(case when religion = 'Muslim' then 1 else 0 end) total_muslim,
    sum(case when address != '' then 1 else 0 end) address,
    sum(case when is_verified = 'Y' then 1 else 0 end) total_verified,
    sum(case when is_bla = 'Y' then 1 else 0 end) total_bla,
    sum(case when is_bc = 'Y' then 1 else 0 end) total_bc
    from ".TBL_VOTERS_DETAILS.$subQuery; 
   
    $resultData =   dB::sExecuteSql($qry);  

    // members count
    $qry1 ="select id, count(*) total_member from ".TBL_MEMBER. $subQuery; 
    $rsltData1 =   dB::sExecuteSql($qry1); 

    // age count
    $qry2 ="select  count(*) as firstvoters from ".TBL_VOTERS_DETAILS." WHERE age BETWEEN '18' AND '22' AND ".implode(' AND ',$subQry).""; 
    $rsltData2 =   dB::sExecuteSql($qry2);

    $qry3 ="select  count(*) as secondvoters from ".TBL_VOTERS_DETAILS." WHERE age BETWEEN '23' AND '30' AND ".implode(' AND ',$subQry).""; 
    $rsltData3 =   dB::sExecuteSql($qry3);

    $qry4 ="select  count(*) as thirdvoters from ".TBL_VOTERS_DETAILS." WHERE age BETWEEN '31' AND '40' AND ".implode(' AND ',$subQry).""; 
    $rsltData4 =   dB::sExecuteSql($qry4);

    $qry5 ="select  count(*) as fourthvoters from ".TBL_VOTERS_DETAILS." WHERE age BETWEEN '41' AND '50' AND ".implode(' AND ',$subQry).""; 
    $rsltData5 =   dB::sExecuteSql($qry5);

    $qry6 ="select  count(*) as fifthvoters from ".TBL_VOTERS_DETAILS." WHERE age BETWEEN '50' AND '60' AND ".implode(' AND ',$subQry).""; 
    $rsltData6 =   dB::sExecuteSql($qry6);

    $qry7 ="select  count(*) as above_50 from ".TBL_VOTERS_DETAILS." WHERE age > 60 AND ".implode(' AND ',$subQry).""; 
    $rsltData7 =   dB::sExecuteSql($qry7);

    echo $resultData->total.'::'.$resultData->total_male.'::'.$resultData->total_female.'::'.$resultData->total_others.'::'.$resultData->total_verified.'::'.$resultData->total_hindu.'::'.$resultData->total_christian.'::'.$resultData->total_muslim.'::'.$rsltData1->total_member.'::'.$rsltData2->firstvoters.'::'.$rsltData3->secondvoters.'::'.$rsltData4->thirdvoters.'::'.$rsltData5->fourthvoters.'::'.$rsltData6->fifthvoters.'::'.$rsltData7->above_50.'::'.$resultData->address.'::'.$resultData->total_bla.'::'.$resultData->total_bc; 

} ?>

<?php if($action == 'voterVerification'){ 
    
        $getvoters = Votersdetails::getvotersByid($_POST['voter_id']); 

        $rawDataObj->st_id= $getvoters->state_id;
        $getState = $rawDataObj->get_state();

    ?>
   <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" style="color:orange"><?php echo str_replace('-','',ucwords($getvoters->name)); ?> (<?php echo getroll($getvoters->slno_inpart); ?>)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">    
            <form action="javascript:void(0);" method="post" id="voters_form">
                <input type="hidden" value="<?php echo $_POST['voter_id'] ?>" name="id" id="voterid">
                <input type="hidden" value="verifiedusers" name="act">
                <input type="hidden" value="Y" name="is_verified">
                <!-- <div class="radio-toolbar" > -->
                <div>
                    <input type="radio" name="voter_category" value="A" id="voter_a"  />                                   
                    <label  for="voter_a" >Karyakarta</label>
                    <br>
                    <input type="radio" name="voter_category" value="B" id="voter_b"  />                                   
                    <label  for="voter_b" >Supporter / Part Time Worker</label>
                    <br>
                    <input type="radio" name="voter_category" value="C" id="voter_c"  />                                   
                    <label  for="voter_c" >Mediator</label>
                    <br>
                    <input type="radio" name="voter_category" value="D" id="voter_d"  />                                   
                    <label  for="voter_d" >Opposition Party</label>
                </div>

                <div class="form-group row" id="parties" style="display:none">
                    <label for="staticEmail" class="col-md-8 col-lg-8 col-xl-8  col-form-label">Select Party</label>
                    <a href="add_parties.php" class="text-right" target="_blank">Add Party</a>
                    <div class="col-md-12 col-lg-12 col-xl-12" >
                        <select class="form-control" name="party_id">
                            <?php  $getparty = Votersdetails::getParty($getState->st_code);
                                foreach($getparty as $key=> $val){  ?>
                                <option value="<?php echo $val->id; ?>" ><?php echo $val->partie_name; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                    <br>
                    <div class="col text-center">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </div>
                
            </form>      
        </div>
    </div>
    <script>
        $('input[type=radio][name=voter_category]').change(function() {
            if (this.value == 'D') {
                $("#parties").css("display", "block");
            }else{                
                formparm = $("form#voters_form" ).serialize(); 
                var id = $('#voterid').val();
                $('.preloader').show();
                ajax({
                    a: "ajaxfile",
                    b: formparm,
                    c: function() {},
                    d: function(data) {
                        $('.preloader').hide();
                        $('.displayModel').modal('toggle');
                        voterReload(id);
                    }
                });

            }
        });

        $("form#voters_form" ).submit(function( event ) {
            var id = $('#voterid').val();
            formparm = $("form#voters_form" ).serialize();
                $('.preloader').show();
                ajax({
                a: "ajaxfile",
                b: formparm,
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    $('.displayModel').modal('toggle');
                    voterReload(id);
                }
            });
        });
    </script>
<?php } ?>

<?php if($action == 'verifiedusers') {

    if ($_POST['is_verified'] == 'Y'){
        $param['voter_category'] = $_POST['voter_category'];
        $param['is_verified'] = $_POST['is_verified'];
        if($param['voter_category'] == 'D')	{ $param['party_id'] = $_POST['party_id']; }	
        if($param['voter_category'] == 'A')	{ $param['is_member'] = 'Y'; }	
    }

    if ($_POST['is_verified'] == 'R'){
        $param['is_verified'] = $_POST['is_verified'];
    }

    if(!empty($_POST['id'])){

        $where= array('id'=>$_POST['id']);	
        $query = Table::updateData(array('tableName' => TBL_VOTERS_DETAILS, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        echo 'Records Added Successfully';

    } ?>

<?php } ?>

<?php if($action == 'voterRejected'){ 
        $getvoters = Votersdetails::getvotersByid($_POST['voter_id']);    ?>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><span class="badge badge-info"><?php echo str_replace('-','',ucwords($getvoters->name)); ?> (<?php echo getroll($getvoters->slno_inpart); ?>)</span></h5>
            &nbsp;
            <h5 class="modal-title"><span class="badge badge-info"><?php echo $getvoters->epic_no; ?>  </h5>                
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="javascript:void(0);" method="post" id="voter_rejected">
            <input type="hidden" value="<?php echo $_POST['voter_id'] ?>" name="id" id="voterid">
            <input type="hidden" value="verifiedusers" name="act">
                <!-- <div class="radio-toolbar" > -->
                <div>
                    <div class="col-12 mb-2"> Rejected This Voter </div>
                    <div class="col-6">
                        <input type="radio" name="is_verified" value="R" id="voter_y"  <?php// if($getvoters->is_verified == 'Y'){ ?> <?php //} ?> />                                   
                        <label  for="voter_y">Yes</label>
                    </div>
                    <div class="col-6">
                        <input type="radio" name="is_verified" value="N" id="voter_n"  <?php //($getvoters->is_verified == 'N'){ ?> <?php// } ?>/>                                   
                        <label  for="voter_n">No</label>
                    </div>
                </div>       
            </form>
        </div>
    </div>
    <script>
         $('input[type=radio][name=is_verified]').change(function() {
        // $("form#voter_rejected" ).submit(function( event ) {
            var id = $('#voterid').val();
            formparm = $("form#voter_rejected" ).serialize();
                $('.preloader').show();
                ajax({
                a: "ajaxfile",
                b: formparm,
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    $('.displayModel').modal('toggle');
                    voterReload(id);
                }
            });
        });
    </script>
<?php  } ?>

<?php if($action == 'voterRefresh'){
    ob_clean(); 
    $getvoter = Votersdetails::getsinglevoters($_POST['voter_id']);  
    $getMmeber = Votersdetails::getmemberDetails($getvoter->epic_no);
    ?>

    <div class="row">
        <div class="col-5 col-md-5 col-lg-5 col-xl-5">
            <span class="badge badge-warning" style="font-size: 1.1rem;"><?php echo getroll($getvoter->slno_inpart); ?></span><?php if($getvoter->is_verified == 'Y'){ ?> <img src="userassets/image/verified.png" width="20"> <?php } else if($getvoter->is_verified == 'R'){ ?> <img src="userassets/image/rejected.png" width="30"> <?php } ?>
        </div>
        <!-- <div class="col-1 col-md-1 col-lg-1 col-xl-1">
            <a href="javascript:void(0);" onclick="updateKeyVoters('<?php echo $getvoter->id; ?>','<?php echo $getvoter->key_voter; ?>')" class="update"><span class="fa fa-star" <?php if($getvoter->key_voter == 'N'){ ?> style="color: gray;" <?php } ?> <?php if($getvoter->key_voter == 'Y'){ ?> style="color: goldenrod;" <?php } ?>></span></a>
        </div> -->
        <div class="col-6 col-md-6 col-lg-6 col-xl-6 text-right">
            <?php if($getvoter->is_member == 'Y' && $getvoter->voter_category == 'A') { ?>                
                <img src="userassets/image/bjp.png" width="30"> 
            <?php } ?>
            <strong><?php echo $getvoter->epic_no; ?></strong>
        </div>

        </div>
        <hr>
     <div class="row">
        <div class="col-9 col-md-9 col-lg-8 col-xl-9 ">

            <div class="row mb-2">
                <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                    Name: 
                </div>
                <div class="col-9 col-md-9 col-lg-9 col-xl-9">
                    <strong><span> <?php echo str_replace('-','',ucwords($getvoter->name)); ?> </span></strong>
                    <p style="margin-bottom: 0;"><strong><span> <?php echo str_replace('-','',$getvoter->name_v1) ?> </span></strong></p>
                </div>
            </div>      
      
        </div>

        <div class="col-2 col-md-3 col-lg-2 col-xl-2">
            <?php if($getvoter->is_verified == 'N'){ ?>
                <a href="javascript:void(0);" class="badge badge-success"  title="verify voter" data-toggle="modal" data-target=".displayModel" onclick="verify_voters('<?php echo $getvoter->id ?>')" ><i class="fa fa-check" aria-hidden="true"></i></a>
                <a href="javascript:void(0);" class="badge badge-danger" title="cancel voter" data-toggle="modal" data-target=".displayModel" onclick="rejected_voters('<?php echo $getvoter->id ?>')" ><i class="fa fa-times" aria-hidden="true"></i></a>
            <?php } else if($getvoter->is_verified == 'Y') { ?>
                <a href="javascript:void(0);" class="badge badge-info" data-toggle="modal" data-target=".displayModel" onclick="voter_info('<?php echo $getvoter->id ?>')" title="Voter Info">Info</a>
                <a href="javascript:void(0);" class="badge badge-info" data-toggle="modal" data-target=".displayModel" onclick="voter_scheme('<?php echo $getvoter->id ?>')" title="Scheme">Scheme</a>
                <?php if($getvoter->voter_category == 'A'){ ?>           
                    <a href="javascript:void(0);" class="badge badge-info" data-toggle="modal" data-target=".displayModel" onclick="voter_party('<?php echo $getvoter->id ?>')" title="Party">Party</a>
                <?php } ?>
            <?php } else if($getvoter->is_verified == 'R') { ?> 
                <a href="javascript:void(0);" class="badge badge-success"  title="verify voter" data-toggle="modal" data-target=".displayModel" onclick="verify_voters('<?php echo $getvoter->id ?>')" ><i class="fa fa-check" aria-hidden="true"></i></a>
            <?php } ?> 
        </div>


        <div class="col-12 col-md-12 col-lg-12 col-xl-12"> 


            <div class="row mb-2">
                <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                    <?php if($getvoter->rln_type == 'F') { ?> Father Name: <?php } else if($getvoter->rln_type == 'M') { ?> Mother name : <?php } else if($getvoter->rln_type == 'H') { ?> Husband name : <?php } else if($getvoter->rln_type == 'W') { ?> Wife name : <?php } else if($getvoter->rln_type == 'O') { ?> Others name : <?php } ?>
                </div>
                <div class="col-9 col-md-9 col-lg-9 col-xl-9">
                    <span style="font-weight: 500;"><?php echo str_replace('-','', ucwords(strtolower(str_replace("","-", $getvoter->rln_name)))) ?> </span>
                    <p style="margin-bottom: 0;"><span style="font-weight: 500;"><?php echo str_replace('-','', str_replace("","-", $getvoter->rln_name_v1)) ?> </span></p>
                </div>
            </div>   

            <div class="row mb-2">                           
                <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                    Address:
                </div>
                <div class="col-9 col-md-9 col-lg-9 col-xl-9">
                    <span style="font-weight: 500;"> <?php echo $getvoter->address ?></span>
                </div>                                                    
            </div>

            <div class="row mb-2 ">
                <div class="col-2 col-md-2 col-lg-2 col-xl-2">
                    Age:  
                </div>                         
                <div class="col-2 col-md-2 col-lg-2 col-xl-2">
                    <span style="font-weight: 500;"><?php echo $getvoter->age ?> </span>
                </div>
                <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                    Gender:
                </div>
                <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                    <span style="font-weight: 500;"> <?php  if($getvoter->gender == 'F'){ ?> Female <?php } else if($getvoter->gender == 'M'){?> Male <?php } else { ?> Others <?php } ?></span>
                </div>                                                    
            </div>

            <div class="row mb-0">
                <div class="col-4 col-md-4 col-lg-4 col-xl-4">
                    Booth No:
                </div>
                <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                    <span style="font-weight: 500;"> <?php echo $getvoter->part_no; ?></span>
                </div>
            </div>

        </div>
    </div>

<?php exit(); } ?>

<?php if($action == 'voterInfo'){ 
        $getvoters = Votersdetails::getvotersByid($_POST['voter_id']); ?>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><span class="badge badge-info"><?php echo str_replace('-','',ucwords($getvoters->name)); ?> (<?php echo getroll($getvoters->slno_inpart); ?>)</span>
                <?php if((!empty($getvoters->phone_number)) || (!empty($getvoters->phone_number)) || (!empty($getvoters->ration_card_no)) || (!empty($getvoters->smartcard_number))) { ?>  <a herf="javascript:void(0)" class="text-left" onclick="enableEdit()"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <?php } ?>
            </h5>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="javascript:void(0);" method="post" id="voters_info">
            <input type="hidden" value="<?php echo $_POST['voter_id'] ?>" name="id" id="voterid">
            <input type="hidden" value="voter_information_data" name="act">
            <label for="voter-mbl">Mobile Number</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">+91</span>
                </div>
                <input type="tel" class="form-control readfile" id="voter-mbl" name="phone_number" <?php if(!empty($getvoters->phone_number)) { ?> readonly <?php } ?> value="<?php echo $getvoters->phone_number; ?>" placeholder="Enter Mobile Number">
            </div>

            <label for="voter-mbl">Aadhar Number</label>
            <div class="input-group mb-3">   
                <input type="text" class="form-control readfile" id="voter-aadhar" name="aadhar_number" <?php if(!empty($getvoters->aadhar_number)) { ?> readonly <?php } ?> value="<?php echo $getvoters->aadhar_number; ?>" placeholder="Enter Aadhar Number">
            </div>

            <label for="voter-mbl">Ration Card Number</label>
            <div class="input-group mb-3">           
                <input type="text" class="form-control readfile" id="voter-ration" name="ration_card_no" <?php if(!empty($getvoters->ration_card_no)) { ?> readonly <?php } ?> value="<?php echo $getvoters->ration_card_no; ?>" placeholder="Enter Ration Card">
            </div>

            <label for="voter-mbl">Smart Card Number</label>
            <div class="input-group mb-3">           
                <input type="text" class="form-control readfile" id="voter-smart" name="smartcard_number" <?php if(!empty($getvoters->smartcard_number)) { ?> readonly <?php } ?> value="<?php echo $getvoters->smartcard_number; ?>" placeholder="Smart Ration Card">
            </div>

            <div class="col text-center">
                <input type="submit" class="btn btn-success" value="Submit">
            </div>

            </form>
        </div>
    </div>
    <script>
        $("form#voters_info" ).submit(function( event ) {
            // var id = $('#voterid').val();
            formparm = $("form#voters_info" ).serialize();
                $('.preloader').show();
                ajax({
                a: "ajaxfile",
                b: formparm,
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    $('.displayModel').modal('toggle');
                    // voterReload(id);
                }
            });
        });
        function enableEdit(){
            $(".readfile").attr("readonly", false); 
        }
    </script>
<?php  } ?>

<?php if($action == 'voter_information_data') {

    $param['phone_number'] = $_POST['phone_number'];	
    $param['aadhar_number'] = $_POST['aadhar_number'];	
    $param['ration_card_no'] = $_POST['ration_card_no'];	
    $param['smartcard_number'] = $_POST['smartcard_number'];	

    if(!empty($_POST['id'])){

        $where= array('id'=>$_POST['id']);	
        $query = Table::updateData(array('tableName' => TBL_VOTERS_DETAILS, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        echo 'Records Added Successfully';

    } ?>
<?php } ?>

<?php if($action == 'voterParty'){ 
        $getvoters = Votersdetails::getvotersByid($_POST['voter_id']);    ?>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><span class="badge badge-info"><?php echo str_replace('-','',ucwords($getvoters->name)); ?> (<?php echo getroll($getvoters->slno_inpart); ?>)</span>
            </h5>            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="javascript:void(0);" method="post" id="voter_party">
            <input type="hidden" value="<?php echo $_POST['voter_id'] ?>" name="id" id="voterid">
            <input type="hidden" value="voter_party_data" name="act">

                <!-- <div class="radio-toolbar text-center" > -->
                <div>
                    <span>Is BLA</span>
                    <input type="radio" name="is_bla" value="Y" id="voter_bla_y"  <?php if($getvoters->is_bla == 'Y'){ ?> checked <?php } ?> />                                   
                    <label  for="voter_bla_y" >YES</label>

                    <input type="radio" name="is_bla" value="N" id="voter_bla_n"  <?php if($getvoters->is_bla == 'N'){ ?> checked <?php } ?>/>                                   
                    <label  for="voter_bla_n" >NO</label>
                </div>
                <br>
                <!-- <div class="radio-toolbar  text-center" > -->
                <div>
                    <span>Is BC &nbsp;</span>
                    <input type="radio" name="is_bc" value="Y" id="voter_bc_y"  <?php if($getvoters->is_bc == 'Y'){ ?> checked <?php } ?> />                                   
                    <label  for="voter_bc_y" >YES</label>

                    <input type="radio" name="is_bc" value="N" id="voter_bc_n" <?php if($getvoters->is_bc == 'N'){ ?> checked <?php } ?> />                                   
                    <label  for="voter_bc_n" >NO</label>
                </div>
            <br>
            <div class="col text-center">
                <input type="submit" class="btn btn-success" value="Submit">
            </div>

            </form>
        </div>
    </div>
    <script>
        $("form#voter_party" ).submit(function( event ) {
            // var id = $('#voterid').val();
            formparm = $("form#voter_party" ).serialize();
                $('.preloader').show();
                ajax({
                a: "ajaxfile",
                b: formparm,
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    $('.displayModel').modal('toggle');
                    // voterReload(id);
                }
            });
        });
    </script>
<?php  } ?>

<?php if($action == 'voter_party_data') {

    $param['is_bla'] = $_POST['is_bla'];	
    $param['is_bc'] = $_POST['is_bc'];	

    if(!empty($_POST['id'])){

        $where= array('id'=>$_POST['id']);	
        $query = Table::updateData(array('tableName' => TBL_VOTERS_DETAILS, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        echo 'Records Added Successfully';

    } ?>
<?php } ?>

<?php if($action == 'voterScheme'){ 
        $getvoters = Votersdetails::getvotersByid($_POST['voter_id']);    ?>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><span class="badge badge-info"><?php echo str_replace('-','',ucwords($getvoters->name)); ?> (<?php echo getroll($getvoters->slno_inpart); ?>)</span>
            </h5>            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="javascript:void(0);" method="post" id="voter_scheme">
            <input type="hidden" value="<?php echo $_POST['voter_id'] ?>" name="id" id="voterid">
            <input type="hidden" value="voter_scheme_data" name="act">

            <?php $getscheme = Votersdetails::getScheme($_POST['voter_id']);  ?>

            <div class="list-group checkbox-list-group" style="overflow:scroll; height:230px;">
                <?php   $votersscheme = explode(",",$getvoters->scheme_id);
                 foreach($getscheme as $key=>$value){
                    if (in_array($value->id, $votersscheme)) { $checked = 'checked'; } else { $checked = '';  } ?>
                    <div class="list-group-item">&nbsp;<label><input type="checkbox"<?php echo $checked; ?> name="schemeid[]" value="<?php echo $value->id ?>"><span class="list-group-item-text"><i class="fa fa-fw"></i><?php echo $value->scheme_name ?></span></label></div>
                
                <?php } ?>
            </div>
            <br>
            <div class="col text-center">
                <input type="submit" class="btn btn-success" value="Submit">
            </div>

            </form>
        </div>
    </div>
    <script>
        $("form#voter_scheme" ).submit(function( event ) {
            // var id = $('#voterid').val();
            formparm = $("form#voter_scheme" ).serialize();
                $('.preloader').show();
                ajax({
                a: "ajaxfile",
                b: formparm,
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    $('.displayModel').modal('toggle');
                    // voterReload(id);
                }
            });
        });
    </script>
<?php  } ?>

<?php if($action == 'voter_scheme_data') {
    	
    $param['scheme_id'] = implode(",", $_POST['schemeid']);
    if(!empty($_POST['id'])){

        $where= array('id'=>$_POST['id']);	
        $query = Table::updateData(array('tableName' => TBL_VOTERS_DETAILS, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        echo 'Records Added Successfully';

    } ?>
<?php } ?>

<?php if($action == 'updateKeyVoter'){


        if(!empty($_POST['id'])){
            $where= array('id'=>trim($_POST['id']));	
            if($_POST['data'] == 'Y'){

                $param['key_voter'] = 'N';
                $query = Table::updateData(array('tableName' => TBL_VOTERS_DETAILS, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
                echo '0';
            }elseif ($_POST['data'] == 'N'){

                $param['key_voter'] = 'Y';
                $query = Table::updateData(array('tableName' => TBL_VOTERS_DETAILS, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
                echo '1';
            }
        }
    }?>

<?php if($action == 'getallState'){ ?>

    <option value="" selected disabled>Select State</option> <?php 
    $getState = $rawDataObj->get_state_dts();

    foreach($getState as $key => $value){  if($value->st_code != '') {
    if($_POST['user'] == 'SA' && $value->id == '6'){ ?>        
        <option value="<?php echo $value->id ?>"  ><?php echo $value->state_name ?></option>
    <?php  }  
     if($_POST['user'] == 'A') { ?>        
        <option value="<?php echo $value->id ?>"  ><?php echo $value->state_name ?></option>
    <?php  }  ?>
    <?php } } 
}

if($action == 'getallDistrict'){

    $rawDataObj->state_id = $_POST['state_id'];
    $getDist = $rawDataObj->get_dist_dts(); 
    $options = array();   count($getDist); ?>

    <option value="" selected disabled>Select District </option> <?php       
    foreach($getDist as $key => $value){  if($value->dist_no != '') { 
        ?>
    <option value="<?php echo $value->id ?>" ><?php echo $value->district_name ?></option>
    <?php } }

}

if($action == 'getallConstituency'){ 

    $rawDataObj->district_id= $_POST['district_id'];    
    $getDist = $rawDataObj->get_conts_dts(); ?>
    <option value="" selected disabled>Select Constituency</option> <?php 
    foreach($getDist as $key => $value){  ?>
    <option value="<?php echo $value->id ?>"><?php echo $value->lg_const_number ?> - <?php echo $value->lg_const_name ?></option>
    <?php } 

}

if($action == 'getallBooth'){
    ob_clean();

        $rawDataObj->const_id= $_POST['const_id'];    
        $getBooth = $rawDataObj->get_booth_dts_by_lg(); ?>      
        <option value="" selected disabled>Select Booth</option>
        <?php foreach($getBooth as $K => $V) { ?>
        <option value="<?php echo $V->id ?>"><?php echo $V->booth_no ?> - <?php echo $V->booth_name ?></option>
        <?php } 

    exit();
} 

if($action == 'getallBoothBranch'){
    ob_clean();
        $rawDataObj->booth_id= $_POST['booth_id'];    
        $getBooth = $rawDataObj->get_booth_branch_dts();  ?>   
        <option value='' disabled selected>--Select Booth Branch--</option>              
        <?php foreach($getBooth as $K => $V) { ?>
        <option value="<?php echo $V->id ?>"><?php echo $V->branch_name ?></option>
        <?php } 
    exit();
}

if($action == 'getallBoothName'){
    ob_clean();

        $rawDataObj->booth_id= $_POST['booth_id'];    
        $getBooth = $rawDataObj->get_booth_name(); 
        echo $getBooth->booth_no .'-'. $getBooth->booth_name;

    exit();
}