<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/js/default.js"></script>	
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<br>
<div class="container">
	<div class="row">

        <div class="col-12 col-md-8 col-lg-8 pb-8">
            <div class="card">
            
                <div class="card-body">

                    <select  id='searchByState' name="st_code" class="form-control statesList">
                        <!-- <option value='' disabled selected>--Select State--</option> -->
                    </select>   

                    <br>
                    <div class="table-responsive">
                        <table id='partyTable' class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>State</th>                                   
                                    <th>Party Name</th> 
                                    <th>Party Abbr</th>                               
                                    <th>Action</th>
                                </tr>
                            </thead>     
                        </table>
                    </div>
                </div>
            </div> 
        </div>
        <div class="col-12 col-md-4 col-lg-4 pb-4" id="party_form">

        </div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    getForm();
    getallstate('');
});
function getallstate(st_code){
param = {'act':'getallState','st_code':st_code}
   ajax({
        a:"parties_ajax",
        b:param,
        c:function(){},
        d:function(data){
            $('.statesList').html(data);
        }
    });
}

$('#searchByState').change(function(){
    var state_id = $(this).val();
    gettableData(state_id);

});

function getForm(){
    param = {'act':'getpartiesForm'}
    ajax({
        a:"parties_ajax",
        b:param,
        c:function(){},
        d:function(data){
            $('#party_form').html(data);
        }
    });
}


function gettableData(state_id){
    $("#partyTable").DataTable().destroy()
    var dataTable = $('#partyTable').DataTable({
    'processing': true,
    'serverSide': true,
    'responsive': true,
    'serverMethod': 'post',
    'ajax': {
            'url':' parties_ajax.php',
            'data': function(data){
                    data.act = 'getPartyTable';
                    data.searchByState = state_id;
            }
        }

    });
}

function view_party_details(id,st_code){
    param = {'act':'getpartiesForm','party_id':id}
    ajax({
        a:"parties_ajax",
        b:param,
        c:function(){},
        d:function(data){
            $('#party_form').html(data);
        }
    });
    getallstate(st_code);

}

function delete_party(id){

    param = {'act':'deleteparties','party_id':id}
    ajax({
        a:"parties_ajax",
        b:param,
        c:function(){},
        d:function(data){
            getForm();
            getallstate('');
            // $('#party_form').html(data);
        }
    });
 
}

</script>