<?php
session_start();
if(!isset($_SESSION['loginname'])){
	echo '<script language=javascript>window.location.href="loginremind.html"</script>';
}
$loginname=$_SESSION['loginname'];
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());
$queryu=$connection->prepare("SELECT * FROM users WHERE loginname=?");
$queryu->bind_param("s",$paramm);
$paramm=$loginname;
$queryu->execute();
$resultu=$queryu->get_result();
$linex = @mysqli_fetch_array($resultu, @MYSQL_ASSOC);

$GLOBALS['username']=$loginname;
$GLOBALS['uimg']=$linex['uimg'];
$GLOBALS['email']=$linex['email'];
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
<link href="assets/css/responsive.css" rel="stylesheet">
<link href="assets/css/menu.css" rel="stylesheet">
<link href="assets/css/color.css" rel="stylesheet">
<link href="assets/css/iconmoon.css" rel="stylesheet">
<link href="assets/css/themetypo.css" rel="stylesheet">
<link href="assets/css/widget.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
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
                  <li><a href="myProject.php"><i class="icon-flag5"></i>My Projects</a></li>
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
    </div>

    <div class="mob-nav"></div>
    </div>
  </header>
  <!-- Header -->
	
	<!-- Main Content -->
	<main id="main-content">
		<div class="main-section">
			<div class="page-section">
				<div class="profile-pages">
					<div class="container">
						<div class="row">
							<div class="section-fullwidth col-lg-12">
								<div class="cs-content-holder">
									<div class="row">
										<div class="cause-holder">
											<div class="col-lg-12">
											</div>
											<div class="col-lg-12">
												<div class="profile-block">
													<ul class="scroll-nav">
															<li><a href="myProject.php"><i class="icon-star-o"></i>My Projects</a></li>

															<li><a href="myDonations.php"><i class="icon-money"></i>My Donations</a></li>

															<li class="active"><a href="createProject.php"><i class="icon-gear"></i>Create New</a></li>

															<li><a href="myProfile.php"><i class="icon-gear"></i>Profile Settings</a></li>

															<li><a href="myFollowing.php"><i class="icon-save"></i>My Following</a></li>
														</ul>

													<!-Myproject-->
													<form method="POST" enctype="multipart/form-data" action="createProjectDB.php">
													<div class="cs-profile-area">
															<div class="cs-title no-border">
																<h3>Create a new Project</h3>
															</div>
															<div class="cs-profile-holder">
														<ul class="cs-element-list has-border">
																	<li>
																		<label>Project Name</label> 
																		<div class="fields-area">
																			<div class="field-col col-md-12">
																				<input type="text" name="name" required="required"></input>
																			</div>
																		</div>
																	</li>
																	<li>
																		<label>Project Tag</label>
																		<div class="fields-area">
																			<div class="field-col col-md-12">
																				<!-- <textarea></textarea> -->
																				<input type="text" name="category" required="required"></input>
																			</div>
																		</div>
																	</li>
																</ul>
																<ul class="cs-element-list has-border">
																	<li>
																		<label>Min money expected</label>
																		<div class="fields-area">
																			<div class="field-col col-md-12">
																				 <input type="number"  name="min" id="min"  required="required"></input>
																			</div>
																		</div>
																	</li>
																	<li>
																		<label>Max money expected</label>
																		<div class="fields-area">
																			<div class="field-col col-md-12">
																				 <input type="number"  name="max" id="max"  required="required"></input>
																			</div>
																		</div>
																	</li>
																</ul>
																<ul class="cs-element-list has-border">
																	<li>
																		<label>Dead line</label>
																		<div class="fields-area">
																			<div class="field-col col-md-2">
																				 <input type="date"  name="ddl" id="ddl" required="required"></input>
																			</div>
																		</div>
																	</li>
																	<li>
																		<label>Complete time</label>
																		<div class="fields-area">
																			<div class="field-col col-md-2">
																				 <input type="date"  name="comptime" id="comptime" required="required"></input>
																			</div>
																		</div>
																	</li>
																</ul>

																<ul class="cs-element-list has-border">
																	<li>
																	  <label>Add Image</label>
																	  <div class="fields-area">
																		<div class="field-col col-md-12">
																		   <input type="text"  name="image" id="image" />
																		   <span class="char-remain">Image URL Address</span>
																		</div>
																	  </div>
																	</li>
																</ul>

																<ul class="cs-element-list has-border">
																	<li>
																	  <label>Description</label>
																	  <div class="fields-area">
																		<div class="field-col col-md-12">
																		  <textarea name="description" id="description" rows="4" cols="25" required="required"></textarea>
																		</div>
																	  </div>
																	</li>
																</ul>

																<ul class="cs-element-list has-border paypal">
																	<li>
																		<label>Paypal Setting</label>
																		<div class="fields-area">
																			<div class="field-col col-md-6">
																				<input type="email">
																				<span class="char-remain">Strong orca harshly exuberantly oh bird wherever </span>
																			</div>
																		</div>
																	</li>
																</ul>

																<ul class="cs-element-list term-condition-area">
																	<li>
																		<label>Terms &amp;<br> Conditions</label>
																		<div class="fields-area">
																			<div class="field-col col-md-12">
																				<p>Asome decently militantly versus that a enormous less treacherous genially well upon until fishy audaciously where fabulously underneath toucan armadillo far toward illustratively flawlessly shark much a emoted hey tersely pointedly much that hey quetzal up trenchant abundant made alas wildebeest overate overhung during busily burst as jeez much because more added on some thrust out.</p>
																				<div class="checkbox-area">
																					<input type="checkbox" id="conditions">
																					<label for="conditions">Accept <a href="#">terms and conditions</a></label>
																				</div>
																			</div>
																		</div>
																	</li>
																</ul>
																<ul class="cs-element-list cs-submit-form">
																	<li>
																		<div class="fields-area">
																			<div class="field-col col-md-4">
																				<input class="csbg-color cs-btn" type="submit" name="submit" value="Create New Project">
																			</div>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
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
	<!--// CopyRight //-->
	<!--// CopyRight //-->
	
</div>

<!-- jQuery (necessary JavaScript) --> 
<script src="assets/scripts/jquery.js"></script> 
<script src="assets/scripts/bootstrap.min.js"></script> 
<script src="assets/scripts/modernizr.js"></script>
<script src="assets/scripts/menu.js"></script>
<script src="assets/scripts/jquery.flexslider-min.js"></script> 
<script src="assets/scripts/functions.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
      jQuery('.edit-area').find('.cs-table-holder').hide();
      jQuery('.edit-area').on('click', '.coll', function(e){
        e.preventDefault();
        var target = jQuery(this).parents('.edit-area').find('.cs-table-holder');
        var active = jQuery(this);
        if(active.hasClass('active')){
          active.removeClass('active');
          target.slideUp();
        }else{
          active.addClass('active');
          target.slideDown();
        }
      });
    });
</script>
</body>
</html>