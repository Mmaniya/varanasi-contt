
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="../assets/css/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../assets/css/custom.css" type="text/css"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css"/>

<script type="text/javascript" src="../assets/js/jquery.min.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript" src="../assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../assets/js/default.js"></script>	


<div id="layoutSidenav_content">
   <div class="container-fluid">
      <h2 class="mt-3">Voters Details</h2>
      <ol class="breadcrumb mb-3">
      <a href="javascript:void(0);" class="breadcrumb-item">Home</a>
         <a href="javascript:void(0);" class="breadcrumb-item active">Voters Details</a>
      </ol>
      <div class="row">
         <div class="col-md-12">
            <div class="card mb-4">
               <div class="card-header">
                   TOTAL VOTERS 

               <!-- <span class="float-right mytextcolor" >TOTAL ACTIVE MEMBERS :  -->
               <?php
                 //$param = array('tableName' => TBL_BJP_MEMBER, 'fields' => array('*'),'condition'  =>array('status'=> 'A-CHAR'), 'showSql' => 'N', 'orderby' => 'id', 'sortby' => 'desc');
                  //$member_list = Table::getData($param);
                  //echo $TotalCount = count($member_list);
                  ?>
                  <!-- </span> -->
               </div>
               <div class="card-body">  
               <!-- <label> Members Filter by Mandal</label> -->
                  <div class="row  col-sm-12">
                    <select id='searchByState' name="state_id" class="col-sm-3 form-control">
                      <option value='' disabled selected>--Select State--</option>
                     </select>   
                     <select id='searchByDistrict' name="district_id" class="offset-sm-1 col-sm-3 form-control">
                      <option value='' disabled selected>--Select District--</option>
                     </select>    
                     <select id='searchByConstituency' name="lg_const_id" class="offset-sm-1 col-sm-3 form-control">
                        <option value='' disabled selected>--Select Constituency--</option>
                     </select>
              
                     </div><br>
                     <!-- <div class="row  col-sm-12">
                     <select id='searchByWard' name="ward_id" class="col-sm-3 form-control">
                        <option value='' disabled selected>--Select Ward--</option>
                     </select>
                     <select id='searchByBooth' name="booth_id" class="offset-sm-1 col-sm-3 form-control">
                        <option value='' disabled selected>--Select Booth--</option>
                     </select> 
                     <select id='searchByBoothBranch' name="booth_branch_id" class="offset-sm-1 col-sm-3 form-control">
                        <option value='' disabled selected>--Select Booth Branch--</option>
                     </select>                                            
                  </div><br> -->
                  <hr>
                  <!-- <label> Members Filter by Categories</label> -->
                  <div class="row col-sm-12">
                     <!-- <select id='searchByVerifyed' name="is_verified" class="col-sm-3 form-control">
                        <option value=''>-- Verifyed Member --</option>
                        <option value='Y'>YES</option>
                        <option value='N'>NO</option>
                     </select> 
                     <select id='searchByGender' name="member_gender" class="offset-sm-1 col-sm-3 form-control">
                        <option value=''>-- Gender --</option>
                        <option value='M'>Male</option>
                        <option value='F'>Female</option>
                        <option value='O'>Others</option>
                     </select>
                     <select id='searchByAge' name="member_age" class="offset-sm-1 col-sm-3 form-control">
                        <option value=''>-- Member Age --</option>
                        <?php for ($x = 18; $x <= 100; $x++) { ?>
                           <option value='<?php echo $x ?>'><?php echo $x ?></option>
                        <?php } ?>                    
                     </select>        -->
                  </div><br>

                  <form action="javascript:void(0)" id="formUpadetAllMember" method="POST">
                  <input type="hidden" name="action" value="updateAllMember">
                  <table id='votersTable' class='display dataTable table table-striped table-bordered' style="width:100%">  
                     <thead>
                        <tr>
                           <th colspan='6' style="color:#ff9933">VOTERS TABLE
                              <!-- <a href="javascript:void(0);" data-toggle="modal" class="btn btn-warning btn-sm float-right" style="color:#FFF" data-target=".memberModel" onclick="createNewMember()"><i class="fa fa-plus"></i> ADD NEW MEMBER</a> -->
                           </th>
                        </tr>                     
                        <tr>
                           <th>AC Number</th>
                           <th>Part Number</th>
                           <th>Polling Station Name</th>
                           <th>Voter Id</th>
                           <th>Action</th>                        
                     </thead>
                  </table>
                     <!-- <a href="javascript:void(0);" id="updateAllMember" data-toggle="modal" data-target=".memberModel" class="col-sm-3 form-control btn btn-success">Update With Selected Member</a> -->
                  </form>
               </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal -->   
      <div class="modal fade memberModel" role="dialog">
         <div class="modal-dialog modal-lg">
            <span id="modelshow"></span>
         </div>
      </div>
   </div>
   <!-- End Model -->
</div>



<script>
$(document).ready(function() {

   param = {'act':'getallState'}
   ajax({
        a:"update_raw_voters_ajax",
        b:param,
        c:function(){},
        d:function(data){
            $('#searchByState').html(data);
            // getAllVotersTable();
        }
    }); 

      // param = {'act':'getallDistrict','state_id':''}
      // ajax({
      //    a:"update_raw_voters_ajax",
      //    b:param,
      //    c:function(){},
      //    d:function(data){
      //       $('#searchByDistrict').html(data);
      //       // getAllVotersTable();
      //    }
      // });

   

   function getAllVotersTable(){

      $("#votersTable").DataTable().destroy()
      var dataTable = $('#votersTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
         'ajax': {
            'url':'server_processing.php',
            'data': function(data){
               // Read values
               var distID       = $('#searchByDistrict').val();
               var conts        = $('#searchByConstituency').val();
               var gender       = $('#searchByGender').val();
               var status       = $('#searchByStatus').val();

               // Append to data
               data.action = 'dynamicSearch';
               data.searchBydistID = distID;
               data.searchByConstituency = conts;
               data.searchByGender = gender;
               data.searchByStatus = status;

            }
         },
         // 'order': [1, 'asc']    
      });
   }



$('#searchByState').change(function(){
     var state_id = $(this).val();
      param = {'act':'getallDistrict','state_id':state_id}
      ajax({
         a:"update_raw_voters_ajax",
         b:param,
         c:function(){},
         d:function(data){
            $('#searchByDistrict').html(data);
            // getAllVotersTable();
         }
      });
    //dataTable.draw();
  });

  $('#searchByDistrict').change(function(){
     var dist = $(this).val();
      var state_id =  $('#searchByDistrict').val();
      param = {'act':'getallConstituency','state_id':state_id, 'district_id':dist }
      // param = {'act':'getallConstituency','district_id':dist }
      ajax({
         a:"update_raw_voters_ajax",
         b:param,
         c:function(){},
         d:function(data){
            $('#searchByConstituency').html(data);
            // getAllVotersTable();
         }
      });
    //dataTable.draw();
  });


//   $('#updateAllMember').click(function() {
//    formData = $('form#formUpadetAllMember').serialize();
//       ajax({
//          a:"membermodel",
//          b:formData,
//          c:function(){},
//          d:function(data){
//             $('#modelshow').html(data);              
//          }          
//       });
//    });

});

function editMember(id){
    paramModel = {'action':'addEditMember','memberID':id}
    ajax({
        a:"membermodel",
        b:paramModel,
        c:function(){},
        d:function(data){
            $('#modelshow').html(data);
        }
    });    
}
function createNewMember(){
    var wardId = $('#wardId').val();
    paramModel = {'action':'addEditMember','ward':wardId}
    ajax({
        a:"membermodel",
        b:paramModel,
        c:function(){},
        d:function(data){
            $('#modelshow').html(data);
        }
    });   
}

function deleteMember(id){
   paramModel = {'action':'memberDelete','memberID':id}
    ajax({
        a:"membermodel",
        b:paramModel,
        c:function(){},
        d:function(data){
            $('#modelshow').html(data);
        }
    }); 
}

function restoreMember(id){
   paramModel = {'action':'memberRetore','memberID':id}
 ajax({
     a:"membermodel",
     b:paramModel,
     c:function(){},
     d:function(data){
         $('#modelshow').html(data);
     }
 }); 
}

function viewMember(id){
   paramModel = {'action':'memberDetailsView','memberID':id}
 ajax({
     a:"membermodel",
     b:paramModel,
     c:function(){},
     d:function(data){
         $('#modelshow').html(data);
     }
 }); 
}
</script>