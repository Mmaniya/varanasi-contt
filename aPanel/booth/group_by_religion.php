<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/custom.css" type="text/css"/>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.1/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script type="text/javascript" src="../assets/js/jquery.min.js"></script>

<script type="text/javascript" src="../assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../assets/js/default.js"></script>	


<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php"; ?>
<!-- <div class="container"> -->
<br>


            <?php $booth_no = Voters::getsingleBoothDetails($_REQUEST['booth']); ?>
            <?php //$branch = Voters::getsinglebranchDetails($_POST['branch']); ?>
            <input type="hidden" value="<?php echo $booth_no->id; ?>" name="booth_id" id="get_booth" />
            <input type="hidden" value="<?php echo $booth_no->ward_id; ?>" name="ward_id" />
            <!-- <input type="hidden" value="<?php echo $branch->id; ?>" name="branch_id" id="get_branch"  />            -->

            <div class="row">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id='membersTable' class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Relation Name</th>
                                            <th>Age</th>
                                            <th>Sl.No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>     
                                </table>
                            </div>
                        </div>
                    </div> 
                </div>           
            </div>  
    <div class="preloader" style="display:none;">
        <div id="loader"></div>
    </div>


<script type="text/javascript">
$(document).ready(function(){

    gettableData();   
    // getUpdatedrecords();     
});


function gettableData(){
    $("#membersTable").DataTable().destroy()
    var dataTable = $('#membersTable').DataTable({
    'processing': true,
    'serverSide': true,
    'responsive': true,
    'serverMethod': 'post',
    'ajax': {
            'url':' voters_groupby_religion.php',
            'data': function(data){
                    data.searchByBranch = $('#get_booth').val();
            }
        }

    });
}


function updatereligion(val,id){
    param = {'act':'voterReligion','religion':val,'id':id }
    ajax({
        a: "add_voters",
        b: param,
        c: function() {},
        d: function(data) {                             
            $('.preloader').hide();  
           // gettableData();
            //$('#updateddata').html(data); 
        }
    }); 
}

// function saveRelation(val,id){

//     paramModel = {'act':'voterReligion','family_slno':val,'id':id }
//     ajax({
//         a:"add_voters",
//         b:paramModel,
//         c:function(){},
//         d:function(data){
//            // gettableData();
//            getUpdatedrecords();
//             //$('#modelshow').html(data);
//         }
//     });
// }

// function getUpdatedrecords(){
//     var booth_id = $('#get_booth').val();
//     param = { 'act': 'viewfamilyMembers', 'booth_id': booth_id }
//     ajax({
//         a: "add_voters",
//         b: param,
//         c: function() {},
//         d: function(data) {                             
//             $('.preloader').hide();  
//             $('#updateddata').html(data); 
//         }
//     }); 
// }


</script>