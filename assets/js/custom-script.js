/*==============ADMIN SCRIPT===============*/

/**************************
 * User Sign in & Sign Up  *
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
 * Categorys & Service    *
 **************************/
$(function() {

    var url = $(location).attr("href");
    var filename = url.split('http://192.168.0.109/mms/aPanel/')[1];

    if (filename == 'category/index.php') {
        category_table('');
        category_statistics();
    } else if (filename == 'employee/index.php') {
        employee_main_table();
        employee_statistics();
    } else if (filename == 'clients/index.php') {
        clients_main_table();
        clients_statistics();
    } else if (filename == 'leads/index.php') {
        leads_main_table();
        leads_statistics();
    }

});

/* Category Statistics  Update*/

function category_statistics() {
    param = { 'act': 'category_statistics' };
    ajax({
        a: 'category_form',
        b: $.param(param),
        c: function() {},
        d: function(data) {
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
        c: function() {},
        d: function(data) {
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
        c: function() {},
        d: function(data) {
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
        c: function() {},
        d: function(data) {
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
                c: function() {},
                d: function(data) {
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
                c: function() {},
                d: function(data) {
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
        c: function() {},
        d: function(data) {
            $('#category_statistics').html(data);
        }
    });
}

function category_dashboard(id) {
    param = { 'act': 'category_dashboard', 'id': id };
    ajax({
        a: 'category_table',
        b: $.param(param),
        c: function() {},
        d: function(data) {
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
        c: function() {},
        d: function(data) {
            hide_category_form();
            $('#category_service').removeClass('col-7');
            $('#category_service').addClass('col-12');
            $('#category_service').html(data);
        }
    });
}

function update_category_service(category_id, id) {

    param = { 'act': 'add_edit_service_form', 'category_id': category_id, 'service_id': id, 'page': 'service_page' };
    ajax({
        a: 'category_form',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            hide_category_form();
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
                c: function() {},
                d: function(data) {
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
                c: function() {},
                d: function(data) {
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
        c: function() {},
        d: function(data) {
            hide_category_form();
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
        c: function() {},
        d: function(data) {
            $('#category_statistics').html(data);
        }
    });
}

/* 1.Features */

x = 1;

function add_more_features_fields() {
    html = '<div class="col-sm-6 col-lg-6" id="column_' + x + '">';
    html += '<label class="col-form-label">Features</label>';
    html += '<div class="input-group input-group-inverse"> ';
    html += '<button type="button" class="btn btn-default clone-btn-left delete" onclick="removeRow(' + x + ')"><i class="fa fa-minus"></i></button>';
    html += '<input type="text" class="form-control" placeholder="Enter Features" name="features[]">';
    html += '<button type="button" class="btn btn-primary clone-btn-left clone" onclick="add_more_features_fields()"><i class="fa fa-plus"></i></button>';
    html += '</div>';
    html += '</div>';
    $('#appeded_column').append(html);
    x++;
}

function removeRow(id) {
    if (id == 1) {
        return;
    } else {
        x--;
        $('#column_' + id).remove();
    }

}

function remove_category_service_features(id, key) {
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
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        $('#edit_column_' + key).remove();
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    }
                }
            });
        }
    });
}

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
                c: function() {},
                d: function(data) {
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
                c: function() {},
                d: function(data) {
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

function set_as_featured(id) {
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
                c: function() {},
                d: function(data) {
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

function update_category_service_features(id) {
    param = { 'act': 'update_category_service_features', 'id': id };
    ajax({
        a: 'category_form',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('#update_category_form').show();
            $('#update_category_form').html(data);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
}

/* 2. Faq */

function add_more_faq_fields() {
    param = { 'act': 'add_more_faq' };
    ajax({
        a: 'category_form',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('#appeded_column_faq').append(data);
        }
    });
}

function removeFaq(id) {
    var numItems = $('.item').length;
    if (numItems == 1) {
        return;
    }
    $('#faq_column_' + id).remove();
}

function remove_category_service_faq(id, key) {
    param = { 'act': 'category_service_faq_remove', 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this FAQ?",
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
            var numItems = $('.item').length;
            if (numItems == 1) {
                $('.preloader').hide();
                notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', 'unable to delete this record');
                return;
            } else {
                ajax({
                    a: "category_ajax",
                    b: param,
                    c: function() {},
                    d: function(data) {
                        $('.preloader').hide();
                        var records = JSON.parse(data);
                        if (records.result == 'Success') {
                            $('#faq_column_' + key).remove();
                            x2--;
                            notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                        } else {
                            notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                        }
                    }
                });
            }
        }
    });
}

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
                c: function() {},
                d: function(data) {
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
        text: "You want to delete this FAQ?",
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
                c: function() {},
                d: function(data) {
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

function update_category_service_faq(id) {
    param = { 'act': 'update_category_service_faq', 'id': id };
    ajax({
        a: 'category_form',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('#update_category_form').show();
            $('#update_category_form').html(data);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
}

/* 3.Steps */

function add_more_step_fields() {
    param = { 'act': 'add_more_steps' };
    ajax({
        a: 'category_form',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('#appeded_column_step').append(data);
        }
    });
}

function removeSteps(id) {
    if (id == 1) {
        return;
    }
    $('#step_column_' + id).remove();
}

function remove_category_service_step(id, key) {
    param = { 'act': 'category_service_step_remove', 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this step?",
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
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        $('#step_column_' + key).remove();
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    }
                }
            });
        }
    });
}

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
                c: function() {},
                d: function(data) {
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
        text: "You want to delete this step?",
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
                c: function() {},
                d: function(data) {
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

function update_category_service_steps(id) {
    param = { 'act': 'update_category_service_steps', 'id': id };
    ajax({
        a: 'category_form',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('#update_category_form').show();
            $('#update_category_form').html(data);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
}

/***************************
 * End Categorys & Service *
 ***************************/


/**************************
 *     Employee           *
 **************************/

// Gentral Functions

function generate_password() {
    length = 7;
    var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP1234567890";
    var pass = "";
    for (var x = 0; x < length; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
    $('#password').val(pass);
}

function selectexperience() {
    var exp = $('#exprience').val();
    if (exp == 'E') {
        $('#year_of_exp').show();
    } else {
        $('#year_of_exp').hide();
    }
}

function reached_by_mms(reachedby) {
    if (reachedby == 'reference') {
        $('.reference').show();
        $('.consultancy').hide();

    } else if (reachedby == 'consultancy') {

        $('.consultancy').show();
        $('.reference').hide();
        $('.employee').hide();
        $('.referedothers').hide();
    } else {
        $('.consultancy').hide();
        $('.reference').hide();
        $('.employee').hide();
        $('.referedothers').hide();
    }
}

function reference(referedby) {

    if (referedby == 'Y') {
        $('.employee').show();
        $('.referedothers').hide();
    } else if (referedby == 'N') {
        $('.employee').hide();
        $('.referedothers').show();
    } else {
        $('.employee').hide();
        $('.referedothers').hide();
    }
}

function hide_employee_form() {
    $('#employee_form').hide();
}

function hide_emp_details() {
    $('.ajaxResponce').show();
    $('.emp_form').hide();
}

function employee_statistics() {
    $('.preloader').show();
    param = { 'act': 'employee_statistics' };
    ajax({
        a: 'employee_form',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#employee_statistics').html(data);
        }
    });
}

//  employee Role table
function employee_role() {
    $('.preloader').show();
    hide_emp_details();
    hide_employee_form();
    param = { 'act': 'employee_role_table' };
    ajax({
        a: 'employee_table',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#employee_table').show();
            $('#employee_table').html(data);
        }
    });
}

function add_edit_role(id) {
    param = { 'act': 'employee_role', 'id': id };
    $('.preloader').show();
    ajax({
        a: 'employee_form',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#employee_form').show();
            $('#employee_form').html(data);
        }
    });
}

function delete_employee_role(id) {
    param = { 'act': 'remove_employee_role', 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this role?",
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
                a: "employee_ajax",
                b: param,
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        employee_role();
                        employee_statistics();
                        hide_employee_form();
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    }
                }
            });
        }
    });
}

function statusRole(id) {
    var ischecked = $('.status_update_' + id).is(':checked');
    if (!ischecked) { status = 'I'; } else { status = 'A'; }
    param = { 'act': 'role_status_change', 'status': status, 'id': id };
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
                a: "employee_ajax",
                b: param,
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        employee_role();
                        employee_statistics();
                        hide_employee_form();
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

// Employee  table
function employee_main_table() {
    $('.preloader').show();
    hide_emp_details();
    hide_employee_form();
    param = { 'act': 'employee_main_table' };
    ajax({
        a: 'employee_table',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#employee_table').show();
            $('#employee_table').html(data);
        }
    });
}

function add_edit_employee(id) {
    $('.preloader').show();
    $('.emp_form').show();
    param = { 'act': 'add_edit_employee', 'emp_id': id };
    ajax({
        a: 'employee_form',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('.ajaxResponce').hide();
            $('#employee_details').html(data);
        }
    });
}

function delete_employee(id) {
    param = { 'act': 'remove_employee', 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this employee?",
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
                a: "employee_ajax",
                b: param,
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        employee_main_table();
                        employee_statistics();
                        hide_employee_form();
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    }
                }
            });
        }
    });
}

function statusEmployee(id) {
    var ischecked = $('.status_update_' + id).is(':checked');
    if (!ischecked) { status = 'I'; } else { status = 'A'; }
    param = { 'act': 'employee_status_change', 'status': status, 'id': id };
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
                a: "employee_ajax",
                b: param,
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        employee_main_table();
                        employee_statistics();
                        hide_employee_form();
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

function view_employee(id) {
    hide_emp_details();
    $('.preloader').show();
    $('.emp_form').show();
    param = { 'act': 'view_employee', 'emp_id': id };
    ajax({
        a: 'employee_form',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#employee_details').hide();
            $('#employee_form').show();
            $('#employee_form').html(data);
        }
    });
}

/**************************
 *   End  Employee         *
 **************************/

/**************************
 *     Leads               *
 **************************/

function hide_leads_form() {
    $('#leads_form').hide();
}

function hide_leads_details() {
    $('.ajaxResponce').show();
    $('.leads_forms').hide();
}

function leads_statistics() {
    $('.preloader').show();
    param = { 'act': 'leads_statistics' };
    ajax({
        a: 'leads_form',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#leads_statistics').html(data);
        }
    });
}

function leads_main_table() {
    $('.preloader').show();
    hide_leads_details();
    hide_leads_form();
    param = { 'act': 'leads_main_table' };
    ajax({
        a: 'leads_table',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#leads_table').show();
            $('#leads_table').html(data);
        }
    });
}

function add_edit_leads(id) {
    $('.preloader').show();
    $('.leads_forms').show();
    param = { 'act': 'add_edit_leads', 'leads_id': id };
    ajax({
        a: 'leads_form',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('.ajaxResponce').hide();
            $('#leads_details').html(data);
        }
    });
}

function delete_leads(id) {
    param = { 'act': 'remove_leads', 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this leads?",
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
                a: "leads_ajax",
                b: param,
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        hide_leads_details();
                        leads_main_table();
                        leads_statistics();
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    }
                }
            });
        }
    });
}

function statusLeads(id) {
    var ischecked = $('.status_update_' + id).is(':checked');
    if (!ischecked) { status = 'I'; } else { status = 'A'; }
    param = { 'act': 'leads_status_change', 'status': status, 'id': id };
    Swal.fire({
        title: "Are you sure",
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
                a: "leads_ajax",
                b: param,
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        leads_main_table();
                        leads_statistics();
                        hide_leads_form();
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

function get_allservices(id) {

    var checkBox = document.getElementById(id);
    var text = document.getElementById('category_services_' + id);
    if (checkBox.checked == true) {
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }

}

/**************************
 *   End  Leads            *
 **************************/


/**************************
 *     Cleints             *
 **************************/

function hide_clients_form() {
    $('#clients_form').hide();
}

function hide_clients_details() {
    $('.ajaxResponce').show();
    $('.clients_form').hide();
}

function clients_statistics() {
    $('.preloader').show();
    param = { 'act': 'clients_statistics' };
    ajax({
        a: 'clients_form',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#clients_statistics').html(data);
        }
    });
}

function clients_main_table() {
    $('.preloader').show();
    hide_clients_details();
    hide_clients_form();
    param = { 'act': 'clients_main_table' };
    ajax({
        a: 'clients_table',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#clients_table').show();
            $('#clients_table').html(data);
        }
    });
}

function add_edit_clients(id) {
    $('.preloader').show();
    $('.clients_form').show();
    param = { 'act': 'add_edit_clients', 'clients_id': id };
    ajax({
        a: 'clients_form',
        b: $.param(param),
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('.ajaxResponce').hide();
            $('#clients_details').html(data);
        }
    });
}

function delete_clients(id) {
    param = { 'act': 'remove_clients', 'id': id };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this clients?",
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
                a: "clients_ajax",
                b: param,
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        hide_clients_details();
                        clients_main_table();
                        clients_statistics();
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    }
                }
            });
        }
    });
}

function statusClients(id) {
    var ischecked = $('.status_update_' + id).is(':checked');
    if (!ischecked) { status = 'I'; } else { status = 'A'; }
    param = { 'act': 'clients_status_change', 'status': status, 'id': id };
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
                a: "clients_ajax",
                b: param,
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        clients_main_table();
                        clients_statistics();
                        hide_clients_form();
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

/**************************
 *   End  Cleints          *
 **************************/