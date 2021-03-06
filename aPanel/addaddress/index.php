<?php
function main()
{ ?>


<span class="loading" style="display:none;"></span>

<div class="row" style="margin-top:40px;">
   <div class="col-md-2"></div>
   <div class="col-md-8">
      <div class="card">
         <div class="card-header">
            <br>
            <h4 style="text-align:center"> Upload Booth Voter Address </h4>
         </div>
         <div class="card-body">


            <form action="javascript:void(0)" id="formData" method="post" enctype="multipart/form-data">
                <!-- <div class="form-group"> -->
                     <div class="row justify-content-center">
                        <div class="form-group col-sm-5">
                           <select id='searchByState' name="state_id" class="form-control" required>
                              <!-- <option value='' disabled selected>--Select State--</option> -->
                           </select>
                        </div>
                     </div>
                     <div class="row justify-content-center">
                        <div class="form-group col-sm-5">
                           <select id='searchByDistrict' name="dist_id" class="form-control" required>
                              <option value='' disabled selected>Select District</option>
                           </select>
                        </div>
                     </div>
                     <div class="row justify-content-center">
                        <div class="form-group col-sm-5">
                           <select id='searchByConstituency' name="conts_id" class="form-control" required>
                              <option value='' disabled selected>Select Constituency</option>
                           </select>
                        </div>
                     </div>
           
        
                  <span id="uploadFile">  

                     <div class="row justify-content-center" id="oldBooth">
                        <div class="form-group col-sm-4">
                           <select id='searchByBooth' name="booth_id" class="form-control">
                              <option value='' disabled selected>Select Booth</option>
                           </select>
                        </div>
                        <div class="form-group col-sm-3">
                        <a href="javascript:void(0);" onclick="newBooth();" class="form-control btn btn-primary"><i class="fa fa-plus"></i> New Booth </a>
                        </div>
                     </div>

                     <div class="row justify-content-center" id="newBooth">
                           <input type="number"  name="booth_number" class="form-control col-sm-4" style="height: 40px;" placeholder="Enter Booth Number" />										   
                           <div class="form-group col-sm-3">
                        <a href="javascript:void(0);" onclick="oldBooth();" class="form-control btn btn-primary"><i class="fa fa-times"></i> Existing Booth </a>
                        </div>
                     </div>
            
                     <input type="file"  name="fileToUpload" id="fileToUpload"  accept=".txt" required> 
                     <input type="submit" class="btn btn-primary mb-2" id="upload_button" value="Upload" name="submit">
                  </span>
            </form> 

         
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
  $(document).ready(function(){

  selectState();
   $('#uploadFile').hide();
  $('#searchByState').change(function(){
       var state_id = $(this).val();
       param = {'act':'getallDistrict','state_id':state_id}
       ajax({
           a:"ajaxfile",
           b:param,
           c:function(){},
           d:function(data){
               $('#searchByDistrict').html(data);            
           }
       });
   });
   
   $('#searchByDistrict').change(function(){
       var dist = $(this).val();
       var state_id =  $('#searchByDistrict').val();
       param = {'act':'getallConstituency','state_id':state_id, 'district_id':dist }
       ajax({
           a:"ajaxfile",
           b:param,
           c:function(){},
           d:function(data){
               $('#searchByConstituency').html(data);
           }
       });
   });
   
   $('#searchByConstituency').change(function(){
       var const_id = $(this).val();
       param = {'act':'getbyallBooth','const_id':const_id}
       ajax({
           a:"ajaxfile",
           b:param,
           c:function(){},
           d:function(data){
               $('#searchByBooth').html(data);
               $('#uploadFile').show();
           }
       });
   });

  });

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
                   $(".response_data").html(data).fadeIn();                    
            }
        });
    });


  </script>

 <?php
}
include '../admin_template.php'; ?>
