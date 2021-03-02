<?php  require "includes.php"; 
if (!empty($_SESSION['userdetails'])) {
    foreach ($_SESSION as $K => $V) {
        unset($_SESSION[$K]);
    }
    session_destroy();
    session_unset();
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>User Screen</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="userassets/css/login.css">
<link rel="stylesheet" href="userassets/css/loder.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="userassets/js/default.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
            <div id="first">
                <div class="myform form ">
                        <div class="logo mb-3">
                            <div class="col-md-12 text-center">
                            <h1>Login</h1>
                            </div>
                    </div>
                    <?php echo $_SESSION['userdetails']->username;    ?>
                    <form action="javascript:void(0);" id="formSignInAdmin" method="post" name="login">
                        <input type="hidden" value="signInAdmin" name="act">
                        <div class="form-group">
                            <label>UserName</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password"  class="form-control" placeholder="Enter Password">
                        </div>                        
                        <div class="col-md-12 text-center ">
                            <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Login</button>
                        </div>  
                        <div class="mt-2 badge badge-danger" id="display_err"></div>
                    </form>                 
                </div>
            </div>		
        </div>
    </div>  
    <div class="preloader" style="display:none;">
        <div id="loader"></div>
    </div>
</body>

<script type="text/javascript">
$("form#formSignInAdmin").submit(function(){
    $('.preloader').show();
    var param = $('form#formSignInAdmin').serialize();
    ajax({
        a:"ajaxfile",
        b:param,
        c:function(){},
        d:function(data){        
            var records = JSON.parse(data);
            $('.preloader').hide();
            if(records[0] == 'Success'){
                window.location.href = 'home.php';
            }else{
                $('#display_err').html(records)
            }
        }
    });
});

</script>
</body>
</html>