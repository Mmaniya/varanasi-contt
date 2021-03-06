
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


<?php  
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";?>
<div class="container">
<br>

    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                <?php $booth_no = Voters::getsingleBoothDetails($_POST['booth']); ?>
                <h2 style="text-align: center;"> Booth No: <?php echo $booth_no->booth_no; ?></h2>

                <?php $branch = Voters::getsinglebranchDetails($_POST['branch']); ?>

                <h5 style="text-align: center;"><?php echo $branch->branch_name; ?>
                <a href="index.php" class="btn btn-warning">Change</a>
                </h5>

                <form method="post" enctype="multipart/form-data" class="form-horizontal" name="test_details_form" id="test_details_form">

                    <input type="hidden" value="<?php echo $booth_no->id; ?>" name="booth_id" />
                    <input type="hidden" value="<?php echo $booth_no->ward_id; ?>" name="ward_id" />
                    <input type="hidden" value="<?php echo $branch->id; ?>" name="branch_id" id="get_branch" />           

                    <fieldset  id="add_edit_card">

                    </fieldset>
           
                </form> 
                </div>
            </div>
        </div> 
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
            <table id='membersTable' class="table table-hover">
                <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Name</th>
                        <th>Voter Id</th>
                        <th>Action</th>
                    </tr>
                </thead>     
            </table>
            </div>
            </div> 
        </div>      
    </div>  

    <div class="preloader" style="display:none;">
        <div id="loader"></div>
    </div>

    <div class="modal fade memberModel" role="dialog">
        <div class="modal-dialog modal-md">
            <span id="modelshow"></span>
        </div>
    </div>


</div>

<script type="text/javascript">
    $(document).ready(function(){

        gettableData();
        add_edit_voter('');
        $( "form#test_details_form" ).submit(function( event ) {
            event.preventDefault();
            err=0;		
            if(err==0) { 
                $('.preloader').show();
                var form = $("form#test_details_form");  
                var formData = new FormData($(this)[0]); 
                $.ajax({
                    url:  'add_voters.php',
                    type:'post',
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,         
                    success:function(data){  
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: $.trim(data),
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('.preloader').hide();
                            $('#voterid').val('');
                            $('#json_data').val('');
                       gettableData();                           
                    } 
                });
            } 
        });        
    });


    function gettableData(){
        $("#membersTable").DataTable().destroy()
        var dataTable = $('#membersTable').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
                'url':'server_processing.php',                     
                // 'url':' update_data.php',
                // 'order': [1, 'desc'],
                'data': function(data){
                    data.searchByBranch = $('#get_branch').val();
                }
            }

        });
    }
    
    function add_edit_voter(id){
        param = {'act':'add_edit_voters','id':id}
        $('.preloader').show();
        ajax({
            a: "add_voters",
            b: param,
            c: function() {},
            d: function(data) {
                $('.preloader').hide();
                $('#add_edit_card').html(data);
                $( "#serial_no" ).focus();
            }
        });
    }

    function delete_voter(id){
        param = { 'act': 'delete_voters', 'id': id };
        Swal.fire({
            title: "Are you sure you want to delete this voter?",
            text: "Deleting this voter will also delete the corresponding voter details. Please press ' YES ' to confirm.",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then((result) => {
            if (result.value) {
                $('.preloader').show();
                ajax({
                    a: "add_voters",
                    b: param,
                    c: function() {},
                    d: function(data) {
                        var records = JSON.parse(data);
                        $('.preloader').hide();
                            gettableData();
                            add_edit_voter('');      
                    }
                });
            }
        });
    }

    function view_voter_details(id){

    paramModel = {'act':'voterDetails','voter_id':id}
    ajax({
        a:"add_voters",
        b:paramModel,
        c:function(){},
        d:function(data){
            $('#modelshow').html(data);
        }
    });    
}
</script>