function loadmoredata() {
    var limit = $('#loadmoredata').val();
    var booth_id = $('#searchByBooth').val();
    var branch_id = $('#getBoothBranch').val();

    var getType = $('#getType').val();
    var filterBy = $('#filterBy').val();


    param = { 'act': 'getallVoters', 'boothid': booth_id, 'branchid': branch_id, 'limit': limit, 'getType': getType, 'filterBy': filterBy }
    $('.preloader').show();
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            // alert(data);
            $('#displayvoters').append(data);
            $('#loadmoredata').val(Number(limit) + 100);
        }
    });
};


function getVotersbyGender(gender) {
    $('#displayvoters').html('');
    var booth_id = $('#searchByBooth').val();
    var branch_id = $('#getBoothBranch').val();

    $('#getType').val('gender');
    $('#filterBy').val(gender);

    var obj = JSON.stringify({ "booth_id": booth_id, "branch_id": branch_id, "limit": 0, "getType": 'gender', "filterBy": gender });
    getAllVoters(obj);
    fileDownload();
}

function getVotersbyAge(age) {
    // alert(ageGroup);
    $('#displayvoters').html('');
    var booth_id = $('#searchByBooth').val();
    var branch_id = $('#getBoothBranch').val();

    $('#getType').val('ageGroup');
    $('#filterBy').val(age);

    var obj = JSON.stringify({ "booth_id": booth_id, "branch_id": branch_id, "limit": 0, "getType": 'ageGroup', "filterBy": age });
    getAllVoters(obj);
    fileDownload();
}


function getVotersbyKaryakarta(karyakarta) {
    // alert(ageGroup);
    $('#displayvoters').html('');
    var booth_id = $('#searchByBooth').val();
    var branch_id = $('#getBoothBranch').val();

    $('#getType').val('karyakarta');
    $('#filterBy').val(karyakarta);

    var obj = JSON.stringify({ "booth_id": booth_id, "branch_id": branch_id, "limit": 0, "getType": 'karyakarta', "filterBy": karyakarta });
    getAllVoters(obj);
    fileDownload();
}



function getVotersbyAddress() {

    $('#displayvoters').html('');
    var booth_id = $('#searchByBooth').val();
    var branch_id = $('#getBoothBranch').val();

    $('#getType').val('address');
    $('#filterBy').val('');

    var obj = JSON.stringify({ "booth_id": booth_id, "branch_id": branch_id, "limit": 0, "getType": 'address', "filterBy": '' });
    getAllVoters(obj);
    fileDownload();

}

function fileDownload() {

    var booth_id = $('#searchByBooth').val();
    var branch_id = $('#getBoothBranch').val();
    var getType = $('#getType').val();
    var filterBy = $('#filterBy').val();

    var myUrl = "export_voter_details.php?booth_id=" + booth_id + "&getType=" + getType + "&filterBy=" + filterBy;
    $('#downloadFile').attr('href', myUrl);

    var excelUrl = "export_excel_format.php?booth_id=" + booth_id
    $('#downloadExcelFile').attr('href', excelUrl);

}


// $(window).scroll(function() {
//     if ($(document).height() <= $(window).scrollTop() + $(window).height()) {
//         var limit = $('#loadmoredata').val();
//         var booth_id = $('#searchByBooth').val();
//         var branch_id = $('#getBoothBranch').val();
//         var gender = $('#gender').val();
//         var religion = $('#religion').val();

//         var obj = JSON.stringify({ "booth_id": booth_id, "branch_id": branch_id, "limit": limit, "gender": gender, "religion": religion });
//         getAllVoters(obj)
//     }
// });

function getAllVoters(data) {
    $('.preloader').show();
    var obj = JSON.parse(data);
    param = { 'act': 'getallVoters', 'boothid': obj['booth_id'], 'branchid': obj['branch_id'], 'limit': obj['limit'], 'getType': obj['getType'], 'filterBy': obj['filterBy'] }
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#loadmore').show();
            $('#displayvoters').html(data);
            $('#loadmoredata').val(Number(obj['limit']) + 100);
        }
    });
}

// booth and branch
function getVoterCount(booth_id, branch_id) {
    $('.preloader').show();
    param = { 'act': 'getallVotersCount', 'booth_id': booth_id, 'branch_id': branch_id }
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            var res = data.split("::");
            //
            $('.preloader').hide();
            $('.total_voters').html(res[0]);
            $('.total_male').html(res[1]);
            $('.total_female').html(res[2]);
            $('.total_others').html(res[3]);
            $('.total_verified').html(res[4]);
            $('.total_hindu').html(res[5]);
            $('.total_christian').html(res[6]);
            $('.total_muslim').html(res[7]);
            $('.total_members').html(res[8]);

            $('.first_voters').html(res[9]);
            $('.23_30_voters').html(res[10]);
            $('.31_40_voters').html(res[11]);
            $('.41_50_voters').html(res[12]);
            $('.51_60_voters').html(res[13]);
            $('.above_60_voters').html(res[14]);
            $('.filter_by_address').html(res[15]);
            $('.bla_members').html(res[16]);
            $('.bc_members').html(res[17]);
            $('#records').show();
        }
    });
}

function verify_voters(id) {
    $('.preloader').show();
    param = { 'act': 'voterVerification', 'voter_id': id }
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#modelshow').html(data);
        }
    });
}

function rejected_voters(id) {
    $('.preloader').show();
    param = { 'act': 'voterRejected', 'voter_id': id }
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#modelshow').html(data);
        }
    });
}

function voterReload(id) {
    $('.preloader').show();
    param = { 'act': 'voterRefresh', 'voter_id': id }
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#voter-card-' + id).html(data);
        }
    });
}

function updateKeyVoters(id, key) {
    $('.preloader').show();
    param = { 'act': 'updateKeyVoter', 'id': id, 'data': key }
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            voterReload(id);
        }
    });

}

function searchData() {

    var booth_id = $('#searchByBooth').val();
    var branch_id = $('#getBoothBranch').val();
    // var limit = $('#loadmoredata').val();
    var keyword = $('#getSearchRecord').val();
    var filter_type = $('#filter_type').val();
    $('#loadmore').hide();
    $('#clearData').show();

    param = { 'act': 'getallVoters', 'boothid': booth_id, 'branchid': branch_id, 'limit': 0, 'search': keyword, 'filter_type': filter_type }
    $('.preloader').show();
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#displayvoters').html(data);
        }
    });
}

function resetdata() {
    var booth_id = $('#searchByBooth').val();
    var branch_id = $('#getBoothBranch').val();
    $('#loadmore').show();
    $('#clearData').hide();
    var obj = JSON.stringify({ "booth_id": booth_id, "branch_id": branch_id, "limit": 0 });
    getAllVoters(obj)

}

function voter_info(id) {
    param = { 'act': 'voterInfo', 'voter_id': id }
    $('.preloader').show();
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#modelshow').html(data);
        }
    });
}

function voter_party(id) {
    $('.preloader').show();
    param = { 'act': 'voterParty', 'voter_id': id }
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#modelshow').html(data);
        }
    });
}

function voter_scheme(id) {
    $('.preloader').show();
    param = { 'act': 'voterScheme', 'voter_id': id }
    ajax({
        a: "ajaxfile",
        b: param,
        c: function() {},
        d: function(data) {
            $('.preloader').hide();
            $('#modelshow').html(data);
        }
    });
}