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