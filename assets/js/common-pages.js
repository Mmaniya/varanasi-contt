// "use strict";
// $(document).ready(function () {
//     // $('.theme-loader').addClass('loaded');
//     $('.theme-loader').animate({
//         'opacity': '0',
//     }, 1200);
//     setTimeout(function () {
//         $('.theme-loader').remove();
//     }, 2000);
//     // $('.pcoded').addClass('loaded');
// });

function ajax(a) {

    if (!a.b) a.b = '';
    if (!a.c) a.c = function () { };
    if (!a.d) a.d = function () { };
    /* return  $.ajax({ */
    return $.ajax({
        url: a.a + '.php',
        data: a.b,
        type: 'POST',
        error: a.c,
        success: a.d
    });
}


