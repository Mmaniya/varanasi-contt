function get_service(id){
    param = { 'act': 'user_services','id':id };
    ajax({
        a: 'user_ajax',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#userservices').html(data);
        }
    });
    param ='';
    param = { 'act': 'user_services_name','id':id };
    ajax({
        a: 'user_ajax',
        b: $.param(param),
        c: function () { },
        d: function (data) {
            $('#userservicesname').html(data);
        }
    });
}

