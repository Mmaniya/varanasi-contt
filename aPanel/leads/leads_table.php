<?php define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$action = $_POST['act']; 
$leadsObj = new Leads; ?>

<!-- Leads table -->
<?php if($action == 'leads_main_table'){ ?>
    <div class="card-header bg-c-lite-green;">
        <h5>Leads List</h5>
        <a href="javascript:void(0);" style="font-size:16px;" onclick="add_edit_leads('')"
            class="right-float label label-success"> <i class="feather icon-plus"> Add New</i></a>
    </div>
    <div class="card-block">
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <form action="javascript:void(0);" id="leads_position" style="width:100%">
                    <input type="hidden" name="act" value="leads_position">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th style="text-align:center">Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="draggableClients" class="draggable">
                            <?php  $statusArr = array('A' => 'checked', 'I' => '');  

                                    $leadsObj->id = '';   
                                    $reLeads = $leadsObj->get_leads_details();                           
                                    if (count($reLeads) > 0) {
                                        foreach ($reLeads as $key => $value) { ?>

                            <tr class="row_id_<?php echo $value->id; ?>" id="<?php echo $value->id; ?>">
                                <input type="hidden" name="clients_id[]" value="<?php echo $value->id ?>">
                                <th><?php echo $key + 1 ?></th>
                                <td><a href="javascript:void(0);" onclick="view_clients(<?php echo $value->id; ?>)"
                                        class="text-primary"><?php echo $value->first_name.'&nbsp;'.$value->last_name ?></a>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="label label-info"
                                        onclick="add_edit_leads(<?php echo $value->id; ?>)"><i class="fa fa-edit"
                                            aria-hidden="true"></i>Edit</a>
                                    <a href="javascript:void(0);" class="label label-danger"
                                        onclick="delete_leads(<?php echo $value->id; ?>)"><i class="fa fa-trash"
                                            aria-hidden="true"></i>Delete</a>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="status_update_<?php echo $value->id; ?>"
                                            onchange="statusLeads(<?php echo $value->id; ?>)"
                                            <?php echo $statusArr[$value->status]; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                            </tr>
                            <?php }} else {?>
                            <tr>
                                <td colspan="5" class="text-center"> No Records Found. Click here to <a
                                        href="javascript:void(0);" onclick="add_edit_leads('')" style="color:#01a9ac">
                                        Add New</a> </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            Sortable.create(draggableClients, {
                group: 'draggableClients',
                animation: 150,
                accept: '.sortable-moves',
                onUpdate: function(ui) {
                    var param = $('form#leads_position').serialize();
                    $('.preloader').show();
                    ajax({
                        a: "leads_ajax",
                        b: param,
                        c: function() {},
                        d: function(data) {
                            var records = JSON.parse(data);
                            $('.preloader').hide();
                            leads_main_table();
                            leads_statistics();
                            if (records.result == 'Success') {
                                notify('top', 'right', 'fa fa-check', 'success',
                                    'animated fadeInLeft', 'animated fadeOutLeft', records
                                    .data);
                            } else {
                                notify('top', 'right', 'fa fa-times', 'danger',
                                    'animated fadeInLeft', 'animated fadeOutLeft', records
                                    .data);
                            }
                        }
                    });
                },
            });
        });
    </script>
<?php } ?>