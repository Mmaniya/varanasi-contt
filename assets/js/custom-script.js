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
 * User Sign in & Sign Up *
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