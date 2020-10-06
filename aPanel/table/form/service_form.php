<?php require ("../../../includes.php");  ?>


<?php  if($_POST['act'] == 'add_edit_service_category_form'){  
        $categoryId = $_POST['id'];
        $btnName = $title = 'Add New';
        $joined_date ='';
        if($categoryId>0) { 
            $param = array('tableName'=>TBL_SERVICE_CATEGORIES,'fields'=>array('*'),'condition'=>array('id'=>$categoryId.'-INT'),'showSql'=>'N',);
            $rsCategory = Table::getData($param);
            foreach($rsCategory as $K=>$V)  $$K=$V;
            $btnName = $title = 'Edit ';	 
        } ?>

            <div class="card-header bg-c-lite-green">
                <h5><?php echo $btnName ?> Service Category Form</h5>
                <!-- <a href="javascript:void(0);" onclick="close_service_category()" class="btn btn-success right-float"><i class="icofont icofont-document-search">View Table</i></a> -->
            </div>
            <div class="card-block">
                <form action="javascript:void(0);" id="service_category">
                    <input type="hidden" value="<?php echo SERVICE_CATEGORIES ?>" name="act">
                    <input type="hidden"  name="id" value="<?php echo $id;?>">
                    <input type="hidden"  name="access_level" value="<?php echo $_SESSION['access_level']; ?>">

                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Category Name</label>
                            <div class="input-group input-group-inverse">
                                
                                <input type="text" class="form-control" placeholder="Enter Category Name" required name="category_name" value="<?php echo $category_name;?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Category Abbr</label>
                            <div class="input-group input-group-inverse">
                                
                                <input type="text" class="form-control" placeholder="Enter Category Abbr" required name="category_abbr" value="<?php echo $category_abbr;?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Category Description</label>
                            <div class="input-group input-group-inverse">
                                
                                <textarea rows="5" cols="5" class="form-control" placeholder="Enter Category Description"  required name="category_description"><?php echo $category_description;?></textarea>
                            </div>
                        </div>
                    </div>
                             
                    <div class="row m-b-20">
                        <!-- <div class="ml-md-auto"> -->
                            <input type="reset" class="btn btn-grd-warning col-4  offset-2">
                            <input type="submit" class="btn btn-grd-success col-4 offset-1"  id="pnotify-callbacks" value="Submit">   
                        <!-- </div>                                -->
                    </div>            
                </form>
            </div>
            <script>
            $("form#service_category").submit(function () {
                var formData = $('form#service_category').serialize();
                ajax({
                    a:"admin_ajax",
                    b:formData,
                    c:function(){},
                    d:function(data){
                        var records = JSON.parse(data);
                        if(records.result == 'Success'){
                            toastr.success('<h5>'+records.data+'</h5>');
                            $('#service_category_form').hide();
                        }
                    }          
                });  
            });
    </script>
<?php } ?>

<?php if($_POST['act'] == 'category_draggable'){ ?>

        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">Category List</h5>

            </div>
            <div class="card-block p-b-0">
                <div class="row">
                <form action="javascript:void(0);" id="category_position" style="width:100%">
                    <input type="hidden" name="act" value="category_position">
                    <div class="col-md-12" id="draggableMultiple">
                     
                            <?php $rsCategory = Service::get_service_category();                                
                            if(count($rsCategory)>0){
                                foreach ($rsCategory as $key=>$value){ ?>
                                    <div class="sortable-moves">
                                        <p><?php echo $value->category_name ?></p> 
                                        <input type="hidden" name="category_id[]" value="<?php echo $value->id ?>">
                                    </div>                     
                            <?php } } ?> 

                        </div>   
                        <input type="submit" class="btn btn-info">                      
                    </form>
                </div>
            </div>
        </div>
        <script>
            $( document ).ready(function() { 
                    Sortable.create(draggableMultiple, {
                    group: 'draggableMultiple',
                    animation: 150
                });
            });
            $("form#service_position").submit(function () {
                var formData = $('form#service_position').serialize();
                ajax({
                    a:"admin_ajax",
                    b:formData,
                    c:function(){},
                    d:function(data){
                        var records = JSON.parse(data);
                        if(records.result == 'Success'){
                            toastr.success('<h5>'+records.data+'</h5>');
                            $('#service_category_form').hide();
                        }
                    }          
                });  
            });

        </script>
<?php } ?>

<?php  if($_POST['act'] == 'add_edit_service_form'){  
        $serviceId = $_POST['id'];
        $btnName = $title = 'Add New';
        $joined_date ='';
        if($serviceId>0) { 
            $param = array('tableName'=>TBL_SERVICE,'fields'=>array('*'),'condition'=>array('id'=>$serviceId.'-INT'),'showSql'=>'N',);
            $rsService = Table::getData($param);
            foreach($rsService as $K=>$V)  $$K=$V;
            $btnName = $title = 'Edit ';	 
        } ?>

            <div class="card-header bg-c-lite-green">
                <h5><?php echo $btnName ?> Service Form</h5>
                <!-- <a href="javascript:void(0);" onclick="close_service_category()" class="btn btn-success right-float"><i class="icofont icofont-document-search">View Table</i></a> -->
            </div>
            <div class="card-block">
                <form action="javascript:void(0);" id="our_service" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo SERVICES ?>" name="act">
                    <input type="hidden"  name="id" value="<?php echo $id;?>">
                    <input type="hidden"  name="access_level" value="<?php echo $_SESSION['access_level']; ?>">

                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Service Name</label>
                            <div class="input-group input-group-inverse">                                
                                <input type="text" class="form-control" placeholder="Enter Service Name" name="service_name" required value="<?php echo $service_name;?>">
                            </div>
                        </div>
                    </div>            
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Service Images</label>
                            <div class="input-group input-group-inverse">                                
                                <input type="file" class="form-control" name="service_img"  value="<?php echo $service_img;?>">
                            </div>
                        </div>
                        <?php if(!empty($service_img)){ ?>
                        <img src="<?php echo SERVICE_IMGES.$service_img;?>" alt="Service Images" width="100" height="100">
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Service Description</label>
                            <div class="input-group input-group-inverse">                                
                                <textarea rows="5" cols="5" class="form-control"  required name="service_description"><?php echo $service_description;?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Select Category</label>
                            <div class="input-group input-group-inverse">
                                
                                <select  class="form-control" required name="category_id">
                                    <option value="">Select Category</option>  
                                    <?php $rsCategory = Service::get_service_category();                               
                                    if(count($rsCategory)>0){
                                        foreach ($rsCategory as $key=>$value){ ?>
                                            <option value="<?php echo $value->id ?>" <?php if($category_id==$value->id) { echo 'selected'; }?> ><?php echo $value->category_name ?></option>  
                                      <?php  }
                                    }
                                    ?>                          
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Service Payment Type</label>
                            <div class="input-group input-group-inverse">
                                
                                <select  class="form-control" required name="service_payment_type" onchange="service_payment_type(this.value)">
                                    <option value="onetime" <?php if($service_payment_type=='onetime') { echo 'selected'; }?>>One Time</option> 
                                    <option value="recurring" <?php if($service_payment_type=='recurring') { echo 'selected'; }?>>Recurring</option>                                                     
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id='recurring_period' style="display:none">
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Recurring Period</label>
                            <div class="input-group input-group-inverse">
                                
                                <input type="text" class="form-control" placeholder="Recurring Period" name="if_recurring_period" value="<?php echo $if_recurring_period;?>">
                            </div>
                        </div>
                    </div> 
                    <div class="row" id="recurring_type" style="display:none">
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Service Name</label>
                            <div class="input-group input-group-inverse">
                                
                                <select class="form-control" name="recurring_type">
                                    <option value="weekly"  <?php if($recurring_type=='weekly') { echo 'selected'; }?> >Weekly</option> 
                                    <option value="bi_weekly" <?php if($recurring_type=='bi_weekly') { echo 'selected'; }?> >Bi Weekly</option>
                                    <option value="monthly" <?php if($recurring_type=='monthly') { echo 'selected'; }?> >Monthly</option>                                                     
                                    <option value="yearly" <?php if($recurring_type=='yearly') { echo 'selected'; }?> >Yearly</option>                                                                                                          
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="row" >
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Service Price	</label>
                            <div class="input-group input-group-inverse">
                                
                                <input type="number" class="form-control" placeholder="Service Price" name="service_price" value="<?php echo $service_price;?>">
                            </div>
                        </div>
                    </div> 
                    <div class="row" >
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Service Delivery Time</label>
                            <div class="input-group input-group-inverse">
                                
                                <input type="number" class="form-control" placeholder="Service Delivery Time" name="service_delivery_time" value="<?php echo $service_delivery_time;?>">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Service Delivery Type</label>
                            <div class="input-group input-group-inverse">
                                
                                <select class="form-control" name="service_delivery_type">
                                    <option value="day" <?php if($service_delivery_type=='day') { echo 'selected'; }?> >Day</option> 
                                    <option value="week" <?php if($service_delivery_type=='week') { echo 'selected'; }?> >Week</option>
                                    <option value="month" <?php if($service_delivery_type=='month') { echo 'selected'; }?> >Month</option>                                                     
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="row" >
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Service Questionnaire Complete Days</label>
                            <div class="input-group input-group-inverse">
                                
                                <input type="text" class="form-control" placeholder="Service Questionnaire Complete Days" name="service_questionnaire_complete_days" value="<?php echo $service_questionnaire_complete_days;?>">
                            </div>
                        </div>
                    </div> 
                             
                    <div class="row m-b-20">
                        <!-- <div class="ml-md-auto"> -->
                            <input type="reset" class="btn btn-grd-warning col-4  offset-2">
                            <input type="submit" class="btn btn-grd-success col-4 offset-1"  id="pnotify-callbacks" value="Submit">   
                        <!-- </div>                                -->
                    </div>            
                </form>
            </div>
            <script>
            $("form#our_service").submit(function () {
                // var formData = $('form#our_service').serialize();
                var formData = new FormData(this);
                $.ajax({
                    url: 'admin_ajax.php',
                    type: 'POST',
                    data: formData,                  
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data){
                        var records = JSON.parse(data);
                        if(records.result == 'Success'){
                            toastr.success('<h5>'+records.data+'</h5>');
                            $('#service_form').hide();
                        }
                    }          
                });  
            });
    </script>
<?php } ?>

<?php if($_POST['act'] == 'service_draggable'){ ?>

    <div class="card">
        <div class="card-header">
            <h5 class="card-header-text">Service List</h5>

        </div>
        <div class="card-block p-b-0">
            <div class="row">
            <form action="javascript:void(0);" id="service_position" style="width:100%">
                <input type="hidden" name="act" value="service_position">
                <div class="col-md-12" id="draggableMultiple">
                
                        <?php $rsCategory = Service::get_service();                                
                        if(count($rsCategory)>0){
                            foreach ($rsCategory as $key=>$value){ ?>
                                <div class="sortable-moves">
                                    <p><?php echo $value->service_name ?></p> 
                                    <input type="hidden" name="service_id[]" value="<?php echo $value->id ?>">
                                </div>                     
                        <?php } } ?> 

                    </div>   
                    <input type="submit" class="btn btn-info">                      
                </form>
            </div>
        </div>
    </div>
    <script>
        $( document ).ready(function() { 
                Sortable.create(draggableMultiple, {
                group: 'draggableMultiple',
                animation: 150
            });
        });
        $("form#service_position").submit(function () {
            var formData = $('form#service_position').serialize();
            ajax({
                a:"admin_ajax",
                b:formData,
                c:function(){},
                d:function(data){
                    var records = JSON.parse(data);
                    if(records.result == 'Success'){
                        toastr.success('<h5>'+records.data+'</h5>');
                        $('#service_form').hide();
                    }
                }          
            });  
        });

    </script>
<?php } ?>