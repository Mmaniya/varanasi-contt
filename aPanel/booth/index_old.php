
<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php"; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Voters List</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css" type="text/css"/>
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../assets/css/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../assets/css/custom.css" type="text/css"/>

    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>	
    <script type="text/javascript" src="../assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/sweetalert2.min.js"></script>
    <script type="text/javascript" src="../assets/js/sweet-alerts.init.js"></script>
    <script type="text/javascript" src="../assets/js/default.js"></script>	
</head>
<body>

<!-- dont delete this -->

<div class="container">
    <br><br><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="booth_details.php"  method="POST">
                        <div class="form-group row text-center">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Select Booth Number</label>
                            <div class="col-sm-4 justify-content-md-center"> 
                                <input type="hidden" value="<?php echo $_POST['id'] ?>" name="ward" />

                                <select class="form-control" id="boothselect" name="booth">
                                <option value="" disabled selected>Select Booth</option>
                                <?php $booth = Voters::getBoothDetails(); 
                                        foreach($booth as $booth_no=>$value){ ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->booth_no ?></option>
                                        <?php   }
                                    ?>            
                                </select>
                            </div>
                        </div>
                        <div id="getbranch"></div>                   
                    </form>
                </div>           
            </div>
        </div> 
    </div>
</div>

<!-- dont delete this -->

    <script>
        $(document).ready(function(){
            $("#boothselect").on('change', function() {
                param = {'act':'get_branch_details','id':this.value}
				ajax({
					a: "add_voters",
					b: param,
					c: function() {},
					d: function(data) {
                        $('#getbranch').html(data);
                    }
                });
            });
        });

    </script>
<body>
</html>