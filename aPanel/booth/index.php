<?php 
function main() {   ?>


<span class="loading" style="display:none;"></span>
<div class="container">
<div class="row" style="margin-top:40px;">
   <div class="col-md-2"></div>
   <div class="col-md-8">
      <div class="card">
         <div class="card-header">
            <br>
            <h4 style="text-align:center"> Upload Voter List </h4>
         </div>
         <div class="card-body">


            <form action="javascript:void(0)" id="formData" method="post" enctype="multipart/form-data">
                  <!-- <select style="width:50%;margin:auto;diplay:table;" name="added_by" class="form-control" required> -->
                  <!-- <option>Select</option> -->
                  <?php 
                  // $voter ="SELECT * FROM `".TBL_USERS."`"; 
                  // $result = dB::mExecuteSql($voter);
                  // if(count($result)>0) {
                  // 	foreach($result as $key=>$val) {
                  // 		echo '<option value="'.$val->id.'">'.$val->name.'</option>';
                  // }} 
               ?>
                  <!-- </select> -->
                  
                  <input type="number" name="ac_no" class="form-control boothNo" placeholder="Enter AC Number"/>    
                  <input type="number" name="booth_number" class="form-control boothNo" placeholder="Enter Booth Number" required/>										   
                  <input type="file"  name="fileToUpload" id="fileToUpload"  accept=".txt" required> 
                  <!-- <input type="hidden" name="act" value="voters_details_entry"> -->
                  <input type="submit" class="btn btn-primary mb-2" id="upload_button" value="Upload" name="submit">
                  
            </form> 


            <!-- <div id="ajaxResponce"></div> -->
         
            <div class="progress" style="height: 30px;display:none;">
               <div class="progress-bar"></div>
            </div>
            <div id="uploadStatus" style="text-align:center"></div>
            <div class="response_data" style="text-align:center;padding-top:20px;"></div>
         </div>
      </div>
   </div>
   <div class="col-md-2"></div>
</div>

<style>
    .boothNo { width: 50%; margin: auto;display: table;margin-top: 20px;}
    #formData{   padding-bottom: 30px;  }
	#formData h4 { text-align: center; margin-bottom:20px;} 
	#formData input[type="file"] {  text-align: center;  margin: auto;   display: table;margin-top:20px; margin-bottom:20px;}
	#formData #upload_button{  width: 50%; margin: auto;  display: table; }
 </style>
  <script>
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
                  // $('#uploadStatus').html('<p style="padding-top: 30px;">File has uploaded successfully!</p>');				
                   // $('#formData')[0].reset();
                   $(".response_data").html(data).fadeIn();                    
            }
        });
    });


  </script>

 <?php }include '../admin_template.php';?>