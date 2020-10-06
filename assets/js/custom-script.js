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
        a: 'table/services_table',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#ajaxResponce').html(data);
            // service_category_table();
        }
    });
}



// Data Table
// function service_category_table() {
//     var dataTable = $('#dt-service-category').DataTable({
//         'processing': true,
//         "language": {
//             "lengthMenu": "Display _MENU_ records per page",
//             "zeroRecords": "Nothing found - sorry",
//             "info": "Showing page _PAGE_ of _PAGES_",
//             "infoEmpty": "No records available",
//             "infoFiltered": ""
//         },
//         'serverSide': true,
//         'serverMethod': 'post',
//         "dataSrc": "",
//         'ajax': {
//             'url': 'admin_datatable.php',
//             'data': function (data) {
//                 data.action = 'service_categorys';
//             }
//         },
//         'columns': [
//             { data: 'row' },
//             { data: 'category_name' },
//             { data: 'action' },
//             { data: 'status' },
//         ],

//     });
// }

// function service_category_table() {
//     var dataTable = $('#dt-service').DataTable({
//         'processing': true,
//         "language": {
//             "lengthMenu": "Display _MENU_ records per page",
//             "zeroRecords": "Nothing found - sorry",
//             "info": "Showing page _PAGE_ of _PAGES_",
//             "infoEmpty": "No records available",
//             "infoFiltered": ""
//         },
//         'serverSide': true,
//         'serverMethod': 'post',
//         "dataSrc": "",
//         'ajax': {
//             'url': 'admin_datatable.php',
//             'data': function (data) {
//                 data.action = 'service';
//             }
//         },
//         'columns': [
//             { data: 'row' },
//             { data: 'service_name' },
//             { data: 'service_price' },
//             { data: 'action' },
//             { data: 'status' },
//         ],

//     });
// }



// Service  Category Page

function add_edit_category(id) {
    param = { 'act': 'add_edit_service_category_form', 'id': id };
    ajax({
        a: 'table/form/service_form',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#service_category_form').show();
            $('#service_category_form').html(data);
        }
    });
}

function delete_category(id) {
    param = { 'act': 'category_remove', 'id': id };
    Swal.fire({
        title: '',
        text: "Are you sure want to delete this record?",
        icon: 'danger',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.value) {
            $('.preloader').show();
            ajax({
                a: "admin_ajax",
                b: param,
                c: function () { },
                d: function (data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        toastr.success('<h5>' + records.data + '</h5>');
                        $('.row_id_' + id).remove();
                    }
                }
            });
        }
    });
}

function statusCategory(id) {

    var ischecked = $('.status_update_' + id).is(':checked');
    if (!ischecked) { status = 'I'; } else { status = 'A'; }
    param = { 'act': 'service_category_status_change', 'status': status, 'id': id };
    Swal.fire({
        title: '',
        text: "Are you sure want to change status?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.value) {
            $('.preloader').show();
            ajax({
                a: "admin_ajax",
                b: param,
                c: function () { },
                d: function (data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        toastr.success('<h5>' + records.data + '</h5>');
                    }
                }
            });
        }
    });
}

function category_position() {
    param = { 'act': 'category_draggable' };
    $('.preloader').show();
    ajax({
        a: "table/form/service_form",
        b: param,
        c: function () { },
        d: function (data) {
            $('.preloader').hide();
            $('#service_category_form').show();
            $('#service_category_form').html(data);
        }
    });
    // Swal.fire({
    //     title: 'Are you sure?',
    //     text: "Change the Postion.",
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Yes!'
    // }).then((result) => {
    //     if (result.value) {
    //         $('.preloader').show();
    //         ajax({
    //             a: "table/form/service_form",
    //             b: param,
    //             c: function () { },
    //             d: function (data) {
    //                 $('.preloader').hide();
    //                 $('#service_category_form').show();
    //                 $('#service_category_form').html(data);
    //             }
    //         });
    //     }
    // });
}


// Service Page

function add_edit_service(id) {
    param = { 'act': 'add_edit_service_form', 'id': id };
    ajax({
        a: 'table/form/service_form',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#service_form').show();
            $('#service_form').html(data);
        }
    });
}

function delete_service(id) {
    param = { 'act': 'service_remove', 'id': id };
    Swal.fire({
        title: '',
        text: "Are you sure want to delete this record?",
        icon: 'danger',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.value) {
            $('.preloader').show();
            ajax({
                a: "admin_ajax",
                b: param,
                c: function () { },
                d: function (data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        toastr.success('<h5>' + records.data + '</h5>');
                        $('.row_id_' + id).remove();
                    }
                }
            });
        }
    });
}

function statusService(id) {

    var ischecked = $('.status_update_' + id).is(':checked');
    if (!ischecked) { status = 'I'; } else { status = 'A'; }
    param = { 'act': 'service_status_change', 'status': status, 'id': id };
    Swal.fire({
        title: '',
        text: "Are you sure want to change status?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.value) {
            $('.preloader').show();
            ajax({
                a: "admin_ajax",
                b: param,
                c: function () { },
                d: function (data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        toastr.success('<h5>' + records.data + '</h5>');
                    }
                }
            });
        }
    });
}

function service_position() {
    param = { 'act': 'service_draggable' };
    $('.preloader').show();
    ajax({
        a: "table/form/service_form",
        b: param,
        c: function () { },
        d: function (data) {
            $('.preloader').hide();
            $('#service_form').show();
            $('#service_form').html(data);
        }
    });
    // Swal.fire({
    //     title: 'Are you sure?',
    //     text: "Change the Postion.",
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Yes!'
    // }).then((result) => {
    //     if (result.value) {
    //         $('.preloader').show();
    //         ajax({
    //             a: "table/form/service_form",
    //             b: param,
    //             c: function () { },
    //             d: function (data) {
    //                 $('.preloader').hide();
    //                 $('#service_form').show();
    //                 $('#service_form').html(data);
    //             }
    //         });
    //     }
    // });
}

function service_payment(value) {
    if (value == 'recurring') {
        $('#recurring_period').show();
    } else {
        $('#recurring_period').hide();
    }
}