
<?php  require "includes.php"; 
$categoryObj = new Categories; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>MMS - Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      .main-card{
        position: relative;
        margin-bottom: 25px;
        margin-right:8%;
        border: 2px solid #e4e4e4;
        border-radius: 17px;
        background-color: #fff;
        box-shadow: 2px 2px 10px 0 rgba(0, 0, 0, 0.1);
            -webkit-box-flex: 0;
            -ms-flex: 0 0 49%;
            flex: 0 0 49%;
            max-width: 49%;
            margin-right: 1%;
      }

      </style>
  </head>
  <body>
  <div class="container">
	<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom">
		<h5 class="my-0 mr-md-auto font-weight-normal">Mastermind Solutions</h5>		 
		<a class="btn btn-outline-primary" href="#">View Profile</a>
	</div>
</div>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Welcome to your agency delivery hub! </h1>
  <p class="lead">This is where you can get your client work fulfilled, and explore new services you can sell.</p>
</div>
<style> .services_list li {margin-bottom: 10px; } 


.w-inline-block {
    max-width: 100%;
    display: inline-block;
}


.tab {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    margin-top: 10px;
    margin-bottom: 10px;
    padding-top: 20px;
    padding-bottom: 20px;
    text-transform:capitalize;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    border: 1px none #000;
    border-top-left-radius: 50px;
    border-bottom-left-radius: 50px;
    background-color: transparent;
    opacity: 0.7;
    -webkit-transition: all 200ms ease;
    transition: all 200ms ease;
    font-family: 'Circular STD', sans-serif;
    font-size: 17px;
    font-weight: 400;
}
.tab.w--current {
    z-index: 2;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    margin-top: 10px;
    margin-bottom: 10px;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    border-style: none;
    border-color: #3e66fc;
    border-right-width: 3px;
    border-left-width: 3px;
    border-radius: 15px;
    background-color: #f5f6fc;
    background-image: linear-gradient(34deg, #3e66fc, #4a9cfa);
    opacity: 1;
    color: #fff;
    font-weight: 400;}
    .tab:hover {
    border-top-color: #3e66fc;
    border-bottom-color: #3e66fc;
    border-left-color: #3e66fc;
    opacity: 1;
    text-decoration:none;
    
    color: #fff; }


    .w-tab-link {
    position: relative;
    display: inline-block;
    vertical-align: top;
    text-decoration: none;
    padding: 9px 30px;
    text-align: left;
    cursor: pointer;
    color: #222222;
    background-color: #dddddd;}

    .w-tab-link:focus {
    outline: 0;
}

.w-col {
    position: relative;
    float: left;
    width: 100%;
    min-height: 1px;
    padding-left: 10px;
    padding-right: 10px; }

    .w-col .w-col {
    padding-left: 0;
    padding-right: 0;
}
.w-col-6 {
    width: 50%;
}

.div-block-185.srp {
    border-color: #28c916;
    background-color: rgba(40, 201, 22, 0.15);
}
.div-block-185 {
    width: 95%;
    margin-right: 0px;
    padding-top: 9px;
    padding-bottom: 9px;
    border-style: solid;
    border-width: 2px;
    border-color: #e4e4e4;
    border-radius: 5px;
}

.paragraph-3.caps.srp {
    opacity: 1;
    color: #28c916;
    font-weight: 700;
}
.paragraph-3.caps {
    margin-bottom: 0px;
    font-size: 13px;
    font-weight: 400;
    text-align: center;
    text-transform: none;
}
.paragraph-3 {
    margin-bottom: 25px;
    opacity: 0.6;
    font-family: 'Circular STD', sans-serif;
}
p {
    margin-top: 0;
    margin-bottom: 10px;
}
.w-col .w-col {
    padding-left: 0;
    padding-right: 0;
}
.div-block-185 {
    width: 95%;
    margin-right: 0px;
    padding-top: 9px;
    padding-bottom: 9px;
    border-style: solid;
    border-width: 2px;
    border-color: #e4e4e4;
    border-radius: 5px;
}

.paragraph-3.caps {
    margin-bottom: 0px;
    font-size: 13px;
    font-weight: 400;
    text-align: center;
    text-transform: none;
}
.paragraph-3 {
    margin-bottom: 25px;
    opacity: 0.6;
    font-family: 'Circular STD', sans-serif;
}
p {
    margin-top: 0;
    margin-bottom: 10px;
}

.text-block-16.price {
    color: #3e66fc;
    font-weight: 700;
}
</style>

<div class="container">
  <div class="row">
    <div class="col-3">
          <ul class="services_list list-unstyled text-small">
          <?php  $statusArr = array('A' => 'checked', 'I' => '');  
                  $categoryObj->status = $_POST['status'];   
                  $rsCategory = $categoryObj->get_category();
                  if (count($rsCategory) > 0) {
                      foreach ($rsCategory as $key => $value) { ?> 
                      
                      <a data-w-tab="Tab 1" class="tab w-inline-block w-tab-link w--current" href="javascript:void(0);" onclick="get_service(<?php echo $value->id?>)" ><div><?php echo $value->category_abbr?></div></a>


                          <!-- <li><a class="btn btn-lg btn-block btn-primary" ></a></li>                         -->
                      <?php } } ?>
          </ul>
    </div> 
    <div class="col-9"> 
    <div class="col-12" id="userservicesname"></div>   
      <div class="row" id="userservices">
 
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo ADMIN_JS ?>/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_JS ?>/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_JS ?>/popper.js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_JS ?>/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_JS ?>/common-pages.js"></script> 
<script type="text/javascript" src="<?php echo ADMIN_JS ?>/custom-script-user.js"></script>
<script>
  $(function () {
    get_service(<?php echo $rsCategory[0]->id; ?>);
  })
  </script>
</body>
</html>
