<?php function main() { 
   $categorObj = new Categories; ?>

<div class="card borderless-card">
   <div class="card-block info-breadcrumb">
      <div class="breadcrumb-header">
         <h5>Categories</h5>
      </div>
      <div class="page-header-breadcrumb">
         <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
               <a href="#!">
               <i class="fa fa-home"></i>
               </a>
            </li>
            <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL ?>/dashboard.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Categories</a>
            </li>
         </ul>
      </div>
   </div>
</div>

<div class="row">
    <!-- social download  start -->
    <div class="col-xl-4 col-md-6">
        <div class="card social-card bg-c-yellow">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <i class="feather icon-bar-chart-2 f-34 text-c-blue social-icon"></i>
                    </div>
                    <div class="col">
                        <h4 class="m-b-0">Total Categories</h4>
                        <h4 class="m-b-0">
                            <?php
                            $countCategory=   $categorObj->get_category_count();
                            echo $countCategory->total;  ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card social-card  bg-c-green">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <i class="feather icon-bar-chart-2 f-34 text-c-pink social-icon"></i>
                    </div>
                    <div class="col">
                        <h4 class="m-b-0">Work In Progress</h4>
                        <h4 class="m-b-0">
                           <?php  echo  $countCategory->total_active; ?>
                           </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12">
      <a href="javascript:void(0)" onclick="add_edit_category()">
         <div class="card social-card  bg-c-pink">
               <div class="card-block">
                  <div class="row align-items-center">
                     <div class="col-auto">
                           <i class="feather icon-plus f-34 text-c-green social-icon"></i>
                     </div>
                     <div class="col">
                           <h4 class="m-b-0">Add Categories</h4>
                           <br>
                     </div>
                  </div>
               </div>
         </div>
      </a>
    </div>
    <!-- social download  end -->
</div>

<div class="row ">
   <div class="col-7">
      <div class="card" id="service_category_table">
         <div class="card-header bg-c-lite-green;">
            <h5>Categories List</h5>
            <a href="javascript:void(0);" onclick="add_edit_category()" class="right-float label label-success"> Add New</a>&nbsp;&nbsp;
            <!-- <a href="javascript:void(0);" onclick="category_position()" class="right-float label label-warning">Change Position -->
            &nbsp;&nbsp;</a>
         </div>
         <div class="card-block">
            <div class="card-block table-border-style">
               <div class="table-responsive">
                   <form action="javascript:void(0);" id="category_position" style="width:100%">
                    <input type="hidden" name="act" value="category_position">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Category   </th>
                           <th style="text-align:center">Action</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     <tbody  id="draggableMultiple">
                        <?php    $statusArr = array('A' => 'checked', 'I' => '');                                  
											$rsCategory = $categorObj->get_category();
											if (count($rsCategory) > 0) {
												foreach ($rsCategory as $key => $value) { ?>
												
                        <tr class="row_id_<?php echo $value->id; ?>" id="<?php echo $value->id; ?>">
                           <input type="hidden" name="category_id[]" value="<?php echo $value->id ?>">
                           <th><?php echo $key + 1 ?></th>
                           <td><?php echo $value->category_name ?></td>
                           <td>
                              <!-- <div class="btn-group " role="group" > -->
                                 <a href="javascript:void(0);" class="btn btn-sm btn-info" onclick="add_edit_category(<?php echo $value->id; ?>)"><i class="fa fa-edit" aria-hidden="true"></i>Edit</a>
                                 <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="delete_category(<?php echo $value->id; ?>)"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
								         <a href="javascript:void(0);" class="btn btn-sm btn-warning " onclick="category_service_list(<?php echo $value->id; ?>)"><i class="fa fa-plus" aria-hidden="true"></i>Service</a> 
                              <!-- </div> -->
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
      <div class="z-depth-5 waves-effect" id="service_category_form" style="display:none; background-color: rgb(255, 255, 255);">
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