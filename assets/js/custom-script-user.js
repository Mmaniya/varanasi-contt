gettableData();

function gettableData() {
    $("#user-table").DataTable().destroy()
    var dataTable = $('#user-table').DataTable({
        // 'processing': true,
        // 'serverSide': true,
        // 'responsive': true,
        // 'serverMethod': 'post',
        // 'ajax': {
        //         'url':' get_reporters_details.php',
        //         'data': function(data){  

        //         }
    });
}

function add_edit_user(user_id) {
    param = { 'act': 'add_edit_users', 'user_id': user_id }
    ajax({
        a: "index",
        b: param,
        c: function() {},
        d: function(data) {
            $('.popup_content').html(data);
            $('#add_edit_user_popup').modal('show');
        }
    });
}

function usersStatus(id) {
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
                a: "user-ajax",
                b: param,
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    if (data == 'Success') {
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

function delete_user(id) {
    param = { 'act': 'delete_user', 'id': id };
    Swal.fire({
        title: "Are you sure.You want to delete this user?",
        text: "Delete all records permanently? Please press 'YES' to confirm.?",
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
                a: "user-ajax",
                b: param,
                c: function() {},
                d: function(data) {
                    $('.preloader').hide();
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        location.reload();
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                    }
                }
            });
        }
    });
}


// Booth 
// add_booth();

// function add_booth() {
//     param = { 'act': 'addBooth' }
//     ajax({
//         a: "upload_booth",
//         b: param,
//         c: function() {},
//         d: function(data) {
//             $('#ajaxResponce').html(data);
//         }
//     });
// }


// Voters Details

function getvoterbooth(boothid) {
    $('.preloader').show();
    param = { 'act': 'getvotersbyusers', 'booth_id': boothid }
    ajax({
        a: "update_raw_voters_ajax",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#select_booth').html(data);
        }
    });
}

// $('#select_booth').change(function(){
// var booth = $(this).val();
function updatevotersrecords() {
    $('#loadmoredata').val('0');
    var booth = $('#select_booth').val();
    param = { 'act': 'gettotalrecords', 'booth_no': booth }
    ajax({
        a: "update_raw_voters_ajax",
        b: param,
        c: function() {},
        d: function(data) {
            $('.votersCount').html(data);
        }
    });
    getvoterInfo(booth);
};

function countvotersrecords() {
    var booth = $('#select_booth').val();
    param = { 'act': 'gettotalrecords', 'booth_no': booth }
    ajax({
        a: "update_raw_voters_ajax",
        b: param,
        c: function() {},
        d: function(data) {
            $('.votersCount').html(data);
        }
    });
};

function getvoterInfo(booth) {
    var limit = $('#loadmoredata').val();
    $('.preloader').show();
    param = { 'act': 'getallvotersdetails', 'limit': limit, 'group_by': booth }
    ajax({
        a: "update_raw_voters_ajax",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#displayvoters').html(data);
            $('#loadmoredata').val(Number(limit) + 100);
        }
    });
}

function getmoreData() {
    var limit = $('#loadmoredata').val();
    var booth = $('#select_booth').val();
    // var group_by = $('#usersDetails').val();
    param = { 'act': 'getallvotersdetails', 'limit': limit, 'group_by': booth }
    ajax({
        a: "update_raw_voters_ajax",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#displayvoters').append(data);
            $('#loadmoredata').val(Number(limit) + 100);
        }
    });
}

function pasteElement(id) {
    if (window.clipboardData) {

        $('#voters_raw_data_' + id).val('');
        $('#voters_raw_data_' + id).val(window.clipboardData.getData('Text'));
        jsonData = $('#voters_raw_data_' + id).val().trim();

        if (jsonData != '') {
            var ListEpic = $('#voters_' + id).val();
            result = JSON.parse(window.clipboardData.getData('Text'));
            var jsonEpic = result.response.docs[0].epic_no;
            if (jsonEpic.trim() == ListEpic.trim()) {
                updateVoterDetails(id); // submit json data 
                autoOpenNextWindow(id);
            }
        }
        return;
    }
}

function updateVoterDetails(id) {
    $('#add_Data' + id).css('background-color', '#ff0000');
    var usersDetails = $('#usersDetails').val();
    var voterid = $('#voters_' + id).val();
    var voterRawData = $('#voters_raw_data_' + id).val();
    param = { 'act': 'updatevoterRawdata', 'voterid': voterid, 'voterRawdata': voterRawData, 'user': usersDetails }
    ajax({
        a: "update_raw_voters_ajax",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $("#add_Data" + id).css("display", "none");
            $("#responceData" + id).css("display", "block");
            $('#voters_raw_data_' + id).prop('readonly', true);
            countvotersrecords();
            // setTimeout(function(){
            //$("#remove_"+id).hide();
            // }, 10000);
        }
    });
}

function autoOpenNextWindow(id) {
    var nextElement = id + 1;
    getVoterDetails(nextElement);
}

function getVoterDetails(id) {

    var captch = $('#captch').val();
    var voterid = $('#voters_' + id).val();
    GoURL('https://electoralsearch.in/Home/searchVoter?epic_no=' + voterid + '&page_no=1&results_per_page=10&reureureired=ca3ac2c8-4676-48eb-9129-4cdce3adf6ea&search_type=epic&state=S22&txtCaptcha=' + captch);
    $('#voters_raw_data_' + id).focus();
}

function GoURL(url) {

    var tempElement = document.createElement("input");
    tempElement.style.cssText = "width:0!important;padding:0!important;border:0!important;margin:0!important;outline:none!important;boxShadow:none!important;";
    document.body.appendChild(tempElement);
    tempElement.value = ' ' // Empty string won't work! 
    tempElement.select();
    document.execCommand("copy");
    document.body.removeChild(tempElement)

    var child = window.open(url, "_blank", "height=400,width=400");
    child.focus();
    var timer = setInterval(checkChild, 12500);

    function checkChild() {
        //selectedText = child.getSelection().toString();
        //alert(selectedText);
        child.close();
    }

}


// SELECT SUPER ADMIN
$('#searchByDistrict').hide();
$('#searchByConstituency').hide();
$('#searchByBooth').hide();

function getselectState(id) {
    $('.preloader').show();
    param = { 'act': 'getallDistrict', 'state_id': id }
    ajax({
        a: "users/user-ajax",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#searchByDistrict').show();
            $('#searchByDistrict').html(data);
            $('#searchByConstituency').html('');
            $('#searchByBooth').html('');
            getVotersData();
            rawvotersdetails();
        }
    });
}

function getallDistrict(id) {
    var state_id = $('#searchByDistrict').val();
    $('.preloader').show();
    param = { 'act': 'getallConstituency', 'state_id': state_id, 'district_id': id }
    ajax({
        a: "users/user-ajax",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#searchByConstituency').show();
            $('#searchByConstituency').html(data);
            $('#searchByBooth').html('');
            getVotersData();
            rawvotersdetails();
        }
    });
}

function getallConstituency(id) {
    $('.preloader').show();
    param = { 'act': 'getbyallBooth', 'const_id': id }
    ajax({
        a: "users/user-ajax",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#searchByBooth').show();
            $('#searchByBooth').html(data);
            getVotersData();
            rawvotersdetails();
        }
    });
}

function getallBooth() {
    getVotersData();
    rawvotersdetails();
}

function getVotersData() {
    $("#voterTable").DataTable().destroy()
    $('#voterTable').DataTable({
        'processing': true,
        'serverSide': true,
        'responsive': true,
        'serverMethod': 'post',
        'dom': 'Bfrtip',
        'buttons': [{
                'extend': 'excelHtml5',
                'title': 'Data export'
            },
            {
                'extend': 'pdfHtml5',
                'title': 'Data export'
            }
        ],
        'ajax': {
            'url': ' getvotersdtls.php',
            'data': function(data) {
                data.searchByState = $('#searchByState').val();
                data.searchByDist = $('#searchByDistrict').val();
                data.searchByConstituency = $('#searchByConstituency').val();
                data.searchByBooth = $('#searchByBooth').val();
            }
        }

    });
}

function rawvotersdetails() {
    $("#voterrawTable").DataTable().destroy()
    $('#voterrawTable').DataTable({
        'processing': true,
        'serverSide': true,
        'responsive': true,
        'serverMethod': 'post',
        'ajax': {
            'url': ' getvotersrawdtls.php',
            'data': function(data) {
                data.searchByState = $('#searchByState').val();
                data.searchByDist = $('#searchByDistrict').val();
                data.searchByConstituency = $('#searchByConstituency').val();
                data.searchByBooth = $('#searchByBooth').val();
            }
        }

    });
}

function selectUser(type) {
    if (type == 'DE') {
        $('#selectBooth').show();
    } else {
        $('#selectBooth').hide();

    }
}



function votersepicupload() {
    param = { 'act': 'voters_upload_form' }
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            $('#uplode_form').html(data);
            selectState('');
            existingBooth();
        }
    });
}

function votersaddressupload(value) {
    var records = JSON.parse(value);
    param = { 'act': 'voters_upload_address_form', 'response': value }
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            $('#uplode_form').html(data);
            if (jQuery.isEmptyObject(records)) {
                selectState(records['state_id']);
            } else {
                selectState(records['state_id']);
                searchAllDist(records['state_id'], records['dist_id']);
                searchAllConst(records['dist_id'], records['const_id']);
                searchAllBooth(records['const_id'], records['booth_id']);
            }
            existingBooth();
        }
    });
}



// Deafult Select All State

function selectState(state_id) {
    param = { 'act': 'getallState', 'state_id': state_id }
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            $('#searchByState').html(data);
        }
    });
}

// Search By District

function searchAllDist(value, dist_id) {
    param = { 'act': 'getallDistrict', 'state_id': value, 'dist_id': dist_id }
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            $('#searchByDistrict').html(data);
            $('#searchByConstituency').html('<option>Select Constituency</option>');
            $('#searchByBooth').html('<option>Select Booth</option>');
        }
    });
}

// Search By Const

function searchAllConst(value, const_id) {
    param = { 'act': 'getallConstituency', 'district_id': value, 'const_id': const_id }
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            $('#searchByConstituency').html(data);
            $('#searchByBooth').html('<option>Select Booth</option>');
        }
    });
}

// Search By Booth

function searchAllBooth(value, booth_id) {
    param = { 'act': 'getbyallBooth', 'const_id': value, 'booth_id': booth_id }
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            $('#searchByBooth').html(data);
        }
    });
}


function existingBooth() {
    $(':input[type="number"]').val('');
    $(':input[type="text"]').val('');
    $('.newBooth').hide();
    $('.oldBooth').show();
}

function newBooth() {
    $('#searchByBooth').val('');
    $('.newBooth').show();
    $('.oldBooth').hide();
}


// List

function loadStateList(user_id) {
    param = { 'act': 'get_role_by_state', 'user_id': user_id }
    ajax({
        a: "update_raw_voters",
        b: param,
        c: function() {},
        d: function(data) {
            $('#select_state').html(data);
        }
    });
}

function getDistrictList(state_id) {
    param = { 'act': 'get_role_by_district', 'state_id': state_id }
    ajax({
        a: "update_raw_voters",
        b: param,
        c: function() {},
        d: function(data) {
            $('#select_district').html(data);
        }
    });

}

function getConstByDistrict(district_id) {
    param = { 'act': 'get_role_by_const', 'district_id': district_id }
    ajax({
        a: "update_raw_voters",
        b: param,
        c: function() {},
        d: function(data) {
            $('#select_constituency').html(data);
        }
    });

}

function getBoothByConst(lg_const_id) {
    param = { 'act': 'get_role_by_booth', 'lg_const_id': lg_const_id }
    ajax({
        a: "update_raw_voters",
        b: param,
        c: function() {},
        d: function(data) {
            $('#select_booth').html(data);
        }
    });

}