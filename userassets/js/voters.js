function getWard() {
    param = { 'act': 'getallWards' }
    ajax({
        a: "voters_ajax",
        b: param,
        c: function() {},
        d: function(data) {
            $('#getBooth').html(data);
        }
    });
}