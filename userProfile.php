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
	<main id="main-content">
		<div class="main-section user-detail2">
			<div class="page-section bg-author">
				<div class="container">
					<div class="row">
						<div class="section-fullwidth col-lg-12">
							<div class="cs-content-holder">
								<div class="row">
									<div class="col-lg-12">
										<div class="author-info">
											<?php
													include("mysqlconnect.php");
													//$username=$_GET["username"];
													$username=$_GET['view_user'];
													$GLOBALS['user']=$username;
													$myname=$_SESSION['loginname'];

													$getUserInfo="select uname,email,hometown,interests,phone,uimg from users where loginname='$username'"; 
													$result=mysqli_query($connection,$getUserInfo) or die ("Couldn't execute queryInsert: " . mysqli_error());
												    $row = @mysqli_fetch_array($result,MYSQLI_ASSOC);

												    $name=$row["uname"];
												    $email=$row["email"];
												    $hometown=$row["hometown"];
												    $interest=$row["interests"];
												    $phone=$row["phone"];
												    $image=$row["uimg"];

											echo "<figure>";
												echo "<img style=\"border-radius:40%  \"  height=\"180\" width=\"180\" src=\"$image\" alt=\"\">";
											echo "</figure>";
											echo "<div class=\"info-text\">";
												echo "<div class=\"heading-sec\">";
												
													echo "<h2>$name&nbsp&nbsp&nbsp&nbsp&nbsp</h2>"; 
													$query="select * from follow where loginA='$username' and loginB='$myname'";
                                                    $result=mysqli_query($connection,$query) or die ("Couldn't execute query: " . mysqli_error());
                                                    if($result->num_rows==0){
                                                       echo " <button type=\"button\" id=\"follow\" class=\"btn btn-primary \" onclick=followUser(\"$username\")>Follow</button>";
                                                    }else{
                                                       echo " <button type=\"button\" id=\"follow\" class=\"btn btn-primary \">Followed</button>"; }
													
											         
												echo "</div>";
												echo "<ul>";
													echo "<li><i class=\"cscolor icon-map-marker\"></i>  $hometown , United States</li>";
													echo "<li><i class=\"cscolor icon-phone8\"></i>$phone</li>";
													echo "<li><i class=\"cscolor icon-mail6\"></i>$email</li>";
													echo "<li><i class=\"cscolor icon-heart-o\"></i>$interest Lover</li>";
												echo "</ul>";
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="page-section" style="padding:0;">
				<div class="container">
					<div class="row">
						<div class="section-fullwidth">
							<div class="cs-content-holder">
								<div class="row">
									<div class="col-lg-12">
										<div class="detail-tabs">
											<ul role="tablist" class="nav nav-tabs">
												<li role="presentation" class=""><a data-toggle="tab" role="tab" aria-controls="profile" href="#profile" aria-expanded="false">Created (6)</a></li>
											  </ul>
											<div class="tab-content">
												<div id="home" class="tab-pane active fade in" role="tabpanel">
													<div class="listing_grid">
														<div class="row">
															<?php

																include("mysqlconnect.php");
														  	    $getMyProject="select pid,pname,min,max,deadline,pstatus,pimg from project where loginname='{$GLOBALS['user']}';";
														  
														  	    $result=mysqli_query($connection,$getMyProject) or die ("Couldn't execute queryInsert: " . mysqli_error());
														  	    while($row = @mysqli_fetch_array($result,MYSQLI_ASSOC)){
														  		$pid=$row['pid'];
														  		$pname=$row['pname'];
														  		$min=$row['min'];
														  		$max=$row['max'];
														  		$deadline=$row['deadline'];
														  		$pstatus=$row['pstatus'];
														  		$image=$row['pimg'];

														  		$getCurSum="select sum(amount) as sum from fund where pid={$pid} group by pid";
														  		$curSumResult=mysqli_query($connection,$getCurSum) or die ("Couldn't execute queryInsert: " . mysqli_error());
														  		$curSumRow=@mysqli_fetch_array($curSumResult,MYSQLI_ASSOC);
														  		$curSum=$curSumRow['sum'];

														  		$percentage=100*round($curSum/$max);
														  		

															echo "<article class=\"col-lg-3 col-md-3 col-sm-6\">";
																echo "<div class=\"directory-section\">";
																	echo "<div class=\"cs_thumbsection\">";
																		echo "<figure><a href=\"#\"><img alt=\"#\" src=\"$image\"></a></figure>";
																	echo "</div>";
																	echo "<div class=\"content_info\">";
																		echo "<div class=\"title\">";
																			echo "<h3><a href=\"#\">$pname</a></h3>";
																			echo "<span class=\"addr\">$pstatus</span> </div>";
																		echo "<div class=\"dr_info\">";
																			echo "<ul>";
																				echo "<li> <i class=\"cscolor icon-target5\"></i> $$min goal </li>";
																				echo "<li> <i class=\"cscolor icon-clock7\"></i> $deadline </li>";
																			echo "</ul>";
																			echo "<span class=\"bar\"><span style=\"width:$percentage%;\"></span></span>";
																			echo "<div class=\"detail\"> <span class=\"fund\">$percentage% Funded</span></div>";
																		echo "</div>";
																	echo "</div>";
																echo "</div>";
															echo "</article>";
														}
															?>


															
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
<script>
   function followUser(user){
       var xmlhttp=new XMLHttpRequest();
       xmlhttp.onreadystatechange=function(){
           if(this.readyState=4&&this.status==200){
               document.getElementById("follow").innerHTML="Followed";
           }
       };
       xmlhttp.open("POST","followUser.php?username="+user,true);
       xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
       xmlhttp.send();
   }
</script>
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