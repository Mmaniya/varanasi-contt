
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

function notify(from, align, icon, type, animIn, animOut, data) {
    $.growl({
        icon: icon,
        // title: 'Bootstrap Growl ',
        message: data,
        url: ''
    }, {
        element: 'body',
        type: type,
        allow_dismiss: true,
        placement: {
            from: from,
            align: align
        },
        offset: {
            x: 30,
            y: 30
        },
        spacing: 10,
        z_index: 999999,
        delay: 2500,
        timer: 1000,
        url_target: '_blank',
        mouse_over: false,
        animate: {
            enter: animIn,
            exit: animOut
        },
        icon_type: 'class',
        template: '<div data-growl="container" class="alert" role="alert">' +
            '<button type="button" class="close" data-growl="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '<span class="sr-only">Close</span>' +
            '</button>' +
            '<span data-growl="icon"></span>' +
            '<span data-growl="title"></span>' +
            '<span data-growl="message"></span>' +
            '<a href="#" data-growl="url"></a>' +
            '</div>'
    });
};

