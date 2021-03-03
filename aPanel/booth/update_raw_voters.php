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


<?php }include '../admin_template.php';?>