<?php  
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php"; ?>

<?php if($_POST['act'] == 'addBooth'){ ?>
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

<? } ?>