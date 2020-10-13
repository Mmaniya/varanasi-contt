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
    add_edit_employee();
});

function category_table(status){
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

function category_statistics(){    

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

function hide_category_form() {
    $('#category_form').hide();
    $('#update_category_form').hide();
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

function view_category(id){
    $('#category_service').removeClass('col-12');
    $('#category_service').addClass('col-7');  
    hide_category_form();
    category_breadcrumb(id);
    category_dashboard(id);
}

function category_breadcrumb(id) {

    param = { 'act': 'view_category_breadcrumb', 'id':id };
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
    param = { 'act': 'category_dashboard','id':id };
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

function add_edit_category_service(category_id, id){

    param = { 'act': 'add_edit_service_form', 'category_id': category_id ,'service_id':id };
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

function statuscategoryService(id,cid){
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

function delete_category_service(category_id,id) {
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

function view_category_service(id){
    category_service_breadcrumb(id);
    param = { 'act': 'category_service', 'id': id };
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

function category_service_breadcrumb(id) {
    param = { 'act': 'category_service_breadcrumb', 'id': id };
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

// function features_position(service_id) {
//     param = { 'act': 'service_category_draggable', 'service_id': service_id };
//     $('.preloader').show();
//     ajax({
//         a: "service_form",
//         b: param,
//         c: function () { },
//         d: function (data) {
//             $('.preloader').hide();
//             $('#service_category_table').show();
//             $('#service_category_table').html(data);
//         }
//     });
// }

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
 *      Service           *
 **************************/

// function add_edit_service(id) {  
//     param = { 'act': 'add_edit_service_form', 'id': id };
//     ajax({
//         a: 'service_form',
//         b: $.param(param),
//         c: function () { },
//         d: function (data) {
//             $('#service_form').show();
//             $('#service_form').html(data); 		

//            $('#service_category_form').html(data);			
//         }
//     });
// }

// function delete_service(id) {
//     $('#service_form').hide();
//     param = { 'act': 'service_remove', 'id': id };
//     Swal.fire({
//         title: '',
//         text: "Are you sure want to delete this record?",
//         icon: 'danger',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes!'
//     }).then((result) => {
//         if (result.value) {
//             $('.preloader').show();
//             ajax({
//                 a: "service_ajax",
//                 b: param,
//                 c: function () { },
//                 d: function (data) {
//                     $('.preloader').hide();
//                     var records = JSON.parse(data);
//                     if (records.result == 'Success') {
//                         // toastr.success('<h5>' + records.data + '</h5>');
//                         $('.row_id_' + id).remove();
//                         notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
//                     } else {
//                         notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
//                     }      
//                 }
//             });
//         }
//     });
// }

// function statusService(id) {
//     $('#service_form').hide();
//     var ischecked = $('.status_update_' + id).is(':checked');
//     if (!ischecked) { status = 'I'; } else { status = 'A'; }
//     param = { 'act': 'service_status_change', 'status': status, 'id': id };
//     Swal.fire({
//         title: '',
//         text: "Are you sure want to change status?",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes!'
//     }).then((result) => {
//         if (result.value) {
//             $('.preloader').show();
//             ajax({
//                 a: "service_ajax",
//                 b: param,
//                 c: function () { },
//                 d: function (data) {
//                     $('.preloader').hide();
//                     var records = JSON.parse(data);
//                     if (records.result == 'Success') {
//                         // toastr.success('<h5>' + records.data + '</h5>');
//                         notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
//                     } else {
//                         notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
//                     }      
//                 }
//             });
//         } else {
//             if (ischecked) { $('.status_update_' + id).prop('checked', false); } else {
//                 $('.status_update_' + id).prop('checked', true);
//             }
//         }
//     });
// }

// // function service_position() {
// //     param = { 'act': 'service_draggable' };
// //     $('.preloader').show();
// //     ajax({
// //         a: "service_form",
// //         b: param,
// //         c: function () { },
// //         d: function (data) {
// //             $('.preloader').hide();
// //             $('#service_form').show();
// //             $('#service_form').html(data);
			
// // 			$('#service_category_form').show();
// //             $('#service_category_form').html(data);
			
// //         }
// //     });
// // }

// function service_category_position(category_id) {
//     param = { 'act': 'service_category_draggable','category_id':category_id };
//     $('.preloader').show();
//     ajax({
//         a: "service_form",
//         b: param,
//         c: function () { },
//         d: function (data) {
//             $('.preloader').hide();
//             $('#service_form').show();
//             $('#service_form').html(data);			
// 			$('#service_category_form').show();
//             $('#service_category_form').html(data);			
//         }
//     });
// }

// function service_payment(value) {
//     if (value == 'recurring') {  
//         $('.newclass').addClass('col-sm-3 col-lg-3');
//         $('.newclass').removeClass('col-sm-2 col-lg-2'); 
//         $('.recurring_period').show();
//     } else {
//         $('.newclass').removeClass('col-sm-3 col-lg-3');
//         $('.newclass').addClass('col-sm-2 col-lg-2');   
//         $('.recurring_period').hide();
//     }
// }

// function search_services(value) {

//     if (value == 'service_name') {
//         $('#search_box').show();
//         $('#serach_type').hide(); $('#service_status').hide();
//     } else if (value == 'category') {
//         $('#serach_type').show();
//         $('#search_box').hide();
//         $('#service_status').hide();
//     } else if (value == 'status') {
//         $('#serach_type').hide();
//         $('#search_box').hide();
//         $('#service_status').show();
//     }

//     else if (value == 'show_all') {
//         $('#serach_type').hide();
//         $('#search_box').hide();
//         $('#service_status').hide();
//         all_service_category()
//     } else {
//         $('#serach_type').hide();
//         $('#search_box').hide();
//         $('#service_status').hide();
//         all_service_category();
//     }
// }

// function all_service_category() {

//     param = { 'act': 'filter_service_category', 'filter_type': '' };
//     $('.preloader').show();
//     ajax({
//         a: "service_ajax",
//         b: param,
//         c: function () { },
//         d: function (data) {
//             $('.preloader').hide();
//             $('.service_body').html(data);
//         }
//     });
// }

// /*========== Service Filters =============*/

// function filter_service() {
//     err = 0;

//     var filter_type = $('#filter_type').val();

//     if ($('#filter_type').val() == '') { err = 1; $('#filter_type').addClass('error_class'); } else {
//         $('#filter_type').removeClass('error_class');
//     }

//     if (filter_type == 'service_name') {
//         if ($('#filter_text').val() == '') { err = 1; $('#filter_text').addClass('error_class'); } else {
//             $('#filter_text').removeClass('error_class');
//         }
//     }

//     if (filter_type == 'category') {
//         if ($('#filter_category').val() == '') { err = 1; $('#filter_category').addClass('error_class'); } else {
//             $('#filter_category').removeClass('error_class');
//         }
//     }

//     if (filter_type == 'status') {
//         if ($('#filter_status').val() == '') { err = 1; $('#filter_status').addClass('error_class'); } else {
//             $('#filter_status').removeClass('error_class');
//         }
//     }

//     filter_text = $('#filter_text').val();
//     filter_category = $('#filter_category').val();
//     filter_status = $('#filter_status').val();

//     if (err == 0) {
//         param = { 'act': 'filter_service_category', 'filter_type': filter_type, 'filter_category': filter_category, 'filter_status': filter_status, 'filter_text': filter_text };
//         $('.preloader').show();
//         ajax({
//             a: "service_ajax",
//             b: param,
//             c: function () { },
//             d: function (data) {
//                 $('.preloader').hide();
//                 $('.service_body').html(data);
//             }
//         });
//     }
// }

// function close_service(category_id) {
//     $('#service_form').hide();
	
// 	$('#service_category_form').hide();
// 	$('.category_service_table').show();  
// 	category_service_list(category_id);
// }

// function category_service_list(category_id) {   
// 	  paramData = {'act':'show_category_service_list','category_id':category_id};
//           ajax({ 
//             a:'service_table',
//             b:$.param(paramData),
//             c:function(){},
//             d:function(data){  
// 			   $('#service_category_form').show();
// 			   $('#service_category_form').html(data);
// 	    }});         
// }


// /*==========  Service Features =============*/

// function add_service_features(service_id){
//     paramData = { 'act': 'service_features_table', 'service_id': service_id };
//     ajax({
//         a: 'service_table',
//         b: $.param(paramData),
//         c: function () { },
//         d: function (data) {
//             $('#service_form').show();
//             $('#service_form').html(data);
//         }
//     }); 
// }

// function delete_feature(feature_id, service_id ) {
//     paramData = { 'act': 'delete_service_feature', 'feature_id': feature_id };
//     ajax({
//         a: 'service_ajax',
//         b: $.param(paramData),
//         c: function () { },
//         d: function (data) {
//             $('#right_sidebar').hide();
//             $('#right_sidebar').html('');
//             add_service_features(service_id);
//             var records = JSON.parse(data);
//             if (records.result == 'Success') {
//                 // toastr.success('<h5>' + records.data + '</h5>');
//                 $('#service_category_form').hide();
//                 $("#service_category_table").load(location.href + " #service_category_table>*", "");
//                 notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
//             } else {
//                 notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
//             }      
//         }
//     });
// }

// function add_edit_features(service_id, feature_id) {
//     paramData = { 'act': 'service_features_list', 'feature_id': feature_id, 'service_id': service_id };
//     ajax({
//         a: 'service_form',
//         b: $.param(paramData),
//         c: function () { },
//         d: function (data) {
//             $('#service_form').show();
//             $('#service_form').html(data);
//         }
//     });
// }

// function features_position(service_id) {
//     param = { 'act': 'service_category_draggable', 'service_id': service_id };
//     $('.preloader').show();
//     ajax({
//         a: "service_form",
//         b: param,
//         c: function () { },
//         d: function (data) {
//             $('.preloader').hide();
//             $('#service_category_table').show();
//             $('#service_category_table').html(data);
//         }
//     });
// }


// /*==========  Service Faq =============*/

// function add_service_faq(service_id) {
//     paramData = { 'act': 'service_faq_table', 'service_id': service_id };
//     ajax({
//         a: 'service_table',
//         b: $.param(paramData),
//         c: function () { },
//         d: function (data) {
//             $('#service_form').show();
//             $('#service_form').html(data);
//         }
//     });
// }

// function add_edit_faq(service_id, faq_id) {
//     paramData = { 'act': 'service_faq_list', 'faq_id': faq_id, 'service_id': service_id };
//     ajax({
//         a: 'service_form',
//         b: $.param(paramData),
//         c: function () { },
//         d: function (data) {
//             $('#service_form').show();
//             $('#service_form').html(data);
//         }
//     });
// }

// function delete_faq(feature_id, service_id) {
//     paramData = { 'act': 'delete_service_faq', 'feature_id': feature_id };
//     ajax({
//         a: 'service_ajax',
//         b: $.param(paramData),
//         c: function () { },
//         d: function (data) {
//             $('#right_sidebar').hide();
//             $('#right_sidebar').html('');
//             add_service_faq(service_id);
//             var records = JSON.parse(data);
//             if (records.result == 'Success') {
//                 // toastr.success('<h5>' + records.data + '</h5>');
//                 $('#service_category_form').hide();
//                 $("#service_category_table").load(location.href + " #service_category_table>*", "");
//                 notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
//             } else {
//                 notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
//             }      

//         }
//     });
// }

// function faq_position(service_id) {
//     param = { 'act': 'faq_draggable', 'service_id': service_id };
//     $('.preloader').show();
//     ajax({
//         a: "service_form",
//         b: param,
//         c: function () { },
//         d: function (data) {
//             $('.preloader').hide();
//             $('#service_form').show();
//             $('#service_form').html(data);
//         }
//     });

// }

// /**************************
//  *     End  Service       *
//  **************************/