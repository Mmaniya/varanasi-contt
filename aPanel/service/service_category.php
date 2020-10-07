<?php function main() { ?>
<div class="card borderless-card">
   <div class="card-block caption-breadcrumb">
      <div class="breadcrumb-header">
         <h5>Service Categories</h5>
      </div>
      <div class="page-header-breadcrumb">
         <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
               <a href="#!">
               <i class="icofont icofont-home"></i>
               </a>
            </li>
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Service Category</a>
            </li>
         </ul>
      </div>
   </div>
</div>
<div class="row ">
   <div class="col-7">
      <div class="card" id="service_category_table">
         <div class="card-header bg-c-lite-green">
            <h5>Service Categories</h5>
            <a href="javascript:void(0);" onclick="add_edit_category()" class="right-float label label-success"> Add New</a>&nbsp;&nbsp;
            <a href="javascript:void(0);" onclick="category_position()" class="right-float label label-warning">Change Position
            &nbsp;&nbsp;</a>
         </div>
         <div class="card-block">
            <div class="card-block table-border-style">
               <div class="table-responsive">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Category</th>
                           <th style="text-align:center">Action</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php    $statusArr = array('A' => 'checked', 'I' => '');
											$rsCategory = Service::get_service_category();
											if (count($rsCategory) > 0) {
												foreach ($rsCategory as $key => $value) {?>
												
                        <tr class="row_id_<?php echo $value->id; ?>">
                           <th><?php echo $key + 1 ?></th>
                           <td><?php echo $value->category_name ?></td>
                           <td>
                              <div class="btn-group " role="group" >
                                 <a href="javascript:void(0);" class="btn btn-primary btn-sm waves-effect waves-light" onclick="add_edit_category(<?php echo $value->id; ?>)">Edit</a>
                                 <a href="javascript:void(0);" class="btn btn-primary btn-sm waves-effect waves-light" onclick="delete_category(<?php echo $value->id; ?>)">Delete</a>
								         <a href="javascript:void(0);" class="btn btn-primary btn-sm waves-effect waves-light" onclick="category_service_list(<?php echo $value->id; ?>)">Service</a> 
                              </div>
                           </td>
                           <td>
                              <label class="switch">
                              <input type="checkbox" class="status_update_<?php echo $value->id; ?>" onchange="statusCategory(<?php echo $value->id; ?>)"
                                 <?php echo $statusArr[$value->status]; ?>>
                              <span class="slider round"></span>
                              </label>
                           </td>
                        </tr>
                        <?php }} else {?>
                        <tr>
                           <td colspan="4" class="text-center"> No Records Found. Click here to <a
                              href="javascript:void(0);" onclick="add_edit_category()"
                              style="color:#01a9ac"> Add New</a> </td>
                        </tr>
                        <?php }?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-5">
      <div class="z-depth-5 waves-effect" id="service_category_form" style="display:none">
      </div>
   </div>
</div>
<script>

	
 function add_edit_category_service(id) {  
    param = { 'act': 'add_edit_service_form', 'id': id };
    ajax({
        a: 'service_form',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#service_form').show();
            $('#service_form').html(data); 			 
        }
    });
}

</script>


<?php }include '../admin_template.php';?>