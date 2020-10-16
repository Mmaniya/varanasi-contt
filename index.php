
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
    <link rel="stylesheet" type="text/css" href="<?php echo ADMIN_CSS ?>/user-style.css">

  </head>
  <body>
  <div class="container">
	<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom">
		<h5 class="my-0 mr-md-auto font-weight-normal">Mastermind Solutions</h5>		 
		<a class="btn btn-outline-primary" href="#">View Profile</a>
	</div>
</div>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="heading-7">Welcome to your agency delivery hub! ⚡</h1>
  <p class="paragraph-2">This is where you can get your client work fulfilled, and explore new services you can sell.</p>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-12">
            <ul class="tabs-menu">
            <?php  $statusArr = array('A' => 'checked', 'I' => '');  
                    $categoryObj->status = $_POST['status'];   
                    $rsCategory = $categoryObj->get_category();
                    if (count($rsCategory) > 0) {
                    foreach ($rsCategory as $key => $value) { ?>                         
                    <a data-w-tab="Tab 1" class="tab w-inline-block w-tab-link w--current" href="javascript:void(0);" onclick="get_service(<?php echo $value->id?>)" ><div><?php echo $value->category_abbr?></div></a>
            <?php } } ?>
            </ul>
        </div> 
        <div class="col-md-9 col-sm-12"> 
            <div class="col-12" id="userservicesname"></div>   
            <div class="row" id="userservices"></div>
        </div>
    </div>

        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="heading-7">Agency University 🏫 Learn More, Earn More</h1>
            <p class="paragraph-2">Every week, we host a webinar where the community's questions get answered, and we teach you how to grow a successful agency.</p>
        </div>

        <div class="row">
            <div class="card col-5" style="border: 2px solid #e4e4e4; border-radius: 17px; background-color: #fff; box-shadow: 2px 2px 10px 0 rgba(0, 0, 0, 0.1);" >
                <div class="card-body">
                    <div class="text-block-20">Have a question that needs answering?</div>
                    <p class="paragraph-2 bottom hero left">Fill out the form below &amp; we'll cover your questions on next week's webinar!<br><br><strong>Our next webinar will be on Friday, August 7 at 17:00 CEST!</strong><br><br>You'll recieve an email with a link to the private webinar 24 hours before it starts!&nbsp;Looking forward to seeing you there!<br></p>
                    <div class="w-form">
                        <form id="email-form" name="email-form" data-name="Email Form">
                            <textarea placeholder="What's your question?" maxlength="5000" id="Question" name="Question" required="" data-name="Question" class="textarea w-input"></textarea>
                            <input type="submit" value="Submit Question" data-wait="Please wait..." class="submit-button w-button">
                        </form>
                        <div class="success-message w-form-done"><div>Thank you! Watch next week's webinar to hear our answer! 🎯</div></div>
                        <div class="w-form-fail"><div>Oops! Something went wrong while submitting the form.</div></div>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <img src="<?php echo  ADMIN_IMAGES ?>/hompageimg.png" style="max-width: 677px" class="image-15">
            </div>
        </div>
        <br>
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
