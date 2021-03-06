<?php  require "includes.php"; 
if (empty($_SESSION['userdetails'])) {
    header('location: index.php');
    exit();
}  

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php header('Content-type: text/html; charset=UTF-8'); ?>
<title>User Screen</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="userassets/css/custom.css">
<link rel="stylesheet" href="userassets/css/style.css">
<link rel="stylesheet" href="userassets/css/loder.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
<script src="userassets/js/default.js"></script>
<script src="userassets/js/custom-script.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-secondary mb-3">
    <div class="container-fluid">
        <a href="#" class="navbar-brand mr-3"><?php echo $_SESSION['userdetails']->name; ?></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon">
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ml-auto">
                <a href="logout.php" class="nav-item nav-link">Logout</a>
            </div>
        </div>
    </div>    
</nav>
<div class="container">

<input type="hidden" value="<?php echo $_SESSION['userdetails']->user_type; ?>" id="getUserID">   
<input type="hidden" value="" id="loadmoredata">   
<input type="hidden" value="" id="getType">     
<input type="hidden" value="" id="filterBy">   

    <div class="jumbotron" style="padding-bottom: 2rem;">

        <div class="form-group row">
            <div class="col-sm-4">
                <select id='searchByState' name="state_id" class="form-control">
                    <option value='' disabled selected>--Select State--</option>
                </select>   
            </div>

            <div class="col-sm-4">
                <select id='searchByDistrict' name="district_id" class="form-control">
                    <option value='' disabled selected>--Select District--</option>
                </select>  
                <span id="total_dist"></span>          
            </div>

            <div class="col-sm-4">
                <select id='searchByConstituency' name="lg_const_id" class="form-control">
                    <option value='' disabled selected>--Select Constituency--</option>
                </select>
            </div>
        </div>

        <div class="form-group row">

            <div class="col-sm-4">
                <select id='searchByBooth' name="booth_id" class="form-control">
                    <option value='' disabled selected>--Select Booth--</option>
                </select>
            </div>

            <div class="col-sm-4" id="boothbranch" style="display:none;">
                <select id='getBoothBranch' name="branch_id" class="form-control">
                    
                </select> 
            </div>

            <div class="col-sm-4" style="display:flex;">
                <select id="filter_type" class="form-control">
                    <option value="">Type</option>
                    <option value="slno_inpart">Serial No</option>
                    <option value="epic_no">Voter ID</option>
                    <option value="name">Name</option>
                </select>
                <input type="text" id="getSearchRecord" class="form-control" placeholder="Search...">
                <a href="javascript:void(0);" onclick="searchData()" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></a>
            </div>                    

        </div>


        <div id="records" style="display:none;">
        <hr>
            <div class="row mt-3" >
                <h5 class="col-sm-3"> Total Voters : <a href="javascript:void(0);" onclick="getVotersbyGender('')"  class="total_voters"></a></h5>
                <h5 class="col-sm-3"> Male Voters : <a href="javascript:void(0);" onclick="getVotersbyGender('M')" class="total_male"></a></h5>
                <h5 class="col-sm-3"> Female Voters : <a href="javascript:void(0);" onclick="getVotersbyGender('F')" class="total_female"></a></h5>
                <h5 class="col-sm-3"> Other Voters : <a href="javascript:void(0);" onclick="getVotersbyGender('T')" class="total_others"></a></h5>
               <?php /* <h5 class="col-sm-3"> Hindu Voters : <a href="javascript:void(0);" onclick="getVotersbyReligion('Hindu')" class="total_hindu"></a></h5>
                <h5 class="col-sm-3"> Christian Voters : <a href="javascript:void(0);" onclick="getVotersbyReligion('Christian')" class="total_christian"></a></h5>
                <h5 class="col-sm-3"> Muslim Voters : <a href="javascript:void(0);" onclick="getVotersbyReligion('Muslim')" class="total_muslim"></a></h5>
                <h5 class="col-sm-3"> Total Members : <span class="total_members"></span></h5> */ ?>
            </div>
            <hr>
            <div class="row mt-3" >
                <h5 class="col-sm-4"> First Voters : <a href="javascript:void(0);" onclick="getVotersbyAge('first_age_group')"  class="first_voters"></a></h5>
                <h5 class="col-sm-4"> Age 23 to 30 Voters : <a href="javascript:void(0);" onclick="getVotersbyAge('second_age_group')" class="23_30_voters"></a></h5>
                <h5 class="col-sm-4"> Age 31 to 40 Voters : <a href="javascript:void(0);" onclick="getVotersbyAge('third_age_group')" class="31_40_voters"></a></h5>
                <h5 class="col-sm-4"> Age 41 to 50 Voters : <a href="javascript:void(0);" onclick="getVotersbyAge('fourth_age_group')" class="41_50_voters"></a></h5>
                <h5 class="col-sm-4"> Age 51 to 60 Voters : <a href="javascript:void(0);" onclick="getVotersbyAge('fifth_age_group')" class="51_60_voters"></a></h5>
                <h5 class="col-sm-4"> Age Above 60 Voters : <a href="javascript:void(0);" onclick="getVotersbyAge('sixth_age_group')" class="above_60_voters"></a></h5>     
            </div>
            <div class="row mt-3" >
                <h5 class="col-sm-4"> <a href="javascript:void(0);" target="_blank" id="groupByfamily" > Group By Family</a></h5>
                <h5 class="col-sm-4"> <a href="javascript:void(0);" target="_blank" id="groupByReligion" > Group By Religion</a></h5>
                <h5 class="col-sm-4"> Voter Address : <a href="javascript:void(0);" onclick="getVotersbyAddress('')" class="filter_by_address"></a></h5>
                <h5 class="col-sm-4"> Total BLA : <a href="javascript:void(0);" onclick="getVotersbyKaryakarta('bla')"  class="bla_members"></a></h5>
                <h5 class="col-sm-4"> Total BC : <a href="javascript:void(0);" onclick="getVotersbyKaryakarta('bc')"  class="bc_members"></a></h5>
            </div> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-lg-8 col-xl-8">
            <h6 id="displayBooth"></h6>
            <!-- <span id="keyvoters" style="display:none" >(<i class="fa fa-star" style="color:goldenrod"></i>) Key Voters</span> -->
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4 text-right">
            <a href="javascript:void(0);" id="downloadExcelFile" class="btn btn-info" ><i class="fa fa-arrow-down" aria-hidden="true"></i>Excel Format</a>
            <a href="javascript:void(0);" id="downloadFile" class="btn btn-info" ><i class="fa fa-arrow-down" aria-hidden="true"></i>Download</a>
        </div>
    </div>
    <br>

    <!-- <div class="row" id="displayvoters"></div> -->

    <section id="featured-services" class="featured-services">
        <div class="container" data-aos="fade-up">
            <div class="row" id="displayvoters"></div>
        </div>
    </section>
    
            
    <div class="col-md-12 col-lg-12 col-xl-12 text-center" onclick="loadmoredata()" id="loadmore" style="display:none;">
        <a href="javascript:void(0);" class="btn btn-info ">Load more...</a>
    </div>

    <div class="col-md-12 col-lg-12 col-xl-12 text-center" onclick="resetdata()" id="clearData" style="display:none;">
        <a href="javascript:void(0);" class="btn btn-warning ">Reset</a>
    </div>

        <hr>

    <div class="modal fade displayModel" role="dialog">
        <div class="modal-dialog modal-md">
            <span id="modelshow"></span>
        </div>
    </div>

    <div class="preloader" style="display:none;">
        <div id="loader"></div>
    </div>


    <footer>
        <div class="row">
            <div class="col-md-6">
                <p>Dedicated by @ <a href="https://www.facebook.com/kavithabjp" target="_blank">Kavitha Rajan</a></p>
            </div>      
        </div>
    </footer>
</div>


<script type="text/javascript">
var usertype = $('#getUserID').val();
param = {'act':'getallState', 'user': usertype }
   ajax({
        a:"ajaxfile",
        b:param,
        c:function(){},
        d:function(data){
            $('#searchByState').html(data);
        }
    });

    $('#searchByState').change(function(){
     var state_id = $(this).val();
      param = {'act':'getallDistrict','state_id':state_id}
      ajax({
         a:"ajaxfile",
         b:param,
         c:function(){},
         d:function(data){
            $('#searchByDistrict').html(data);            
        }
      });
  });

  $('#searchByDistrict').change(function(){
     var dist = $(this).val();
      var state_id =  $('#searchByDistrict').val();
      param = {'act':'getallConstituency','state_id':state_id, 'district_id':dist }
      ajax({
         a:"ajaxfile",
         b:param,
         c:function(){},
         d:function(data){
            $('#searchByConstituency').html(data);
            // getAllVotersTable();
         }
      });
  });

  $('#searchByConstituency').change(function(){
     var const_id = $(this).val();
      param = {'act':'getallBooth','const_id':const_id}
      ajax({
         a:"ajaxfile",
         b:param,
         c:function(){},
         d:function(data){
            $('#searchByBooth').html(data);
         }
      });
  });

  $('#searchByBooth').change(function(){
     var booth_id = $(this).val();     
       param = {'act':'getallBoothBranch','booth_id':booth_id}
       ajax({
          a:"ajaxfile",
          b:param,
          c:function(){},
          d:function(data){
            if($.trim(data) != ''){
              $('#boothbranch').show();
             $('#getBoothBranch').html(data);      
            } else{
                $('#boothbranch').hide();
            }    
            getVoterCount(booth_id, '');
            var obj = JSON.stringify({ "booth_id":booth_id, "branch_id":'', "limit":0});
            getAllVoters(obj);
          }
      });

    param = '';
    param = {'act':'getallBoothName','booth_id':booth_id}
    ajax({
        a:"ajaxfile",
        b:param,
        c:function(){},
        d:function(data){
        $('#displayBooth').html(data);
        $('#keyvoters').show();
        }
    });
    
    var familyGroupUrl = "entry/add_family_list.php?booth=" + booth_id;
    $('#groupByfamily').attr('href', familyGroupUrl);

    var groupbyreligion = "entry/group_by_religion.php?booth=" + booth_id;
    $('#groupByReligion').attr('href', groupbyreligion);

    fileDownload();

  });



$('#getBoothBranch').change(function() {  
    $('#displayvoters').html('');
    var branch_id = $(this).val();
    var booth_id = $('#searchByBooth').val();
    // var limit = $('#loadmoredata').val();
    $('.preloader').show();
    getVoterCount(booth_id, branch_id);
    var obj = JSON.stringify({ "booth_id":booth_id, "branch_id":branch_id, "limit":0});
    getAllVoters(obj);

});
 

</script>
</body>
</html>