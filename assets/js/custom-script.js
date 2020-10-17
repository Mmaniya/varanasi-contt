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
 *      Categorys         *
 **************************/
$(function () {
    category_table('');
    category_statistics();
    add_edit_employee();   /* optinal  */
});

/* Category Statistics  Update*/

function category_statistics() {
    param = { 'act': 'category_statistics' };
    ajax({
        a: 'category_form',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#category_statistics').html(data);
        }
    });
}

/* Show Category Table */

function category_table(status) {
    param = { 'act': 'category_table', 'status': status };
    ajax({
        a: 'category_table',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#category_table').html(data);
        }
    });
}

/* Add & Edit Category Form Hide Show */

function hide_category_form() {
    $('#category_form').hide();
    $('#update_category_form').hide();
}

/* Add & Edit Category Form */

function add_edit_category(id) {

    param = { 'act': 'add_edit_category_form', 'id': id };
    ajax({
        a: 'category_form',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#category_form').show();
            $('#category_form').html(data);
        }
    });
}

/* Add & Edit Category Form Update */

function update_category_form(id) {

    param = { 'act': 'add_edit_category_form', 'id': id };
    ajax({
        a: 'category_form',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#update_category_form').show();
            $('#update_category_form').html(data);
        }
    });
}

function service_payment(value) {
    if (value == 'recurring') {  
        $('.newclass').addClass('col-sm-3 col-lg-3');
        $('.newclass').removeClass('col-sm-2 col-lg-2'); 
        $('.recurring_period').show();
    } else {
        $('.newclass').removeClass('col-sm-3 col-lg-3');
        $('.newclass').addClass('col-sm-2 col-lg-2');   
        $('.recurring_period').hide();
    }
}

function delete_category(id) {
    param = { 'act': 'category_remove', 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this category? Deleting this category will also delete the releted service?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
        if (result.value) {
            $('.preloader').show();
            ajax({
                a: "category_ajax",
                b: param,
                c: function () { },
                d: function (data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        category_table('');
                        category_statistics();
                        hide_category_form();
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    }
                }
            });
        }
    });
}

function statusCategory(id) {
    var ischecked = $('.status_update_' + id).is(':checked');
    if (!ischecked) { status = 'I'; } else { status = 'A'; }
    param = { 'act': 'category_status_change', 'status': status, 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to change status?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
        if (result.value) {
            $('.preloader').show();
            ajax({
                a: "category_ajax",
                b: param,
                c: function () { },
                d: function (data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        category_table('');
                        category_statistics();
                        hide_category_form();
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
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

function view_category(id) {
    $('#category_service').removeClass('col-12');
    $('#category_service').addClass('col-7');
    hide_category_form();
    category_breadcrumb(id);
    category_dashboard(id);
}

function category_breadcrumb(id) {

    param = { 'act': 'service_breadcrumb', 'id': id };
    ajax({
        a: 'category_form',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#category_statistics').html(data);
        }
    });
}

function category_dashboard(id) {
    param = { 'act': 'category_dashboard', 'id': id };
    ajax({
        a: 'category_table',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#category_table').hide();
            $('#category_service').html(data);
        }
    });
}

function add_edit_category_service(category_id, id) {

    param = { 'act': 'add_edit_service_form', 'category_id': category_id, 'service_id': id };
    ajax({
        a: 'category_form',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#category_service').removeClass('col-7');
            $('#category_service').addClass('col-12');
            $('#category_service').html(data);
        }
    });
}

function update_category_service(category_id, id) {

    param = { 'act': 'add_edit_service_form', 'category_id': category_id, 'service_id': id, 'page':'service_page' };
    ajax({
        a: 'category_form',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#category_service').removeClass('col-7');
            $('#category_service').addClass('col-12');
            $('#category_service').html(data);
        }
    });
}

function statuscategoryService(id, cid) {
    var ischecked = $('.status_update_' + id).is(':checked');
    if (!ischecked) { status = 'I'; } else { status = 'A'; }
    param = { 'act': 'service_status_change', 'status': status, 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to change status?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
        if (result.value) {
            $('.preloader').show();
            ajax({
                a: "category_ajax",
                b: param,
                c: function () { },
                d: function (data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        view_category(cid);
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
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

function delete_category_service(category_id, id) {
    param = { 'act': 'category_service_remove', 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this service?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
        if (result.value) {
            $('.preloader').show();
            ajax({
                a: "category_ajax",
                b: param,
                c: function () { },
                d: function (data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        view_category(category_id);
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    }
                }
            });
        }
    });
}

function view_category_service(id) {
    category_service_breadcrumb(id);
    param = { 'act': 'category_service', 'id': id };
    ajax({
        a: 'category_table',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#category_table').hide();
            $('#category_service').removeClass('col-12');
            $('#category_service').addClass('col-7');
            $('#category_service').html(data);
        }
    });
}

function category_service_breadcrumb(id) {
    param = { 'act': 'service_dashboard', 'id': id };
    ajax({
        a: 'category_form',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#category_statistics').html(data);
        }
    });
}

// Features

function status_service_features(id) {
    var ischecked = $('.status_update_' + id).is(':checked');
    if (!ischecked) { status = 'I'; } else { status = 'A'; }
    param = { 'act': 'features_status_change', 'status': status, 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to change status?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
        if (result.value) {
            $('.preloader').show();
            ajax({
                a: "category_ajax",
                b: param,
                c: function () { },
                d: function (data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
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

function delete_category_service_features(service_id, id) {
    param = { 'act': 'category_service_features_remove', 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this fatures?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
        if (result.value) {
            $('.preloader').show();
            ajax({
                a: "category_ajax",
                b: param,
                c: function () { },
                d: function (data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        view_category_service(service_id);
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    }
                }
            });
        }
    });
}

function set_as_featured(id){
    var ischecked = $('.featured_status_update_' + id).is(':checked');
    if (!ischecked) { status = 'N'; } else { status = 'Y'; } 
    param = { 'act': 'set_asfeatured_status', 'status': status, 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to set as featured.",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
        if (result.value) {
            $('.preloader').show();
            ajax({
                a: "category_ajax",
                b: param,
                c: function () { },
                d: function (data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
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

// Faq

function statusServiceFaq(id) {
    var ischecked = $('.status_update_' + id).is(':checked');
    if (!ischecked) { status = 'I'; } else { status = 'A'; }
    param = { 'act': 'service_faq_status', 'status': status, 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to change status?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
        if (result.value) {
            $('.preloader').show();
            ajax({
                a: "category_ajax",
                b: param,
                c: function () { },
                d: function (data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
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

function delete_category_service_faq(service_id, id) {
    param = { 'act': 'category_service_faq_remove', 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this fatures?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
        if (result.value) {
            $('.preloader').show();
            ajax({
                a: "category_ajax",
                b: param,
                c: function () { },
                d: function (data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        view_category_service(service_id);
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    }
                }
            });
        }
    });
}

// Steps

function statusServiceSteps(id) {
    var ischecked = $('.status_update_' + id).is(':checked');
    if (!ischecked) { status = 'I'; } else { status = 'A'; }
    param = { 'act': 'steps_status_change', 'status': status, 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to change status?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
        if (result.value) {
            $('.preloader').show();
            ajax({
                a: "category_ajax",
                b: param,
                c: function () { },
                d: function (data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
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

function delete_category_service_steps(service_id, id) {
    param = { 'act': 'category_service_step_remove', 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this fatures?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
        if (result.value) {
            $('.preloader').show();
            ajax({
                a: "category_ajax",
                b: param,
                c: function () { },
                d: function (data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        view_category_service(service_id);
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    }
                }
            });
        }
    });
}

/**************************
 *      End Categorys     *
 **************************/

function add_edit_employee() {
    param = { 'act': 'category_table' };
    ajax({
        a: 'employee_table',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            alert('k');
            $('#employee_service').html(data);
        }
    });
}

/**************************
 *      User page           *
 **************************/

