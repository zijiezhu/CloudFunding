<?php 
session_start();
if(!isset($_SESSION['loginname'])){
	echo '<script language=javascript>window.location.href="loginremind.html"</script>';

}else echo $_SESSION['loginname'];

$GLOBALS['p_id']=$_GET['pid'];
$pid=$GLOBALS['p_id'];
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());
$query=$connection->prepare("SELECT * FROM project WHERE pid=?");
$query->bind_param("s",$para);
$para=$pid;
$query->execute();
$result=$query->get_result();
$line = @mysqli_fetch_array($result, @MYSQL_ASSOC);

$loginname=$_SESSION['loginname'];
$queryu=$connection->prepare("SELECT * FROM users WHERE loginname=?");
$queryu->bind_param("s",$paramm);
$paramm=$loginname;
$queryu->execute();
$resultu=$queryu->get_result();
$linex = @mysqli_fetch_array($resultu, @MYSQL_ASSOC);

$GLOBALS['username']=$loginname;
$GLOBALS['uimg']=$linex['uimg'];
$GLOBALS['email']=$linex['email'];



$max_amount=$line['max'];
$get_amount="SELECT sum(amount) AS sum FROM fund WHERE pid={$pid} GROUP BY pid";
$cur_amount_res=@mysqli_query($connection,$get_amount);
$cur_amount_res_data=@mysqli_fetch_array($cur_amount_res,@MYSQL_ASSOC);
$cur_amount=$cur_amount_res_data['sum'];

$GLOBALS['p_id']=$line['pid'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Campaigs</title>

<!-- Css (necessary Css) -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/bootstrap-theme.css" rel="stylesheet">
<link href="assets/css/language-selector-remove-able-css.css" rel="stylesheet">
<link href="assets/css/flexslider.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">
<link href="plugin.css" rel="stylesheet">
<link href="assets/css/menu.css" rel="stylesheet">
<link href="assets/css/responsive.css" rel="stylesheet">
<link href="assets/css/color.css" rel="stylesheet">
<link href="assets/css/iconmoon.css" rel="stylesheet">
<link href="assets/css/themetypo.css" rel="stylesheet">
<link href="assets/css/widget.css" rel="stylesheet">
<link href="assets/css/sumoselect.css" rel="stylesheet">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style>
.div10086{
width:auto;
height:auto;
float:left;
}
</style>
<body>
<div class="wrapper"> 
	
	<!-- Header -->
  <header id="main-header">
    <div class="container">
    <div class="main-head">
      <div class="left-side">
        <div class="logo"><a href="index.html"><img src="assets/images/logo.png" alt=""></a></div>
      </div>
      <div class="right-side">
        <div class="cs-search-block">
          <form role="form" method="POST" action="projects.php">
            <input type="text" id="s" name="keyword" placeholder="Search Project" onfocus="if(this.value =='Search Project') { this.value = ''; }" onblur="if(this.value == '') { this.value ='Search Project'; }" class="form-control">
            <label>
              <input type="submit" >
            </label>
          </form>
        </div>
        <div class="profile-view">
          <ul>
            <li>
              <img alt="#" height="30" width="30" src="<?php echo $GLOBALS['uimg'];?>">
              <i class="icon-arrow-down8"></i>
              <div class="dropdown-area">
                <h5><?php echo $GLOBALS['username']; ?></h5>
                <span><?php echo $GLOBALS['email']; ?></span>
                <ul class="dropdown">
                  <li><a href="myProject.php"><i class="icon-flag5"></i>My Causes</a></li>
                  <li><a href="myDonations.php"><i class="icon-file-text-o"></i>My Donations</a></li>
                  <li><a href="createProject.php"><i class="icon-plus6"></i>Create New</a></li>
                  <li><a href="myProfile.php"><i class="icon-pie2"></i>Profile Settings</a></li>
                </ul>
                <a class="sign-btn" href="logout.php"><i class="icon-logout"></i>Sign Out</a>
              </div>
            </li>
          </ul>
        </div> 
    </div>
    <div class="mob-nav"></div>
    </div>
  </header>
  <br><br><br><br><br>
  <!-- Header -->
	<!-- Main Content -->
	<main id="main-content">
		<div class="main-section" style="padding:0;">
			<section class="page-section bg-donate">
				<div class="container">
					<div class="row">
						<div class="section-fullwidth">
							<div class="cs-content-holder">
								<div class="row">
									<div class="col-lg-12">
										<div class="donate-area">
											<ul class="nav nav-tabs" role="tablist">
												<li  role="presentation"><a data-toggle="tab" role="tab" aria-controls="home" href="#home">01. Donate</a></li>
												<li role="presentation"><a data-toggle="tab" role="tab" aria-controls="profile" >02. Payment</a></li>
												<li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="messages" >03. Confirmation</a></li>
											</ul>
											<div class="tab-content">
												<div id="home" class="tab-pane active fade in" role="tabpanel">
													<div class="confirmation-area">
														<div class="donate-holder">
															<div class="icon-area">
																<i class="icon-check"></i>
															</div>
															<strong>We recived your Payment</strong>
															<h3>Thank you so much for your Contribution</h3>
															<p>Patiently shuffled close adjusted far the goodness grunted basically<br> reprehensive the hello ahead more to slow along the unbearably fumblingly<br> yikes sneered and and hence pill wobbled in one.</p>
														</div>
														<div class="cs-holder">
                                                            <form method="post" action="projects.php">
															<input type="submit" value="Back to Project List">
															</from>
														</div>
													</div>
												</div>
												<div id="profile" class="tab-pane fade in" role="tabpanel">
													
												</div>
												<div id="messages" class="tab-pane fade in" role="tabpanel">
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>
	<!--// Main Content //--> 
	
	<!--// Footer Widget //-->
	<footer id="footer-sec">
		<div class="container">
			<div class="row">
				<aside class="col-lg-4 col-md-4 col-sm-6 widget widget_categories">
					<div class="widget-section-title"> <strong class="title">Campaigning</strong> </div>
					<ul>
						<li><a href="#">Contributing</a></li>
						<li><a href="#">Publishing</a></li>
						<li><a href="#">Explore Partner Pages</a></li>
						<li><a href="#">Music</a></li>
						<li><a href="#">Daily Inspiration</a></li>
						<li><a href="#">Film and Theatre</a></li>
						<li><a href="#">Sign Up Now</a></li>
						<li><a href="#">Food and Drink</a></li>
						<li><a href="#">Private, secure, spam-free</a></li>
						<li><a href="#">Sports</a></li>
						<li><a href="#">School</a></li>
					</ul>
				</aside>
				<aside class="widget col-lg-4 col-md-4 col-sm-6 widget_categories">
					<div class="widget-section-title"> <strong class="title">Contributing</strong> </div>
					<ul>
						<li><a href="#">Crowdfunder API - Beta</a>
						<li><a href="#">How crowdfunding works</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Creating a project</a></li>
						<li><a href="#">Guides</a></li>
						<li><a href="#">Supporting a project</a></li>
						<li><a href="#">Blog</a></li>
						<li><a href="#">Guidelines</a></li>
						<li><a href="#">Contact</a></li>
						<li><a href="#">Jobs</a></li>
						<li><a href="#">Partners</a></li>
					</ul>
				</aside>
			</div>
		</div>
	</footer>
	<!--// Footer Widget //--> 
	
	
	
</div>

<!-- jQuery (necessary JavaScript) --> 
<script src="assets/scripts/jquery.js"></script> 
<script src="assets/scripts/bootstrap.min.js"></script> 
<script src="assets/scripts/modernizr.js"></script>
<script src="assets/scripts/menu.js"></script> 
<script src="assets/scripts/functions.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="assets/scripts/functions.js"></script>
  <script>
  $(function() {
	jQuery("#slider").slider({
      range: "min",
      min: 1,
      max: 100,
      slide: function(event, ui) {
        jQuery('.slider-value input').val(ui.value);
      },
  });  
	  
    //$( "#slider" ).slider({
//		change: function(event, ui) { 
//			jQuery('.slider-value input').val(ui.value); 
//		} 
//	});
  });
</script>
<script type="text/javascript" language="javascript">
function sum1(e){   
        var num1=document.getElementById("money1").value;   
        var num2=document.getElementById("money2").value;   
        if(isNaN(num1)){   
            alert("Invalid Input in Slider!");   
        }else{   
            if(isNaN(num2)){   
                alert("Invalid Input in Textbox!");   
            }else{   
                var num11=parseFloat(num1);   
                var num22=parseFloat(num2);   
                var num3=num11+num22;   
                document.getElementById("totalmm").value=num3;   
            }   
        }   
           
    }   
</script>
<script>
$('.detail-tabs').tab('show');
$('.tab-pane').addClass('fade in');
</script>
</body>
</html>