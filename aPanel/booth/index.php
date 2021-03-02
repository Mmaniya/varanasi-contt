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

            <div id="ajaxResponce"></div>
         
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
  

 <?php }include '../admin_template.php';?>