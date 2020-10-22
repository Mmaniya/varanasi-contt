<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$action = $_POST['act'];
$employeeObj = new Employee; ?>


<?php if($action =='employee_statistics'){ ?>
    <div class="page-body">
        <div class="row">
            <div class="col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-block text-center">
                        <i class="feather icon-users text-c-pink d-block f-40"></i>
                        <h4 class="m-t-20"><span class="text-c-pink">
                        <?php $empcount = $employeeObj->get_employee_count(); echo $empcount->total_active ?>
                        </span> Active Employee</h4>
                        <p class="m-b-20"></p>
                        <button class="btn btn-primary btn-sm btn-round cursor" onclick="employee_main_table()">view</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-block text-center">
                        <i class="feather icon-battery-charging text-c-lite-green d-block f-40"></i>
                        <h4 class="m-t-20"><span class="text-c-lite-green">
                        <?php $rolecount = $employeeObj->get_emp_role_count(); echo $rolecount->total_active ?>
                        </span> Active Role</h4>
                        <p class="m-b-20"></p>
                        <button class="btn btn-primary btn-sm btn-round cursor" onclick="employee_role()">view</button>
                    </div>
                </div>
            </div>      
            <div class="col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-block text-center">
                        <i class="feather icon-battery-charging text-c-lite-green d-block f-40"></i>
                        <h4 class="m-t-20"><span class="text-c-lite-green">
                        <?php $rolecount = $employeeObj->get_emp_role_count(); echo $rolecount->total_active ?>
                        </span> Active Role</h4>
                        <p class="m-b-20"></p>
                        <button class="btn btn-primary btn-sm btn-round cursor" onclick="employee_role()">Add New</button>
                    </div>
                </div>
            </div>
            <!-- <div class="col-xl-3 col-md-6 cursor" onclick="employee_role()">
                <div class="card">
                    <div class="card-block">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="feather icon-battery-charging f-30 text-c-blue"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Add New Role</h6>
                                <h2 class="m-b-0">
                                <?php $rolecount = $employeeObj->get_emp_role_count(); echo $rolecount->total_active ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 cursor" onclick="employee_main_table()">
                <div class="card">
                    <div class="card-block">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="feather icon-users f-30 text-c-pink"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Add Empoyee</h6>
                                <h2 class="m-b-0">5984</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-block">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="feather icon-book f-30 text-c-lite-green"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Tickets Answered</h6>
                                <h2 class="m-b-0">379</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-block">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="feather icon-feather f-30 text-c-green"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Projects Launched</h6>
                                <h2 class="m-b-0">205</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div> 
<?php } ?>

<?php if($action == 'employee_role'){   

    $btnName = $title = 'Add New';
    $employeeId =  $_POST['id'];
    if ($employeeId > 0) {
        $employeeObj->id = $_POST['id'];
        $rsEmployee = $employeeObj->get_employee_role();  
        $btnName = $title = 'Edit ';
    }  ?>

    <script> tinymce.remove(); tinymce.init(); </script>
    <div class="card-header bg-c-lite-green">
        <h5 class="card-header-text"><?php echo $btnName ?> Role</h5>
        <a href="javascript:void(0);" onclick="hide_employee_form()" style="font-size:16px;" class="right-float label label-danger"><i class="feather icon-x">Cancel</i></a>
    </div>
    <div class="card-block" style="background-color: rgb(255, 255, 255);">
        <form action="javascript:void(0);" id="employee_role"  enctype="multipart/form-data">
            <input type="hidden" value="add_new_role" name="act">
            <input type="hidden" name="id" id="role_id" value="<?php echo $rsEmployee[0]->id; ?>">
            <input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id']; ?>">

            <div class="row">
                <div class="col-sm-6 col-lg-6">
                    <label class="col-form-label">Role</label>
                    <div class="input-group input-group-inverse">
                        <input type="text" class="form-control" placeholder="Enter Role Name" name="role_name"
                            value="<?php echo $rsEmployee[0]->role_name; ?>">
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                    <label class="col-form-label">Role Abbreviation</label>
                    <div class="input-group input-group-inverse">
                        <input type="text" class="form-control" placeholder="Enter Role Abbreviation"
                            name="role_abbr" value="<?php echo $rsEmployee[0]->role_abbr; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <label class="col-form-label">Role Description</label>
                    <div class="input-group input-group-inverse">
                        <textarea rows="5" cols="5" class="form-control" placeholder="Enter Role Description" id="role_description" name="role_description"><?php echo $rsEmployee[0]->role_description; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <input type="submit" class="btn btn-grd-primary" value="Submit">
                </div>
            </div>
        </form>
    </div>
    <script>
        $("form#employee_role").submit(function() {
            tinyMCE.triggerSave();
            var formData = $('form#employee_role').serialize();
                $.ajax({
                url: '<?php echo EMPLOYEE_DIR ?>/employee_ajax.php',
                type: 'POST',
                data: formData,        
                success: function(data) {
                    console.log(data);
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        tinymce.remove();
                        employee_role();
                        employee_statistics();
                        hide_employee_form();
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft',
                            'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft',
                            'animated fadeOutLeft', records.data);
                    }
                }
            });
        });
    </script>
    <script src="<?php echo ADMIN_JS ?>/tinymce/wysiwyg-editor.js"></script>
<?php } ?>

<?php if($action == 'add_edit_employee'){  
  
    $emp_id = $_POST['emp_id'];
    $btnName = $title = 'Add New';
    if ($emp_id > 0) {
        $employeeObj->id = $emp_id;
        $rsEmployee = $employeeObj->get_employee_details();  
     
        foreach ($rsEmployee[0] as $K => $V) {
            $$K = $V;
        } 
        $btnName = $title = 'Edit ';
    } ?>
    <script>  tinymce.remove(); tinymce.init(); </script>
    <style> .mce-panel {   width: 99%; } .wizard > .content { min-height: 28em; }</style>
    <div class="col-12">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo $btnName ?> Employee</h5>            
                                <a href="javascript:void(0);" onclick="hide_emp_details()" style="font-size:16px;" class="right-float label label-danger"> <i class="feather icon-x">Cancel</i></a>
                        </div>
                        <div class="card-block">
                            <div id="wizard1">
                                <section>
                                    <form action="javascript:void(0);" class="wizard-form " id="employee_forms"  enctype="multipart/form-data">
                                        <input type="hidden" value="add_edit_employee" name="act">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id']; ?>">
                                        <h3> Personal Details </h3>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">First Name</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Enter First Name" name="first_name" value="<?php echo $first_name; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Last Name</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Enter Last Name" name="last_name" value="<?php echo $last_name; ?>">
                                                    </div>
                                                </div>

                                                <?php if(empty($employee_img)){ ?>
                                                <div class="col-sm-6 col-lg-6">
                                                <?php } else { ?> 
                                                <div class="col-sm-3 col-lg-3">
                                                <?php } ?>
                                                    <label class="col-form-label">Img</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="file" class="form-control" placeholder="Upload Image" name="employee_img" id="employee_img">
                                                    </div>
                                                </div>

                                                <?php if(!empty($employee_img)){ ?>
                                                    <div class="col-sm-3 col-lg-3"> 
                                                        <img src="<?php echo EMPLOYEE_PROFILE .'/'. $employee_img; ?>" alt="Service Images" width="100" height="100">
                                                    </div>
                                                <?php } ?>

                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Gender</label>                                                                    
                                                    <div class="form-radio "> 
                                                        <div class="radio  radio-inline">
                                                            <label>
                                                                <input type="radio" value="M" name="gender" <?php if($gender == 'M'){ ?> checked="checked" <?php }else if($gender == ''){ ?> checked="checked" <?php } ?> >
                                                                <i class="helper"></i>Male
                                                            </label>
                                                        </div>
                                                        <div class="radio  radio-inline">
                                                            <label>
                                                                <input type="radio" value="F" name="gender" <?php if($gender == 'F'){ ?> checked="checked" <?php } ?>>
                                                                <i class="helper"></i>Female
                                                            </label>
                                                        </div>                                                              
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Mobile</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="tel" class="form-control" placeholder="Enter Mobile" name="mobile" value="<?php echo $mobile; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Email Id</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="email" class="form-control" placeholder="Enter Email Address" name="personal_email" value="<?php echo $personal_email; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Address</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Enter Address" name="address" value="<?php echo $address; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">City</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Enter City" name="city" value="<?php echo $city; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">State</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Enter State" name="state" value="<?php echo $state; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Zip Code</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Enter Zipcode" name="zipcode" value="<?php echo $zipcode; ?>">
                                                    </div>
                                                </div>  
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Blood Group</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Enter Blood Group" name="blood_group" value="<?php echo $blood_group; ?>">
                                                    </div>
                                                </div>                                                                                                                             
                                            </div>

                                        </fieldset>
                                        <h3>Education</h3>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Select Degree</label>
                                                    <div class="input-group input-group-inverse">
                                                        <select class="form-control" name="select_degree">
                                                            <option value="">Select Option</option>
                                                            <option <?php if ($select_degree == 'ug') {echo 'selected';} ?> value="ug">UG</option>
                                                            <option <?php if ($select_degree == 'pg') {echo 'selected';} ?> value="pg">PG</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-lg-6">
                                                    <label class="col-form-label">Degree</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Enter Course" name="course" value="<?php echo $course; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Completed Year</label>
                                                    <div class="input-group input-group-inverse">
                                                        <select class="form-control" name="completed_year">
                                                            <option value="">Select Option</option>
                                                            <?php for ($x = 2000; $x <= 2030; $x++) { ?>
                                                                <option <?php if ($completed_year ==  $x) {echo 'selected';} ?> value="<?php echo $x ?>"><?php echo $x ?></option>
                                                            <?php }  ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">College Name</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Enter College Name" name="college_name" value="<?php echo $college_name; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Select Role</label>
                                                    <div class="input-group input-group-inverse">
                                                        <select class="form-control" name="role_id">
                                                            <option value="">Select Option</option>
                                                            <?php 
                                                                $employeeObj->id = '';
                                                                $rsEmployeerole = $employeeObj->get_employee_role();                                                     
                                                                   foreach ($rsEmployeerole as $k => $v){ if($v->status == 'A'){ ?>
                                                                    <option <?php if ($role_id ==  $v->id) { echo 'selected'; } ?> value="<?php echo $v->id ?>"><?php echo $v->role_name ?></option>
                                                            <?php  } } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Select Any One</label>
                                                    <div class="input-group input-group-inverse">
                                                        <select class="form-control" name="relevant_field" onchange="selectexperience()" id="exprience">
                                                            <option value="">Select Option</option>
                                                            <option <?php if ($relevant_field == 'E') { echo 'selected';} ?> value="E">Experience</option>
                                                            <option <?php if ($relevant_field == 'F') { echo 'selected';} ?> value="F">Fresher</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-lg-3" id="year_of_exp" <?php if ($relevant_field == 'E') { ?> style="display:block;" <?php }else{ ?> style="display:none;" <?php } ?>>
                                                    <label class="col-form-label">Years of Experience</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Enter Years of Experience" name="if_experience_years" value="<?php echo $if_experience_years; ?>">
                                                    </div>
                                                </div>
                                            </div>                                                                               
                                        </fieldset>
                                        <h3> Company Details  </h3>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Joining Date</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="date" class="form-control" placeholder="Select Joining Date" name="joining_date" value="<?php echo $joining_date; ?>">
                                                    </div>
                                                </div>
                
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Id Proof (Aadhar,Pan,etc...)</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="file" class="form-control" placeholder="Upload Id Proof" name="id_proof" id="id_proof">
                                                    </div>
                                                </div>

                                                <?php if(!empty($employee_img)){ ?>
                                                    <div class="col-sm-3 col-lg-3"> 
                                                        <img src="<?php echo EMPLOYEE_IDPROOF .'/'. $id_proof; ?>" alt="Id Proof" width="100" height="100">
                                                    </div>
                                                <?php } ?>

                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Company email (<span style="color:red">username</span>)</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="email" class="form-control" placeholder="Enter Company Email" name="company_email" value="<?php echo $company_email; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Password </label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Generate Password" id="password" name="password" value="<?php echo $password; ?>">
                                                        <a herf="javascript:void(0);" onclick="generate_password()" class="btn btn-info">Generate</a>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Reached MMS By</label>
                                                    <div class="input-group input-group-inverse">
                                                        <select class="form-control" name="reached_mms_by" onchange="reached_by_mms()" id="reachedby">
                                                            <option value="">Select Option</option>
                                                            <option <?php if ($reached_mms_by == 'call') { echo 'selected';} ?> value="call">Call</option>
                                                            <option <?php if ($reached_mms_by == 'reference') { echo 'selected';} ?> value="reference">Reference</option>
                                                            <option <?php if ($reached_mms_by == 'consultancy') { echo 'selected';} ?> value="consultancy">Consultancy</option>
                                                            <option <?php if ($reached_mms_by == 'walkin') { echo 'selected';} ?> value="walkin">Walkin</option>
                                                            <option <?php if ($reached_mms_by == 'others') { echo 'selected';} ?> value="others">Others</option>
                                                        </select>
                                                    </div>  
                                                </div>
                                    
                                                    <div class="col-sm-3 col-lg-3 reference" <?php if ($reached_mms_by == 'reference'){ ?> style="display:block" <?php }else{ ?> style="display:none" <?php } ?>>

                                                    <?php if ($reached_mms_by == 'reference'){                                                     
                                                         $employeeObj->id = $if_reference_or_consultancy_id;
                                                         $rsltemppack = $employeeObj->get_employee_refernce();  ?> 
                                                    <input type="hidden" class="form-control"  name="ref_id" value="<?php echo $if_reference_or_consultancy_id; ?>">
                                                    <?php } ?>

                                                    <label class="col-form-label">Referred  By</label>
                                                    <select class="form-control" name="working_mms" onchange="reference()" id="referedby">
                                                        <option value="">Select Option</option>
                                                        <option <?php if ($rsltemppack[0]->working_mms == 'Y') { echo 'selected'; } ?> value="Y">Employee</option>
                                                        <option <?php if ($rsltemppack[0]->working_mms == 'N') { echo 'selected'; } ?> value="N">Others</option>                                                           
                                                    </select>
                                                </div>
                                                    <div class="col-sm-3 col-lg-3 employee" <?php if ($rsltemppack[0]->working_mms == 'Y') { ?> style="display:block" <?php }else{ ?> style="display:none" <?php } ?>>
                                                    <label class="col-form-label">Select Employee</label>
                                                    <select class="form-control" name="if_yes_member_id">
                                                        <option value="">Select Employee</option>
                                                        <?php   $employeeObj->id = '';
                                                                $rsltemp = $employeeObj->get_employee_details();  
                                                                foreach ($rsltemp as $K => $V) {  
                                                                if($V->status == 'A' && $V->id != $id) {  ?>
                                                                <option <?php if ($rsltemppack[0]->if_yes_member_id == $V->id) { echo 'selected'; } ?> value="<?php echo $V->id ?>"><?php echo $V->first_name.'&nbsp;'.$V->last_name ?> </option>
                                                                <?php } } ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 col-lg-3 referedothers"  <?php if ($rsltemppack[0]->working_mms == 'N') { ?> style="display:block" <?php }else{ ?> style="display:none" <?php } ?>>
                                                    <label class="col-form-label"> Reference User Name</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Reference User Name" name="username" value="<?php echo $rsltemppack[0]->username; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-lg-3 referedothers"  <?php if ($rsltemppack[0]->working_mms == 'N') { ?> style="display:block" <?php }else{ ?> style="display:none" <?php } ?>>
                                                    <label class="col-form-label"> Reference User Mobile</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="tel" class="form-control" placeholder="Reference User Mobile" name="usermobile" value="<?php echo $rsltemppack[0]->usermobile; ?>">
                                                    </div>
                                                </div>
                                            </div>                                     
                                        </fieldset>
                                        <h3> Package </h3>
                                        <fieldset>
                                            <?php 
                                                 if ($emp_id > 0) {
                                                    $employeeObj->id = $emp_id;
                                                    $rsEmpackage = $employeeObj->get_employee_package();  
                                                    foreach ($rsEmpackage[0] as $K => $V) {
                                                        $$K = $V;
                                                    } 
                                                 }
                                            ?>
                                            <div class="row">
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Monthly Package</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="number" class="form-control" placeholder="Enter Monthly Package" name="monthly_package" value="<?php echo $monthly_package; ?>">
                                                        <span class="input-group-addon">₹</span>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Bank Name</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Enter Bank Name" name="bank_name" value="<?php echo $bank_name; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Account Number</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Enter Ifsc Code" name="account_number" value="<?php echo $account_number; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Account Name</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Enter Account Name" name="account_name" value="<?php echo $account_name; ?>">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">Ifsc Code</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Enter Ifsc Code" name="ifsc_code" value="<?php echo $ifsc_code; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="col-form-label">UPI ID</label>
                                                    <div class="input-group input-group-inverse">
                                                        <input type="text" class="form-control" placeholder="Enter UPI Id" name="upi_id" value="<?php echo $upi_id; ?>">
                                                    </div>
                                                </div>                                 
                                            </div>                     
                                        </fieldset>                                 
                                    </form>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo ADMIN_JS ?>/tinymce/wysiwyg-editor.js"></script>
    <script>
        $("#employee_forms").steps({
            headerTag: "h3",
            bodyTag: "fieldset",
            transitionEffect: "slideLeft",
            autoFocus: true
        });

        $(".actions a[href$='#finish']").on('click', function() {
            tinyMCE.triggerSave();

            var formData = new FormData();
            formData.append("employee_img", document.getElementById('employee_img').files[0]);
            formData.append("id_proof", document.getElementById('id_proof').files[0]);
            var fields = $('form#employee_forms').serializeArray();
            jQuery.each(fields, function(i, field) {

                formData.append(field.name, field.value + "");

            });
            $.ajax({
                url: '<?php echo EMPLOYEE_DIR ?>/employee_ajax.php',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {                 
                        hide_emp_details();
                        employee_main_table();
                        employee_statistics();
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft',
                            'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft',
                            'animated fadeOutLeft', records.data);
                    }
                }
            });
        });
       
    </script>

<?php } ?>