/*==============ADMIN SCRIPT===============*/

/**************************
 * User Sign in & Sign Up *
 **************************/
function signin_form() {
    $('#formSignInAdmin').css("display", "block");
    $('#formRecoverPws').css("display", "none");
}

function forgetpws_form() {
    $('#formRecoverPws').css("display", "block");
    $('#formSignInAdmin').css("display", "none");
}

/**************************
 *      Side Menu         *
 **************************/
function admin_submenu_employee($submenu) {
    param = { 'act': $submenu };
    ajax({
        a: 'form/emp_form',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#ajaxResponce').html(data);
        }
    });
}
function admin_submenu_service($submenu) {
    param = { 'act': $submenu };
    ajax({
        a: 'form/services_form',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#ajaxResponce').html(data);
            service_category_table();
        }
    });
}



// Data Table
function service_category_table() {
    var dataTable = $('#dt-service-category').DataTable({
        'processing': true,
        "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": ""
        },
        'serverSide': true,
        'serverMethod': 'post',
        "dataSrc": "",
        'ajax': {
            'url': 'admin_datatable.php',
            'data': function (data) {
                data.action = 'service_categorys';
            }
        },
        'columns': [
            { data: 'row' },
            { data: 'category_name' },
            { data: 'action' },
            { data: 'status' },
        ],

    });
}

// form view
// function open_service_category() {
//     // $('#service_category_form').show();
//     // $('#service_category_table').hide();
// }

// function close_service_category() {
//     // $('#service_category_form').hide();
//     // $('#service_category_table').show();
// }