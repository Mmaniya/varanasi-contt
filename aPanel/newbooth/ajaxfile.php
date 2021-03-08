<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";

$voterObj = new Votersdetails;
$rawDataObj = new VotersRawData; 
$userObj = new Users; 
$action = $_POST['act'];


if($action == 'getallState'){ ?>

    <option value="" selected disabled>Select State</option> <?php 
    $getState = $rawDataObj->get_state_dts();
    foreach($getState as $key => $value){  if($value->st_code != '') { ?>
        
        <option value="<?php echo $value->id ?>" <?php if( $value->id == $_POST['state_id']){ echo 'selected'; } ?>  ><?php echo $value->state_name ?></option>
    
    <?php } }
}

  if($action == 'getallDistrict'){

    $rawDataObj->state_id = $_POST['state_id'];
    $getDist = $rawDataObj->get_dist_dts(); 
    $options = array();   count($getDist); ?>

    <option value="" selected disabled>Select District </option> <?php       
    foreach($getDist as $key => $value){  if($value->dist_no != '') { 
        ?>
    <option value="<?php echo $value->id ?>" <?php if( $value->id == $_POST['dist_id']){ echo 'selected'; } ?>><?php echo $value->district_name ?></option>
    <?php } }

}

if($action == 'getallConstituency'){ 

    $rawDataObj->district_id= $_POST['district_id'];    
    $getDist = $rawDataObj->get_conts_dts(); ?>
    <option value="" selected disabled>Select Constituency</option> <?php 
    foreach($getDist as $key => $value){  ?>
    <option value="<?php echo $value->id ?>" <?php if( $value->id == $_POST['const_id']){ echo 'selected'; } ?>><?php echo $value->lg_const_number ?> - <?php echo $value->lg_const_name ?></option>
    <?php } 

}

if($action == 'getbyallBooth'){
    ob_clean();    
       $rawDataObj->const_id= $_POST['const_id'];    
       $getBooth = $rawDataObj->get_booth_dts_by_lg(); ?>
           <option value="" selected disabled>Select Booth</option> <?php 
          foreach($getBooth as $K => $V) { ?>       
            <option value="<?php echo $V->id ?>" <?php if( $V->id == $_POST['booth_id']){ echo 'selected'; } ?>><?php echo $V->booth_no ?> - <?php echo $V->booth_name ?></option>
   <?php  } 	
   exit();  
}

if($action == 'voters_upload_form'){
    ob_clean(); 
  
    ?>
    <style>.divider{ margin-top:10px;margin-bottom:10px;}</style>
         <div class="card-header">
            <br>
            <h4 style="text-align:center"> UPLOAD BOOTH VOTERS</h4>
         </div>
         <div class="card-body">         
            <form action="javascript:void(0)" id="formData" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col">
                        <select id='searchByState' name="state_id" onchange="searchAllDist(this.value)" class="form-control" required></select>
                    </div>
                    <div class="col">
                        <select id='searchByDistrict' name="dist_id" onchange="searchAllConst(this.value)" class="form-control" required>
                            <option value='' disabled selected>Select District</option>
                        </select>
                    </div>
                    <div class="col">
                        <select id='searchByConstituency' name="conts_id" onchange="searchAllBooth(this.value)" class="form-control" required>
                            <option value='' disabled selected>Select Constituency</option>
                        </select>
                    </div>                    
                </div>

                <div class="divider"></div>

                <div class="form-row oldBooth">
                    <div class="col-md-4">
                        <select id='searchByBooth' name="booth_id" class="form-control">
                            <option value='' disabled selected>Select Booth</option>
                        </select>
                    </div>
                    <div class="col-md-4">                 
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="newBooth()"><h6>New Booth</h6></a>                           
                    </div>
                </div>

                <div class="divider"></div>

                <div class="form-row newBooth">

                    <div class="col-md-4">                 
                        <input type="number" name="booth_no" class="form-control" placeholder="Booth Number" />										              
                    </div>
                    <div class="col-md-4">                 
                        <input type="text"  name="booth_name" class="form-control" placeholder="Booth Name" />
                    </div>
                    <div class="col-md-4">                 
                        <input type="text"  name="booth_tname" class="form-control" placeholder="Booth Name (Language Name)" />
                    </div>               
                </div>
                <div class="divider"></div>

                <div class="form-row newBooth">
                    <div class="col-md-4">                 
                        <input type="text"  name="ps_name" class="form-control" placeholder="Polling Station Name" />
                    </div>
                    <div class="col-md-4">                 
                        <input type="text"  name="ps_tname" class="form-control" placeholder="Polling Station Nam (Language Name)" />
                    </div>  
                    <div class="col-md-4">                 
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="existingBooth()"><h6>Existing Booth</h6></a>                           
                    </div>
                </div>                
                    <input type="file"  name="fileToUpload" id="fileToUpload"  accept=".txt" required> 
                    <input type="submit" class="btn btn-primary mb-2" id="upload_button" value="Upload" name="submit">
            </form> 
                <div class="progress" style="height: 30px;display:none;">
                <div class="progress-bar"></div>
                </div>            
                <div id="uploadStatus" style="text-align:center"></div>
                <div class="response_data" style="text-align:center;padding-top:20px;"></div>
        </div>
        <script>  $('.newBooth').hide(); 
            $("#formData").on('submit', function(e){
                e.preventDefault(); $('.progress').show();
                $.ajax({
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = ((evt.loaded / evt.total) * 100);
                                $(".progress-bar").width(percentComplete + '%');
                                $(".progress-bar").html(percentComplete+'%');
                            }
                        }, false);
                        return xhr;
                    },
                    type: 'POST',
                    url: 'raw_voters_upload_ajax.php',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(data){ $('.loading').show();
                        $(".progress-bar").width('0%');
                        $(".response_data").html(data).fadeIn(); 					
                        $(".response_data").html('Processing Request Please Wait').fadeIn();	
                            
                    },
                    error:function(data){ $('.loading').hide();
                        $('#uploadStatus').html('');		
                        $(".response_data").html(data).fadeIn();     
                    },
                    success: function(data){    $('.loading').hide();          
                        var records = JSON.parse(data);
                        if(records['result'] == 'success'){
                            votersaddressupload(data); 
                        }           
                    }
                });
            });

        </script>
    
    <?php exit();
}

if($action == 'voters_upload_address_form'){
    ob_clean(); 
    $arr = json_decode($_POST['response']);    
    ?>
    <style>.divider{ margin-top:10px;margin-bottom:10px;}</style>
         <div class="card-header">
            <br>
            <?php if($arr->result == 'success'){ ?> 
                Total Inserted Booth : <?php echo $arr->inserted; ?><br>
                Total Updated Booth : <?php echo $arr->updated; ?>
            <?php } ?>
            <h4 style="text-align:center"> UPLOAD VOTERS ADDRESS</h4>     
         </div>
         <div class="card-body">         
            <form action="javascript:void(0)" id="formAddress" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col">
                        <select id='searchByState' name="state_id" onchange="searchAllDist(this.value)" class="form-control" required></select>
                    </div>
                    <div class="col">
                        <select id='searchByDistrict' name="dist_id" onchange="searchAllConst(this.value)" class="form-control" required>
                            <option value='' disabled selected>Select District</option>
                        </select>
                    </div>
                    <div class="col">
                        <select id='searchByConstituency' name="conts_id" onchange="searchAllBooth(this.value)" class="form-control" required>
                            <option value='' disabled selected>Select Constituency</option>
                        </select>
                    </div> 
                    <div class="col">
                        <select id='searchByBooth' name="booth_id" class="form-control">
                            <option value='' disabled selected>Select Booth</option>
                        </select>
                    </div>                   
                </div>     
                <br>              
                <input type="file"  name="fileToUpload" id="fileToUpload"  accept=".txt" required> 
                <input type="submit" class="btn btn-primary mb-2" id="upload_button" value="Upload" name="submit">

            </form> 
                <div class="progress" style="height: 30px;display:none;">
                <div class="progress-bar"></div>
                </div>            
                <div id="uploadStatus" style="text-align:center"></div>
                <div class="response_data" style="text-align:center;padding-top:20px;"></div>
        </div>
        <script>  
            $('.newBooth').hide(); 
            $("#formAddress").on('submit', function(e){
                e.preventDefault(); $('.progress').show();
                $.ajax({
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = ((evt.loaded / evt.total) * 100);
                                $(".progress-bar").width(percentComplete + '%');
                                $(".progress-bar").html(percentComplete+'%');
                            }
                        }, false);
                        return xhr;
                    },
                    type: 'POST',
                    url: 'address_update_ajax.php',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(data){ $('.loading').show();
                        $(".progress-bar").width('0%');
                        $(".response_data").html(data).fadeIn(); 					
                        $(".response_data").html('Processing Request Please Wait').fadeIn();	
                            
                    },
                    error:function(data){ $('.loading').hide();
                        $('#uploadStatus').html('');		
                        $(".response_data").html('Fail. Try again.!').fadeIn();     
                    },
                    success: function(data){    
                        $('.loading').hide();          
                        // var records = JSON.parse(data);
                        // if(records['result'] == 'success'){
                        //     //$(".response_data").html(data).fadeIn();  
                        //     votersaddressupload(); 
                        // }
                                 
                    }
                });
            });

        </script>
    
    <?php exit();
}