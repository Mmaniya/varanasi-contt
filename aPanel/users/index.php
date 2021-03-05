<?php function main() { 
    if($_POST['act']=='add_edit_users') {
        ob_clean();
            include 'user-model.php'; 
        exit(); 
    } ?>
	

  <div class="row">
      <div class="col-md-12">
          <!-- <div class="users_list">
          </div> -->
          
<div class="card">
    <div class="card-header">
        <h4>Users List
            <!-- <a href="javascript:void(0);" class="btn btn-primary waves-effect btn-md float-right" data-toggle="modal" data-target="#large-Modal">Large</a> -->
            <a href="javascript:void(0)" class="btn btn-primary btn-md float-right" onclick="add_edit_user(0)">Add New user</a>
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="user-table" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>User Type</th>
                    <th>Booth</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $userObj = new Users;
            function userType($type) {
                $data = array('SA'=>'Super Admin','A'=>'Admin','DE'=>'Data Entry');
                return $data[$type];
            }
            $statusArr = array('A' => 'checked', 'I' => '');
            $userList = $userObj->getUserList(); 
            if(count($userList)>0) {
                $i = 0;
                foreach($userList as $key=>$val) {
                    if($val->user_type != 'SA'){ ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $val->name;?></td>
                    <td><?php echo $val->email;?></td>
                    <td><?php echo $val->phone;?></td>
                    <td><?php echo userType($val->user_type);?></td>

                    <td>
                        <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#large-Modal<?php echo $val->id?>">View</button>
                        <div class="modal fade" id="large-Modal<?php echo $val->id?>" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">View Booth</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-times" aria-hidden="true"></i>                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <ul class="scroll-list cards" style="overflow: hidden; width: auto; height: 300px;">
                                    <?php $booth_id =  explode(',',$val->booth_id);  
                                        if($booth_id[0] != 0){
                                        foreach($booth_id as $key => $value){
                                            $rawDataObj = new VotersRawData; 
                                            $rawDataObj->booth_id= $value;    
                                            $getBooth = $rawDataObj->get_booth_name(); 
                                            if($getBooth->booth_no !=''){
                                            ?>
                                                <li>
                                                    <h6><strong><?php echo $getBooth->booth_no; ?></strong> - <?php echo $getBooth->booth_name; ?></h6>
                                                </li><hr>
                                            <?php 
                                        }}}else{ ?>
                                              <li>
                                                    <h6>Booth Not Added</h6>
                                                </li><hr>
                                        <?php }
                                    ?>                                        
                                        </ul>
                                    </div>                        
                                </div>
                            </div>
                        </div>         
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn btn-primary btn-sm" onclick="add_edit_user(<?php echo $val->id;?>)">Edit</a>
                        <a href="javascript:void(0)" class="btn btn btn-danger btn-sm" onclick="delete_user(<?php echo $val->id;?>)" >Delete</a>                    
                    </td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" class="status_update_<?php echo $val->id; ?>"  onchange="usersStatus(<?php echo $val->id; ?>)"
                            <?php echo $statusArr[$val->status]; ?>>
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>
            <?php } $i++; }} ?>
            </tfoot>
            </table>
        </div>
    </div>
</div>


      </div>
      <span class="popup_content"></span>

  </div>


  <script>
 
</script>

<?php }include '../admin_template.php';?>