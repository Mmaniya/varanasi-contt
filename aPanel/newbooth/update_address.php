<?php
function main()
{ ?>


<span class="loading" style="display:none;"></span>

<div class="row">
   <div class="col-md-10 offset-md-1">
      <div class="card" id="uplode_form"></div>         
   </div>   
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
        //  votersepicupload();
        //  var val = '{"result":"success","total":1,"inserted":0,"updated":870,"state_id":"1","dist_id":"1","const_id":"1","booth_id":"1"}';
        var val = '{}';
         votersaddressupload(val);
      });
  </script>

 <?php
}
include '../admin_template.php'; ?>
