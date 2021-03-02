<?php  
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php"; ?>

 <html>
 <head>
  <title></title>
  

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="../assets/css/sweetalert2.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="../assets/css/custom.css" type="text/css"/>

	<script type="text/javascript" src="../assets/js/jquery.min.js"></script>

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="../assets/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../assets/js/sweetalert2.min.js"></script>
	<script type="text/javascript" src="../assets/js/sweet-alerts.init.js"></script>
	<script type="text/javascript" src="../assets/js/default.js"></script>	
</head>
	
 <body>
 <span class="loading" style="display:none;"></span>
 <div class="container">
    <div class="row" style="margin-top:40px;">
	<div class="col-md-2"></div>
      <div class="col-md-8">
	     <div class="card">
		   <div class="card-header">
  <h4 style="text-align:center"> Upload Voter List </h4>
  </div>
		    <div class="card-body">
			<form action="javascript:void(0)" id="formData" method="post" enctype="multipart/form-data">
			    <select style="width:50%;margin:auto;diplay:table;" name="added_by" class="form-control" required>
				<option>Select</option>
				<?php 
				$voter ="SELECT * FROM `".TBL_USERS."`"; 
				$result = dB::mExecuteSql($voter);
				if(count($result)>0) {
					foreach($result as $key=>$val) {
						echo '<option value="'.$val->id.'">'.$val->name.'</option>';
				}} 
			?>
				</select>
                
              <input type="number" name="ac_no" class="form-control boothNo" placeholder="Enter Lg Constituency Number"/>
			  <input type="number" name="booth_number" class="form-control boothNo" placeholder="Enter Booth Number"/>
				
							   
				<input type="file"  name="fileToUpload" id="fileToUpload"  accept=".txt" >
				<input type="hidden" name="act" value="voters_details_entry">
				<input type="submit" class="btn btn-primary mb-2" id="upload_button" value="Upload" name="submit">
			</form> 
			
					 
<!-- Progress bar -->

<div class="progress" style="height: 30px;display:none;">
    <div class="progress-bar"></div>
</div>
<div id="uploadStatus" style="text-align:center"></div>
<div class="response_data" style="text-align:center;padding-top:20px;"></div>
				 
      </div> </div></div>
	 <div class="col-md-2"></div>
   </div> 
    <style>
	    .boothNo { width: 50%; margin: auto;display: table;margin-top: 20px;}
	</style>

<script>

$(document).ready(function (e) {  

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


/*$("#formData").on('submit',(function(e) {
e.preventDefault();
$.ajax({
		url: "raw_voters_upload_ajax.php",
		type: "POST",
		data:  new FormData(this),
		contentType: false,
		cache: false,
		processData:false,
	 beforeSend : function(){   
		$('.loading').show();
        $(".response_data").html('Uploading').fadeIn();
	 },
   		
   success: function(data) {  
            $('#formData').trigger("reset");
            $('.loading').hide();    
            $(".response_data").html(data).fadeIn();     
      },
     error: function(e) 
      {  $('.loading').hide(); 	
        $(".response_data").html(e).fadeIn();
      }          
    });
 }));*/
});

 </script>
 
 <style>
    #formData{   padding-bottom: 30px;  }
	#formData h4 { text-align: center; margin-bottom:20px;} 
	#formData input[type="file"] {  text-align: center;  margin: auto;   display: table;margin-top:20px; margin-bottom:20px;}
	#formData #upload_button{  width: 50%; margin: auto;  display: table; }
 </style>
  
 </body>
 </html>