<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$action = $_POST['act'];
$leadsObj = new Leads; ?>

<?php if($action =='leads_statistics'){ ?>
<div class="row">
    <div class="col-md-6 col-xl-6 cursor">
        <div class="card widget-statstic-card">
            <div class="card-header">
                <div class="card-header-left">
                    <h5>Total Leads</h5>
                    <!-- <p class="p-t-10 m-b-0 text-c-yellow">Active Clients</p> -->
                </div>
            </div>
            <div class="card-block">
                <i class="feather icon-users st-icon bg-c-yellow"></i>
                <div class="text-left">
                    <h3 class="d-inline-block">
                        <?php $leadscount = $leadsObj->get_leads_count(); echo $leadscount->total_active ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-6 cursor">
        <div class="card widget-statstic-card">
            <div class="card-header">
                <div class="card-header-left">
                    <h5>White Label Client</h5>
                    <!-- <p class="p-t-10 m-b-0 text-c-pink">55% From last 28 hours</p> -->
                </div>
            </div>
            <div class="card-block">
                <i class="feather icon-users st-icon bg-c-pink txt-lite-color"></i>
                <div class="text-left">
                    <h3 class="d-inline-block">
                        <?php //$leadscount = $leadsObj->get_leads_count(); echo $leadscount->wl_member ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>
    
</div>
<?php } ?>

<?php if($action == 'add_edit_leads'){  
  
  $leads_id = $_POST['leads_id'];
  $btnName = $title = 'Add New';
  if ($leads_id > 0) {
      $leadsObj->id = $leads_id;
      $rsLeads = $leadsObj->get_leads_details();  
      foreach ($rsLeads[0] as $K => $V) {
          $$K = $V;
      }   
      $btnName = $title = 'Edit ';
  } ?>
<script>
    tinymce.remove();
    tinymce.init();
</script>
<style>
    .mce-panel {
        width: 99%;
    }
</style>
<div class="col-12">
    <div class="card-header">
        <h5><?php echo $btnName ?> Leads</h5>
        <a href="javascript:void(0);" onclick="hide_leads_details()" style="font-size:16px;"
            class="right-float label label-danger"> <i class="feather icon-x">Cancel</i></a>
    </div>
    <div class="card-block">
        <form action="javascript:void(0);" id="leads_forms">
            <input type="hidden" value="add_edit_leads" name="act">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id']; ?>">

            <div class="row">
                <div class="col-sm-3 col-lg-3">
                    <label class="col-form-label">First Name</label>
                    <div class="input-group input-group-inverse">
                        <input type="text" class="form-control" placeholder="Enter First Name" name="first_name"
                            value="<?php echo $first_name; ?>">
                    </div>
                </div>
                <div class="col-sm-3 col-lg-3">
                    <label class="col-form-label">Last Name</label>
                    <div class="input-group input-group-inverse">
                        <input type="text" class="form-control" placeholder="Enter Last Name" name="last_name" value="<?php echo $last_name; ?>">
                    </div>
                </div>
                <div class="col-sm-3 col-lg-6">
                    <label class="col-form-label">Company Name</label>
                    <div class="input-group input-group-inverse">
                        <input type="text" class="form-control" placeholder="Enter Company Name" name="company_name" value="<?php echo $company_name; ?>">
                    </div>
                </div>
                <div class="col-sm-3 col-lg-3">
                    <label class="col-form-label">Website</label>
                    <div class="input-group input-group-inverse">
                        <input type="text" class="form-control" placeholder="Enter Company Website" name="company_website" value="<?php echo $company_website; ?>">
                    </div>
                </div>

                <div class="col-sm-3 col-lg-3">
                    <label class="col-form-label">Phone Number</label>
                    <div class="input-group input-group-inverse">
                        <input type="text" class="form-control mob_no" placeholder="Enter Phone Number" data-mask="999-999-9999" name="phone_number" value="<?php echo $phone_number; ?>">
                    </div>
                </div>
                <div class="col-sm-3 col-lg-3">
                    <label class="col-form-label">Email Address</label>
                    <div class="input-group input-group-inverse">
                        <input type="email" class="form-control" placeholder="Enter Email Address" name="email_address" value="<?php echo $email_address; ?>">
                    </div>
                </div>
                <!-- <div class="col-sm-3 col-lg-3">
                    <label class="col-form-label">Address</label>
                    <div class="input-group input-group-inverse">
                        <input type="text" class="form-control" placeholder="Enter Address" name="address"
                            value="<?php// echo $address; ?>">
                    </div>
                </div> -->
                <div class="col-sm-3 col-lg-3">
                    <label class="col-form-label">Country</label>
                    <div class="input-group input-group-inverse">
                        <input type="text" class="form-control" placeholder="Enter Country" name="country"
                            value="<?php echo $country; ?>">
                    </div>
                </div>
                <div class="col-sm-3 col-lg-3">
                    <label class="col-form-label">City</label>
                    <div class="input-group input-group-inverse">
                        <input type="text" class="form-control" placeholder="Enter City" name="city"
                            value="<?php echo $city; ?>">
                    </div>
                </div>
                <div class="col-sm-3 col-lg-3">
                    <label class="col-form-label">State</label>
                    <div class="input-group input-group-inverse">
                        <input type="text" class="form-control" placeholder="Enter State" name="state"
                            value="<?php echo $state; ?>">
                    </div>
                </div>
                <div class="col-sm-3 col-lg-3">
                    <label class="col-form-label">Zip Code</label>
                    <div class="input-group input-group-inverse">
                        <input type="text" class="form-control pincode" data-mask="999999" placeholder="Enter Zipcode"
                            name="zipcode" value="<?php echo $zipcode; ?>">
                    </div>
                </div>
                <div class="col-sm-3 col-lg-3">
                    <label class="col-form-label">Enquiry Type</label>
                    <select class="form-control" name="enquiry_type">
                        <option value="">Select Option</option>
                        <option <?php if ($enquiry_type == 'call') {echo 'selected';} ?> value="call">Call</option>
                        <option <?php if ($enquiry_type == 'email') {echo 'selected';} ?> value="email">E-Mail</option>
                        <option <?php if ($enquiry_type == 'reference') {echo 'selected';} ?> value="reference">Reference</option>
                        <option <?php if ($enquiry_type == 'others') {echo 'selected';} ?> value="others">Others</option>
                        <option <?php if ($enquiry_type == 'web') {echo 'selected';} ?> value="web">Web</option>
                    </select>
                </div>
                <h5 class="col-sm-12 col-lg-12">Select Categoryies And Services</h5>
                <hr>
                <?php                         
                        $categoryObj = new Categories;
                        $categoryObj->id = '';
                        $rsCategory = $categoryObj->get_category();   
                        foreach ($rsCategory as $K => $V) { 
                            $rand = rand();
                        ?>
                <div class="col-sm-3 col-lg-3">
                    <!-- <div class="checkbox-zoom zoom-primary"> -->
                    <label>
                        <?php  $ecategories = explode(',',$enquiry_categories_id);  ?>
                        <input type="checkbox" <?php  if (in_array($V->id, $ecategories)){ echo 'checked';  } ?> value="<?php echo $V->id; ?>" id="<?php echo $rand ?>" onclick="get_allservices(this.id)" name="enquiry_categories_id[]">
                        <span class="cr">
                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                        </span>
                        <strong><span class="text-primary"><?php echo $V->category_name; ?></span></strong>
                    </label>
                    <!-- </div> -->
                    <?php  $eservices = explode(',',$enquiry_services_id); ?>
                    <ul id="category_services_<?php echo $rand ?>" style="display:none">
                        <?php  $categoryObj->id = $V->id;
                               $rsService = $categoryObj->get_category_service(); 
                               foreach ($rsService as $key => $value) {
                        ?>
                        <script> get_allservices(<?php echo $rand ?>); </script>
                            <li class="text-muted"><input type="checkbox" name="enquiry_services_id[]"  <?php  if (in_array($value->id, $eservices)){ echo 'checked';  } ?> value="<?php echo $value->id; ?>">&nbsp;&nbsp;<?php echo $value->service_name; ?></li>
                            <br> 
                        <?php } ?>
                    </ul>                                                                 
                </div>
                <?php } ?>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <label class="col-form-label">Description</label>
                    <div class="input-group input-group-inverse">
                        <textarea rows="5" cols="5" class="form-control" placeholder="Enter Description" id="description" name="description"><?php echo $description; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row grid-layout">
                <input type="submit" class="btn btn-grd-primary col-sm-3 ml-md-auto" value="Submit">
            </div>
        </form>
    </div>
</div>
<script src="<?php echo ADMIN_JS ?>/tinymce/wysiwyg-editor.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_JS ?>/form-masking/form-mask.js"></script>
<script>

$("form#leads_forms").submit(function() {
    tinyMCE.triggerSave();
    var param = $('form#leads_forms').serialize();
    $('.preloader').show();
    $.ajax({
        url: '<?php echo LEADS_DIR ?>/leads_ajax.php',
        type: 'POST',
        data: param,
        success: function(data) {
            var records = JSON.parse(data);
            $('.preloader').hide();
            if (records.result == 'Success') {
                hide_leads_details();
                leads_main_table();
                leads_statistics();
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