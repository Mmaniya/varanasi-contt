<?php function main() { ?>
<div class="card borderless-card">
   <div class="card-block caption-breadcrumb">
      <div class="breadcrumb-header">
         <h5>Service Category</h5>
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
            <h5>Service Category List</h5>
            <a href="javascript:void(0);" onclick="add_edit_category()" class="right-float"> Add New</a>&nbsp;&nbsp;
            <a href="javascript:void(0);" onclick="category_position()" class="right-float">Change Position
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
                           <th>Action</th>
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
                              <div class="btn-group " role="group" data-toggle="tooltip" data-placement="top">
                                 <a href="javascript:void(0);"
                                    class="btn btn-primary btn-sm waves-effect waves-light"
                                    onclick="add_edit_category(<?php echo $value->id; ?>)">Edit</a>
                                 <a href="javascript:void(0);"
                                    class="btn btn-primary btn-sm waves-effect waves-light"
                                    onclick="delete_category(<?php echo $value->id; ?>)">Delete</a>
                              </div>
                           </td>
                           <td>
                              <label class="switch">
                              <input type="checkbox" class="status_update_<?php echo $value->id; ?>"
                                 onchange="statusCategory(<?php echo $value->id; ?>)"
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
<?php }include '../admin_template.php';?>