<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$action = $_POST['act'];
$clientsObj = new Clients; ?>

<?php if($action =='clients_statistics'){ ?>
    <div class ="row">
        <div class="col-md-6 col-xl-4 cursor">
            <div class="card widget-statstic-card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5>Clients</h5>
                        <!-- <p class="p-t-10 m-b-0 text-c-yellow">Active Clients</p> -->
                    </div>
                </div>
                <div class="card-block">
                    <i class="feather icon-users st-icon bg-c-yellow"></i>
                    <div class="text-left">
                        <h3 class="d-inline-block">5,456</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 cursor">
            <div class="card widget-statstic-card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5>Unique Visitor</h5>
                        <!-- <p class="p-t-10 m-b-0 text-c-pink">55% From last 28 hours</p> -->
                    </div>
                </div>
                <div class="card-block">
                    <i class="feather icon-users st-icon bg-c-pink txt-lite-color"></i>
                    <div class="text-left">
                        <h3 class="d-inline-block">3,874</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 cursor">
            <div class="card widget-statstic-card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5>Add New Clients</h5>
                        <!-- <p class="p-t-10 m-b-0 text-c-blue">54% From last month</p> -->
                    </div>
                </div>
                <div class="card-block">
                    <i class="feather icon-plus st-icon bg-c-blue"></i>
                    <div class="text-left">
                        <h3 class="d-inline-block">5,456</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>



<?php if($action == 'add_edit_clients'){  
  
  $clients_id = $_POST['clients_id'];
  $btnName = $title = 'Add New';
  if ($clients_id > 0) {
      $clientsObj->id = $clients_id;
      $rsClients = $clientsObj->get_clients_details();  
      foreach ($rsClients[0] as $K => $V) {
          $$K = $V;
      }   
      $btnName = $title = 'Edit ';
  } ?>
  <script>  tinymce.remove(); tinymce.init(); </script>
  <style> .mce-panel {   width: 99%; }</style>
  <div class="col-12 card">
        <div class="card-header">
            <h5><?php echo $btnName ?> Clients</h5>            
            <a href="javascript:void(0);" onclick="hide_clients_details()" style="font-size:16px;" class="right-float label label-danger"> <i class="feather icon-x">Cancel</i></a>
        </div>
        <div class="card-block">                   
            <form action="javascript:void(0);" id="clients_forms">
                <input type="hidden" value="add_edit_clients" name="act">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id']; ?>">
        
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
                        <div class="col-sm-3 col-lg-3">
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
                                <input type="text" class="form-control mob_no"  data-mask="999-999-9999" placeholder="Enter Phone Number" name="phone_number" value="<?php echo $phone_number; ?>">                                                
                            </div>
                        </div>
                        <div class="col-sm-3 col-lg-3">
                            <label class="col-form-label">Email Address</label>
                            <div class="input-group input-group-inverse">
                                <input type="email" class="form-control" placeholder="Enter Email Address" name="email_address" value="<?php echo $email_address; ?>">
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
                            <label class="col-form-label">Address</label>
                            <div class="input-group input-group-inverse">
                                <input type="text" class="form-control" placeholder="Enter Address" name="address" value="<?php echo $address; ?>">
                            </div>
                        </div>
                    
                        <div class="col-sm-3 col-lg-3">
                            <label class="col-form-label">Country</label>
                            <div class="input-group input-group-inverse">
                                <input type="text" class="form-control" placeholder="Enter Country" name="country" value="<?php echo $country; ?>">
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
                                <input type="text" class="form-control pincode" data-mask="999999" placeholder="Enter Zipcode" name="zipcode" value="<?php echo $zipcode; ?>">
                            </div>
                        </div>                                                                                                                                                                                                                  
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

      $("form#clients_forms").submit(function() {
          tinyMCE.triggerSave();
          var param = $('form#clients_forms').serialize();
          $.ajax({
              url: '<?php echo CLIENTS_DIR ?>/clients_ajax.php',
              type: 'POST',
              data: param,     
              success: function(data) {
                  var records = JSON.parse(data);
                  if (records.result == 'Success') {                 
                      hide_clients_details();
                      clients_main_table();
                      clients_statistics();
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

