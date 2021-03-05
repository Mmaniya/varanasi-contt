<?php  define('ABSPATH', dirname(__DIR__, 2));
   require ABSPATH . "/includes.php";
   
   $btnName = $title = 'Add New ';
   $user_id = $_POST['user_id'];
   $label = 'Add New ';
   if($_POST['user_id']>0) {
   $param = array('tableName'=>TBL_ADMIN_USER,'fields'=>array('*'),'condition'=>array('id'=>$user_id.'-INT'));
   $rsUser = Table::getData($param);
   foreach($rsUser as $K=>$V)  $$K=$V;
   $btnName = $title = 'Edit ';	
   $label = 'Edit ';
   }  
   ?>
<div class="modal fade" id="add_edit_user_popup" role="dialog">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title"><?php echo $label;?> User</h4>
            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
         </div>
         <div class="modal-body ">
            <form action="javascript:void(0);" id="add_users">
               <input type="hidden" value="add_edit_users" name="act">
               <input type="hidden" value="<?php echo $_POST['user_id']; ?>" name="id">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group"> 			 
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $name;?>">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group"> 			 
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo $phone;?>" required>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group"> 			 
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" autocomplete="off" value="<?php echo $email;?>" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <select name="user_type" id="user_type" onchange="selectUser(this.value)" class="form-control" required>
                           <option>Select</option>
                           <option value="A" <?php if($user_type=='A') { echo 'selected'; }?>>Admin</option>
                           <option value="DE" <?php if($user_type=='DE') { echo 'selected'; }?>>Data Entry</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group"> 			 
                        <input type="password" class="form-control" id="password" name="pass" placeholder="Password" autocomplete="off" value="<?php echo $password; ?>" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group"> 			 
                        <input type="password" class="form-control" id="cpassword" name="cpass" placeholder="Confirm Password" autocomplete="off" value="<?php echo $password; ?>" required>
                     </div>
                  </div>
               </div>
               <div class="add_booth_div">
                  <hr/>
                  <h5>Add Booth </h5>
                  <br>
                  <div class="form-group row">
                     <div class="col-sm-4">
                        <select id='searchByState' name="state_id" class="form-control" required>
                           <option value='' disabled selected>--Select State--</option>
                        </select>
                     </div>
                     <div class="col-sm-4">
                        <select id='searchByDistrict' name="district_id" class="form-control" required>
                           <option value='' disabled selected>--Select District--</option>
                        </select>
                        <span id="total_dist"></span>          
                     </div>
                     <div class="col-sm-4">
                        <select id='searchByConstituency' name="lg_const_id" class="form-control" required>
                           <option value='' disabled selected>--Select Constituency--</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row" id="selectBooth" style="display:none;">
                     <div class="col-sm-12">
                        <div  class="ui-front">
                           <input type="text"  id="search_text" class="form-control" placeholder="Type Booth No">
                           <input type="hidden" id="search_text_id"> 
                        </div>
                     </div>
                  </div>
               </div>
               <div class="boothList_div">
                  <ul style="line-height: 31px;">
                     <?php 
                        $qry ="select * from `".TBL_BOOTH."` where id in(".$booth_id.")"; 
                        $rsBooth = dB::mExecuteSql($qry); 
                            if(count($rsBooth)>0) {
                        foreach($rsBooth as $key=>$val) { 		
                        echo '<li calss="remove'.$val->id.'"> '.$val->booth_no.' - '.$val->booth_name.'  <input type="hidden" name="booth_id[]" value="'.$val->id.'"/> <a href="javascript:void(0)" style="color:red;" onclick="removeBooth('.$val->id.','.$user_id.')">Remove</a></li>';
                        }
                        }		 
                                ?>
                  </ul>
               </div>
               <style>
                  .boothList_div ul li{ 
                  border-bottom: 1px solid #ccc;
                  padding-bottom: 5px;
                  padding-top: 5px;
                  }
               </style>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" id="addUser">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<style>
   .booth_list_tag li { float:left;width: 80px;list-style-type: none;}
   ul.ui-autocomplete.ui-menu { z-index: 1000 !important;}
</style>
<script> 
$( document ).ready(function() {

        $("#addUser").prop('disabled', true);  
});
   var usertype = $('#getUserID').val();
   param = {'act':'getallState', 'user': usertype }
   ajax({
           a:"user-ajax",
           b:param,
           c:function(){},
           d:function(data){
               $('#searchByState').html(data);
           }
   });
   
   $('#search_text').autocomplete({ 
       source: function(request, response ) {
           $.ajax({
               url : 'search_results.php',
               dataType: "json",
               beforeSend: function() {
               $('#search_text_id').val('');
               },
               data: {
                   search_string: request.term,
                   type:'search_booth',
                   lg_const_id:$('#searchByConstituency').val(),
               },
                   success: function( data ) {
                       response( $.map( data, function( item ) {
                       /* return {
                           label: item,
                           value: item
                       } */
                       
                       var code = item.split("|");
                           return {  // textbox auto fill
                               label: code[1]+' - '+code[2],
                                   value: '',//textbox value
                               data : item
                           }
                   }));
                   }
           });
   
       },
   
       autoFocus: true,
       selectFirst: true,
       minLength: 0,
       focus : function( event, ui ) { //on focus change value
               var names = ui.item.data.split("|");	
       },
           
       select: function( event, ui ) {
               //$('#search_text').html(ui.item.value);
               var names = ui.item.data.split("|");	
                   if(names[0].trim()!=0) {
                   $('#search_text_id').val(names[0]);  
                   $('#search_text_id').val(names[0]);  						 
                   addBoothList(names[0],names[1],names[2]);
                   }
       },
       open: function() {
       $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
       },
       close: function() {
       $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
       }		      	
   });  
   
   function removeBooth(booth_id,id){
       param = {'act':'removeBooth', 'booth_id': booth_id, 'id':id }
       ajax({
           a:"user-ajax",
           b:param,
           c:function(){},
           d:function(data){
               $('.remove'+id).remove();
           }  
       });
   }
    
   function addBoothList(boothId,boothNo,address) {
   html = '';       
        html+='<li>'+boothNo+' - '+address+' <input type="hidden" name="booth_id[]" value="'+boothId+'"/></li>';       
   $('.boothList_div ul').append(html);
   
   }		
    			  
   $('#searchByState').change(function(){
       var state_id = $(this).val();
       param = {'act':'getallDistrict','state_id':state_id}
       ajax({
           a:"user-ajax",
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
           a:"user-ajax",
           b:param,
           c:function(){},
           d:function(data){
               $('#searchByConstituency').html(data);
           }
       });
   });
   
   $('#searchByConstituency').change(function(){
       var const_id = $(this).val();
       param = {'act':'getallBooth','const_id':const_id}
       ajax({
           a:"user-ajax",
           b:param,
           c:function(){},
           d:function(data){
               $('#searchByBooth').html(data);
           }
       });
   });
   
   $("form#add_users").submit(function() {
       var param = $('form#add_users').serialize();
       $('.preloader').show();
       $.ajax({
           url: 'user-ajax.php',
           type: 'POST',
           data: param,
           success: function(data) {
               $('.preloader').hide();
               $('#add_edit_user_popup').modal('toggle');
               if (data == 'Success') {             
                   notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft',
                       'animated fadeOutLeft', 'Records Updated!');
                   location.reload();
               } else {
                   notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft',
                       'animated fadeOutLeft',data);
               }
           }
       });
   });
   
</script>