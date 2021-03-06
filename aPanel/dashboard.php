<?php function main()
{
// echo $_SESSION['lg_const_id'];
$rsBooth = Votersdetails::getBoothCount($_SESSION['lg_const_id']);
$rsEvoters = Votersdetails::getEvoterCount($_SESSION['lg_const_id']);
// $rsTVoters = Votersdetails::getTvoterCount($_SESSION['lg_const_id']);
 ?>


<?php if($_SESSION['admin_role'] != 'SA'){ ?>

<div class="row">
    <div class="col-xl-3 col-md-4">
        <div class="card bg-c-yellow update-card">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-12">
                        <h4 class="text-white"><?php echo count($rsBooth); ?> </h4>
                        <h6 class="text-white m-b-0">Total Booth</h6>
                    </div>   
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white  m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : <?php echo  date('M d, Y', strtotime(end($rsBooth)->updated_at)); ?> </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-4">
        <div class="card bg-c-green update-card">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-12">
                        <h4 class="text-white"><?php echo count($rsEvoters); ?> </h4>
                        <h6 class="text-white m-b-0">Enterd Voters</h6>
                    </div>       
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white m-b-0"><i class="feather  icon-clock text-white f-14 m-r-10"></i>update : <?php echo  date('M d, Y', strtotime(end($rsEvoters)->updated_at)); ?> 
                </p>
            </div>
        </div>
    </div>
    <!-- <div class="col-xl-3 col-md-4">
        <div class="card bg-c-lite-green update-card">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-12">
                        <h4 class="text-white"><?php echo count($rsTVoters); ?> </h4>
                        <h6 class="text-white m-b-0">Total Voters</h6>
                    </div>       
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white m-b-0"><i class="feather  icon-clock text-white f-14 m-r-10"></i>update : <?php echo  $rsTVoters[0]->updated_date; ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-4">
        <div class="card bg-c-pink update-card">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-12">
                        <h4 class="text-white"><?php echo count($rsServices); ?> </h4>
                        <h6 class="text-white m-b-0">Total Voters</h6>
                    </div>       
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white m-b-0"><i class="feather  icon-clock text-white f-14 m-r-10"></i>update : <?php echo  $rsServices[0]->updated_date; ?>
                </p>
            </div>
        </div>
    </div> -->
    <!-- <div id="ajaxResponce"></div> -->
</div>
<?php }else{ ?>
<div class="row">
    <div class="col-xl-12 col-md-12">
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
                <table class="table table-striped table-hover dt-responsive" id="voterTable">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Voter Id </th>
                        <th>Age</th>
                        <th>Gender</th>
                        <!-- <th>Action</th>              -->
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
<?php } ?>
<?php } include 'admin_template.php';?>