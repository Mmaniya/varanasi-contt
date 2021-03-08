<?php function main()
{ ?>

<div class="row">
    <div class="col-xl-12 col-md-12">
        <h2 class="m-b-10">Voters Raw Details </h2>
        <div class="form-group row">
            <div class="col-sm-3">
                <select id='searchByState' name="state_id" onchange="getselectState(this.value)" class="form-control">
                    <option value='' disabled selected>--Select State--</option>
                </select>
            </div>
            <div class="col-sm-3">
                <select id='searchByDistrict' name="district_id" onchange="getallDistrict(this.value)" class="form-control">
                    <option value='' disabled selected>--Select District--</option>
                </select>
                <span id="total_dist"></span>          
            </div>
            <div class="col-sm-3">
                <select id='searchByConstituency' name="lg_const_id" onchange="getallConstituency(this.value)" class="form-control">
                    <option value='' disabled selected>--Select Constituency--</option>
                </select>
            </div>

            <div class="col-sm-3">
                <select id='searchByBooth' name="booth_id" class="form-control" onchange="getallBooth()">
                    <option value='' disabled selected>--Select Booth--</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover dt-responsive" id="voterrawTable">
                    <thead>
                        <th>#</th>
                        <th>Voter Id </th>
                        <th>Json Details</th>
                        <th>Inserted (Yes/No)</th>
                        <th>Added By</th>
                        <!-- <th>Action</th>-->
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>

$(document).ready(function() {
    param = { 'act': 'getallState', 'user': '' }
    ajax({
        a: "users/user-ajax",
        b: param,
        c: function() {},
        d: function(data) {
            $('#searchByState').html(data);
            $('#searchByDistrict').html('');
            $('#searchByConstituency').html('');
            $('#searchByBooth').html('');
        }
    });
});

</script>
<?php } include 'admin_template.php';?>