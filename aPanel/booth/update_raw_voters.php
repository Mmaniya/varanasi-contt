<?php  function main() {   ?>

<div class="container">
<br>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <form method="post" enctype="multipart/form-data" class="form-horizontal" name="test_details_form" id="test_details_form">
    
                    <div class="form-group row text-center">
                        <div class="col-4">
                        <label for="inputEmail3" class="col-form-label">Captcha</label>
                            <input  name="captch" id="captch" placeholder="Captch Code"  class="form-control"  value="<?php echo $voters->serial_no; ?>" type="text">  
                            <a href="https://electoralsearch.in/##resultArea" target="_blank" style="color:blue"> Get Captcha</a>
                        </div>
                        <!-- <div class="col-4">
                            <label for="inputEmail3" class="col-form-label">Select User</label>
                            <select name="users" class="form-control" id="usersDetails">
                                <option value="">Select User</option>
                                    <?php 
                                        $users ="SELECT * FROM `".TBL_VOTERS_RAW_DATA."` group by added_by";
                                        $result = dB::mExecuteSql($users);
                                        if(count($result)>0) {
                                        foreach($result as $key=>$val) {
                                        $voter1 ="SELECT * FROM `".TBL_USERS."` where id=".$val->added_by;
                                        $Userresult = dB::sExecuteSql($voter1);
                                        echo '<option value="'.$Userresult->id.'">'.$Userresult->name.'</option>';
                                        
                                        }}
                                    ?> 
                            </select>
                        </div> -->
                        <div class="col-4">

                            <label for="inputEmail3" class="col-form-label">Select Booth Number</label>
                            <div style="display:flex;">
                                <select class="form-control" onchange="updatevotersrecords()" id="select_booth">
                                </select>
                                <!-- <a href="javascript:void(0);" onclick="updatevotersrecords()" class="btn btn-info"><i class="fa fa-recycle" aria-hidden="true"></i></a> -->
                            </div>
                                <label><span class="votersCount"></span></label>
                        </div>
                        <!-- select all booth number -->

                        <!-- <div class="col-4">
                                <label for="inputEmail3" class="col-form-label">Select Booth Number</label>
                                <select class="form-control"  id="filterbyBoothno">
                                    <option value="">Select Booth Number</option>
                                        <?php 
                                            $users ="SELECT * FROM ".TBL_VOTERS_RAW_DATA." group by booth_number";
                                            $result = dB::mExecuteSql($users);
                                            if(count($result)>0) {
                                                foreach($result as $key=>$val) {  
                                                    echo '<option value="'.$val->booth_number.'">'.$val->booth_number.'</option>'; 
                                                }
                                            }
                                        ?> 
                                </select>
                                <label><span class="votersCount"></span></label>
                            </div> -->

                        <!-- select all booth number -->


                        
                    </div>
                    

                <div class="form-group row">
                    <input type="hidden" value="0" id="loadmoredata">   
                    <table class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Voter Id</th>
                                <th>Address</th>
                                <th>Data</th>
                                <th>Action</th>                              
                            </tr>
                        </thead>  
                        <tbody id="displayvoters"></tbody>   
                    </table>
                </div>

                <div class="form-group row text-center" id="loadmore" style="display:block;">
                    <a href="javascript:void(0);" class="btn btn-info" onclick="getmoreData()">Load more</a>
                </div>


                </form> 
            </div>
        </div>
    </div> 

</div>  

<div class="preloader" style="display:none;">
    <div id="loader"></div>
</div>

</div>
<input type="hidden" value="<?php echo $_SESSION['booth_id'] ?>" id="booth_id">
<input type="hidden" value="<?php echo $_SESSION['user_id'] ?>" id="usersDetails">
<script type="text/javascript">

// $('#usersDetails').on('change', function() {
//     $('.preloader').show();
//     param = {'act':'getvotersbyusers','userid': this.value }
//     ajax({
//         a:"update_raw_voters_ajax",
//         b:param,
//         c:function(){},
//         d:function(data){
//             $('.preloader').hide();
//             $('#displayvoters').html ('');
//             $('.votersCount').html ('');
//             $('#select_booth').html(data);
//         }
//     });

// });

var boothid = $('#booth_id').val();
getvoterbooth(boothid);
function getvoterbooth(boothid){
    $('.preloader').show();
    param = {'act':'getvotersbyusers', 'booth_id': boothid }
    ajax({
        a:"update_raw_voters_ajax",
        b:param,
        c:function(){},
        d:function(data){
            $('.preloader').hide();
            $('#select_booth').html(data);
        }
    });
}

// $('#select_booth').change(function(){
// var booth = $(this).val();
function updatevotersrecords(){
    $('#loadmoredata').val('0');
    var booth = $('#select_booth').val();
    param = {'act':'gettotalrecords','booth_no': booth}
    ajax({
        a:"update_raw_voters_ajax",
        b:param,
        c:function(){},
        d:function(data){
            $('.votersCount').html(data);
        }
    });
        getvoterInfo(booth);
};

function countvotersrecords(){
    var booth = $('#select_booth').val();
    param = {'act':'gettotalrecords','booth_no': booth}
    ajax({
        a:"update_raw_voters_ajax",
        b:param,
        c:function(){},
        d:function(data){
            $('.votersCount').html(data);
        }
    });    
};

function getvoterInfo(booth) {
    var limit = $('#loadmoredata').val();
    $('.preloader').show();
    param = { 'act': 'getallvotersdetails','limit': limit,'group_by': booth }
    ajax({
        a: "update_raw_voters_ajax",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();            
            $('#displayvoters').html(data);
            $('#loadmoredata').val(Number(limit) + 100);
        }
    });
}

function getmoreData (){
    var limit = $('#loadmoredata').val();
    var booth = $('#select_booth').val();
    // var group_by = $('#usersDetails').val();
    param = { 'act': 'getallvotersdetails','limit': limit,'group_by': booth }
    ajax({
        a: "update_raw_voters_ajax",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();            
            $('#displayvoters').append(data);
            $('#loadmoredata').val(Number(limit) + 100);
        }
    });
}
 
function pasteElement(id){
    if (window.clipboardData) {

        $('#voters_raw_data_'+id).val('');
        $('#voters_raw_data_'+id).val(window.clipboardData.getData('Text')); 
        jsonData = $('#voters_raw_data_'+id).val().trim();

        if(jsonData!='') {
            var ListEpic = $('#voters_'+id).val();
            result = JSON.parse(window.clipboardData.getData('Text'));
            var jsonEpic = result.response.docs[0].epic_no;
            if(jsonEpic.trim()==ListEpic.trim()) {
                updateVoterDetails(id);  // submit json data 
                autoOpenNextWindow(id);
            }
        } 
        return;
    } 
}

function updateVoterDetails(id){  
    $('#add_Data'+id).css('background-color','#ff0000');
    var usersDetails =$('#usersDetails').val();
    var voterid = $('#voters_'+id).val();
    var voterRawData = $('#voters_raw_data_'+id).val();
    param = { 'act': 'updatevoterRawdata', 'voterid':voterid,'voterRawdata':voterRawData, 'user':usersDetails }
        ajax({
        a: "update_raw_voters_ajax",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
                $("#add_Data"+id).css("display", "none");
                $("#responceData"+id).css("display", "block");
                $('#voters_raw_data_'+id).prop('readonly', true);
                countvotersrecords();
                // setTimeout(function(){
                    //$("#remove_"+id).hide();
                // }, 10000);
        }
    });
}
   
function autoOpenNextWindow(id) {
    var nextElement = id+1; 
    getVoterDetails(nextElement);			 
}

function getVoterDetails(id){

    var captch = $('#captch').val();
    var voterid = $('#voters_'+ id).val();
    GoURL('https://electoralsearch.in/Home/searchVoter?epic_no='+voterid+'&page_no=1&results_per_page=10&reureureired=ca3ac2c8-4676-48eb-9129-4cdce3adf6ea&search_type=epic&state=S22&txtCaptcha='+captch); 
    $('#voters_raw_data_'+id).focus();
}

function GoURL(url) {  
	 
    var tempElement = document.createElement("input"); 
    tempElement.style.cssText ="width:0!important;padding:0!important;border:0!important;margin:0!important;outline:none!important;boxShadow:none!important;"; document.body.appendChild(tempElement); tempElement.value = ' ' // Empty string won't work! 
    tempElement.select(); document.execCommand("copy"); 
    document.body.removeChild(tempElement) 

    var child = window.open(url, "_blank", "height=400,width=400");
    child.focus();
    var timer = setInterval(checkChild, 12500);

    function checkChild() {
        //selectedText = child.getSelection().toString();
        //alert(selectedText);
        child.close();
    }
        
}
</script>

<?php }include '../admin_template.php';?>