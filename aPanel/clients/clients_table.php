<?php define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$action = $_POST['act']; 
$clientsObj = new Clients; ?>

<!-- Clients table -->
<?php if($action == 'clients_main_table'){ ?>
<div class="card-header bg-c-lite-green;">
    <h5>Clients List</h5>
    <a href="javascript:void(0);" style="font-size:16px;" onclick="add_edit_clients('')"
        class="right-float label label-success"> <i class="feather icon-plus"> Add New</i></a>
</div>
<div class="card-block">
    <div class="card-block table-border-style">
        <div class="table-responsive">
            <form action="javascript:void(0);" id="clients_position" style="width:100%">
                <input type="hidden" name="act" value="clients_position">
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

                                $clientsObj->id = '';   
                                $rsClients = $clientsObj->get_clients_details();                           
                                if (count($rsClients) > 0) {
                                    foreach ($rsClients as $key => $value) { ?>

                        <tr class="row_id_<?php echo $value->id; ?>" id="<?php echo $value->id; ?>">
                            <input type="hidden" name="clients_id[]" value="<?php echo $value->id ?>">
                            <th><?php echo $key + 1 ?></th>
                            <td><a href="javascript:void(0);" onclick="view_clients(<?php echo $value->id; ?>)"
                                    class="text-primary"><?php echo $value->first_name.'&nbsp;'.$value->last_name ?></a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" class="label label-info"
                                    onclick="add_edit_clients(<?php echo $value->id; ?>)"><i class="fa fa-edit"
                                        aria-hidden="true"></i>Edit</a>
                                <a href="javascript:void(0);" class="label label-danger"
                                    onclick="delete_clients(<?php echo $value->id; ?>)"><i class="fa fa-trash"
                                        aria-hidden="true"></i>Delete</a>
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="status_update_<?php echo $value->id; ?>"
                                        onchange="statusClients(<?php echo $value->id; ?>)"
                                        <?php echo $statusArr[$value->status]; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr>
                        <?php }} else {?>
                        <tr>
                            <td colspan="5" class="text-center"> No Records Found. Click here to <a
                                    href="javascript:void(0);" onclick="add_edit_clients('')" style="color:#01a9ac">
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
                var param = $('form#clients_position').serialize();
                ajax({
                    a: "clients_ajax",
                    b: param,
                    c: function() {},
                    d: function(data) {
                        var records = JSON.parse(data);
                        clients_main_table();
                        clients_statistics();
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