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
        a: 'service_form',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#service_category_form').show();
            $('#service_category_form').html(data);
        }
    });
}

function delete_category(id) {
    $('#service_category_form').hide();
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
    $('#service_category_form').hide();
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
        } else {
            if (ischecked) { $('.status_update_' + id).prop('checked', false); } else {
                $('.status_update_' + id).prop('checked', true);
            }
        }
    });

}

function category_position() {
    param = { 'act': 'category_draggable' };
    $('.preloader').show();
    ajax({
        a: "service_form",
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
        a: 'service_form',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#service_form').show();
            $('#service_form').html(data);
        }
    });
}

function delete_service(id) {
    $('#service_form').hide();
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
    $('#service_form').hide();
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
        } else {
            if (ischecked) { $('.status_update_' + id).prop('checked', false); } else {
                $('.status_update_' + id).prop('checked', true);
            }
        }
    });
}

function service_position() {
    param = { 'act': 'service_draggable' };
    $('.preloader').show();
    ajax({
        a: "service_form",
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

function search_services(value) {

    if (value == 'service_name') {
        $('#search_box').show();
        $('#serach_type').hide(); $('#service_status').hide();
    } else if (value == 'category') {
        $('#serach_type').show();
        $('#search_box').hide();
        $('#service_status').hide();
    } else if (value == 'status') {
        $('#serach_type').hide();
        $('#search_box').hide();
        $('#service_status').show();
    }

    else if (value == 'show_all') {
        $('#serach_type').hide();
        $('#search_box').hide();
        $('#service_status').hide();
        all_service_category()
    } else {
        $('#serach_type').hide();
        $('#search_box').hide();
        $('#service_status').hide();
        all_service_category();
    }
}


function all_service_category() {

    param = { 'act': 'filter_service_category', 'filter_type': '' };
    $('.preloader').show();
    ajax({
        a: "admin_ajax",
        b: param,
        c: function () { },
        d: function (data) {
            $('.preloader').hide();
            $('.service_body').html(data);
        }
    });
}

function filter_service() {
    err = 0;

    var filter_type = $('#filter_type').val();

    if ($('#filter_type').val() == '') { err = 1; $('#filter_type').addClass('error_class'); } else {
        $('#filter_type').removeClass('error_class');
    }

    if (filter_type == 'service_name') {
        if ($('#filter_text').val() == '') { err = 1; $('#filter_text').addClass('error_class'); } else {
            $('#filter_text').removeClass('error_class');
        }
    }

    if (filter_type == 'category') {
        if ($('#filter_category').val() == '') { err = 1; $('#filter_category').addClass('error_class'); } else {
            $('#filter_category').removeClass('error_class');
        }
    }

    if (filter_type == 'status') {
        if ($('#filter_status').val() == '') { err = 1; $('#filter_status').addClass('error_class'); } else {
            $('#filter_status').removeClass('error_class');
        }
    }

    filter_text = $('#filter_text').val();
    filter_category = $('#filter_category').val();
    filter_status = $('#filter_status').val();

    if (err == 0) {
        param = { 'act': 'filter_service_category', 'filter_type': filter_type, 'filter_category': filter_category, 'filter_status': filter_status, 'filter_text': filter_text };
        $('.preloader').show();
        ajax({
            a: "admin_ajax",
            b: param,
            c: function () { },
            d: function (data) {
                $('.preloader').hide();
                $('.service_body').html(data);
            }
        });
    }
}