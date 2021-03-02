
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<link rel="stylesheet" href="../assets/css/custom.css" type="text/css"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript" src="../assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../assets/js/default.js"></script>	


<?php  
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php"; ?>
<div class="container">
<br>

<div class="row">

    <?php  $booth_no = Voters::getsingleBoothDetails($_REQUEST['booth']); ?>
    <input type="hidden" value="<?php echo $booth_no->id; ?>" name="booth_id" id="get_booth" />
    <input type="hidden" value="0" id="loadmoredata">   
     
        <div class="col-md-6">
            <div class="card" >
                <div class="card-body connected-sortable droppable-area1" id ="displayvoters">
                
                </div>
           
            </div>

      


        </div>
        <div class="col-md-6">

        <form action="javascript:void(0);" method="post">
            <div class="card">
                <span class="pl-4 pt-3"> Family Head </span>
                <div class="card-body connected-sortable droppable-area2"></div>
            </div> 
            <br>
            <div class="card">
                <span class="pl-4 pt-3"> Family  Member</span>
                <div class="card-body connected-sortable droppable-area3"></div>
            </div> 
            <br>
            <div class="text-center">
                <a class="btn btn-info" href="javascript:void(0)" id="position_update">Submit</a>
            </div>

        </form>

          
        <!-- <div class="card">
            <div class="card-body">
                <table id='votersTable' class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Name</th>
                            <th>Relation Type</th>
                        </tr>
                    </thead>     
                </table>
            </div>
        </div> -->
        
        <div class="card">
            <div class="card-body" id="updateddata">
               
            </div>
        </div> 






        </div>


</div>  

<br>
<br>
<br>

<div class="preloader" style="display:none;">
    <div id="loader"></div>
</div>



</div>

<script type="text/javascript">


$( init );



function init() {


    $( "#sortable1" ).sortable({
        connectWith: ".connected-sortable",        
    });

    $(".droppable-area2 ").sortable({
        connectWith: ".connected-sortable",
    });

    $(".droppable-area3").sortable({
        connectWith: ".connected-sortable",
    });

    $("#sortable1, .droppable-area2, .droppable-area3").disableSelection();

    $(".droppable-area2").on("sortreceive", function(event, ui) {
        var $list = $(this);
        if ($list.children().length > 1) {
            $(ui.sender).sortable('cancel');
        }else{
            $('#family_head').val(ui.item.attr("id"));
        }
    });

  
    $( "#position_update" ).click(function() {   
        var cnt='';

        $('.droppable-area3 tr').each(function() { 
            cnt+=$(this).attr('id')+',';      
        });  
        
        var family_members = cnt.replace(/(^\s*,)|(,\s*$)/g, '');      
        var family_head = $('.droppable-area2 tr').attr('id');

        $('.preloader').show();  
        param = { 'act': 'votersfamilydetailsupdate', 'family_members': family_members, 'family_head':family_head }
        ajax({
            a: "add_voters",
            b: param,
            c: function() {},
            d: function(data) {                             
                $('.preloader').hide();  
                    location.reload();
                    // getUpdatedrecords();
                // getVoterdetails();
            }
        }); 



    });

}


$(document).ready(function(){
    getVoterdetails(); 
    // getupdatedvoters();  
    getUpdatedrecords();
});


function getVoterdetails(){
    var booth_id = $('#get_booth').val();
    param = { 'act': 'getallVotersList', 'booth_id': booth_id }
    ajax({
        a: "add_voters",
        b: param,
        c: function() {},
        d: function(data) {                             
            $('.preloader').hide();  
            $('#displayvoters').html(data); 
        }
    }); 
}


function getupdatedvoters(){
    $("#votersTable").DataTable().destroy()
    var dataTable = $('#votersTable').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'ajax': {
            'url':' family_data_table_1.php',
            'data': function(data){
                data.searchByBranch = $('#get_booth').val();
            }
        }

    });
}

function getUpdatedrecords(){
    var booth_id = $('#get_booth').val();
    param = { 'act': 'viewfamilyMembers', 'booth_id': booth_id }
    ajax({
        a: "add_voters",
        b: param,
        c: function() {},
        d: function(data) {                             
            $('.preloader').hide();  
            $('#updateddata').html(data); 
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

function saveRelation(val,id){

    paramModel = {'act':'addfamilyinfo','family_slno':val,'id':id }
    ajax({
        a:"add_voters",
        b:paramModel,
        c:function(){},
        d:function(data){
           // gettableData();
            //$('#modelshow').html(data);
        }
    });
}
</script>