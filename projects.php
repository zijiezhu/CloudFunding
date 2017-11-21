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
<title>Campaigs - Home Page</title>

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
        <nav class="navigation">
        </nav>
      </div>
      <div class="right-side">
        <div class="cs-search-block">
          <form role="form" method="POST" action="projects.php">
            <input type="text" id="s" name="keyword" placeholder="Search Project" onfocus="if(this.value =='Search Project') { this.value = ''; }" onblur="if(this.value == '') { this.value ='Search Project'; }" class="form-control">
            <label>
              <input type="submit" onclick=>
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
  <!-- Header -->    
	<div class="cs-banner">
		<div class="flexslider">
			<ul class="slides">
				<li>
					<figure>
						<img src="assets/extra-images/banner.jpg" alt="#">
						<figcaption>
							<div class="text">
								<h2>Explore projects, anywhere &amp; everywhere! </h2>
								<div class="spreator5"></div>
								<span>People just like you have used Razoo to create more than 90,000 fundraising websites<br>
and to give over $250,000,000 to the causes they care about.</span>
								
							</div>
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="assets/extra-images/banner.jpg" alt="#">
						<figcaption>
							<div class="text">
								<h2>Explore projects, anywhere &amp; everywhere! </h2>
								<div class="spreator5"></div>
								<span>People just like you have used Razoo to create more than 90,000 fundraising websites<br>
and to give over $250,000,000 to the causes they care about.</span>
								
							</div>
						</figcaption>
					</figure>
				</li>
			</ul>
		</div>
	</div>
	<!-- Main Content -->
	<main id="main-content">
		<div class="main-section">
			<div class="page-section">
				<div class="container">
					<div class="row">
						<div class="section-fullwidth col-lg-12">
							<div class="cs-content-holder">
								<div class="row">
									<div class="main-heading top-center">
										<h1>The world’s funding engine.</h1>
										<strong class="title">We're distributing millions of dollars every week to campaigners around the world. Whether you're raising 500 dollars or 5 million euros.</strong> </div>
									<div class="col-lg-4 col-md-4 col-sm-6">
										<article class="cs-services modren top-center ">
											<figure><img src="assets/extra-images/ico-services1.png" alt=""></figure>
											<div class="text">
												<h2>Create Your Page</h2>
												<p>So sarcastically strung dazedly crab dear good-ness exuberant lightly fish so hey underneath to excluding apt burst walked gosh pugnaciously hello onto ouch lantern.</p>
												<a href="#" class="read-more">Read More</a>
											</div>
										</article>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-6">
										<article class="cs-services modren top-center ">
											<figure><img src="assets/extra-images/ico-services2.png" alt=""></figure>
											<div class="text">
												<h2>Share Your Story</h2>
												<p>So sarcastically strung dazedly crab dear good-ness exuberant lightly fish so hey underneath to excluding apt burst walked gosh pugnaciously hello onto ouch lantern.</p>
												<a href="#" class="read-more">Read More</a>
											</div>
										</article>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-6">
										<article class="cs-services modren top-center ">
											<figure><img src="assets/extra-images/ico-services3.png" alt=""></figure>
											<div class="text">
												<h2>Raise Money</h2>
												<p>So sarcastically strung dazedly crab dear good-ness exuberant lightly fish so hey underneath to excluding apt burst walked gosh pugnaciously hello onto ouch lantern.</p>
												<a href="#" class="read-more">Read More</a>
											</div>
										</article>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="page-section">
				<div class="container">
					<div class="row">
						<div class="section-fullwidth col-lg-12">
							<div class="cs-content-holder">
								<div class="row" >
									<div >
												<aside class="page-sidebar col-lg-3">
										<div class="widget cs_directory_categories" >
											<div class="widget-section-title">
												<h4><i class="icon-globe4"></i>Main Diverse Categories</h4>
											</div>
											<ul class="menu">
												<li><form method=POST action=projects.php >
                                                <input hidden name="category" value="Education">
                                                <i class="icon-user9 cscolor"></i><input type="submit" value="Education"><span>Go</span></li></form>
                                                <li><form method=POST action=projects.php >
                                                <input hidden name="category" value="Chrity">
                                                <i class="icon-heart11 cscolor"></i><input type="submit" value="Chrity"><span>Go</span></li></form>
                                                <li><form method=POST action=projects.php >
                                                <input hidden name="category" value="Art">
                                                <i class="icon-brush2 cscolor"></i><input type="submit" value="Art"><span>Go</span></li></form>
												<li><form method=POST action=projects.php >
                                                <input hidden name="category" value="Bussiness">
                                                <i class="icon-circle-thin cscolor"></i><input type="submit" value="Bussiness"><span>Go</span></li></form>
                                                <li><form method=POST action=projects.php >
                                                <input hidden name="category" value="Sports">
                                                <i class="icon-key7 cscolor"></i><input type="submit" value="Sports"><span>Go</span></li></form>
												
											</ul>
										<div class="widget-section-title">
												<h4><br><i class="icon-globe4"></i>Recommend Tag</h4>
											</div>
											<ul class="menu">
												<li><form method=POST action=projects.php >
<?php
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());
$check_log="SELECT action FROM log WHERE loginname='{$_SESSION['loginname']}' AND way='cat'";
$result_c=@mysqli_query($connection, $check_log) or die('Query failed: ' . @mysqli_error());
$check_res=mysqli_fetch_array($result_c);
if($check_res==NULL){
     	echo"<input hidden name='category' value='Education'>
                    <i class='icon-user9 cscolor'></i><input type='submit' value='Education'><span>Go</span>";
     }else{
     	echo "<input hidden name='category' value='".$check_res['action']."'>
                    <i class='icon-user9 cscolor'></i><input type='submit' value='".$check_res['action']."'><span>Go</span>";
}
?>
                                                </li></form>
											</ul>
											<div class="widget-section-title">
												<h4><br><i class="icon-globe4"></i>Recent Search</h4>
											</div>
											<ul class="menu">
												<li><form method=POST action=projects.php >
<?php
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());
$check_log="SELECT action FROM log WHERE loginname='{$_SESSION['loginname']}' AND way='search'";
$result_c=@mysqli_query($connection, $check_log) or die('Query failed: ' . @mysqli_error());
$check_res=mysqli_fetch_array($result_c);
if(!$check_res==NULL){
     	echo "<input hidden name='keyword' value='".$check_res['action']."'>
                    <i class='icon-circle-thin cscolor'></i><input type='submit' value='".$check_res['action']."'><span>Go</span>";
}
?>
                                                </li></form>
                                                
												
											</ul>
											<div class="widget-section-title">
												<h4><br><i class="icon-globe4"></i>Recent Viewed Project</h4>
											</div>
											<ul class="menu">
												<li>
<?php
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());
$check_log="SELECT action FROM log WHERE loginname='{$_SESSION['loginname']}' AND way='look'";
$result_c=@mysqli_query($connection, $check_log) or die('Query failed: ' . @mysqli_error());
$check_res=mysqli_fetch_array($result_c);
if(!$check_res==NULL){
     	echo "<a href='projectDetail.php?pid=".$check_res['action']."'>View the Project Last Viewed</a>";
}
?>
                                                </li>
	
											</ul>
									</div>
										<!-- <div class="widget widget_advertisment"> <img src="assets/extra-images/adv2.jpg" alt=""> </div> -->
									</aside>
									<div class="page-content col-lg-9">
										<div class="listing_grid">
											<div class="row">
<?php 
$keyword=$_POST['keyword'];
$catname=$_POST['category'];
//Test database connection
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());
//Check wether keyword is null if so then display all products esle just display relevent
if($keyword==NULL&&$catname==NULL){
    $query= "SELECT pid,deadline,pname,loginname,max,pimg FROM project";
    $result=@mysqli_query($connection, $query) or die('Query failed: ' . @mysqli_error());
}
else if($catname==NULL){
    $query =$connection->prepare("SELECT distinct pid,deadline,pname,loginname,max,pimg FROM project Natural join tag where pdescription like ? or pname like ? or catname like ?");
    $query->bind_param("sss",$para1,$para2,$para3);
    $para1="%{$keyword}%";
    $para2="%{$keyword}%";
    $para3="%{$keyword}%";
    $query->execute();
    $result=$query->get_result();

     $check_log="SELECT * FROM log WHERE loginname='{$_SESSION['loginname']}' AND way='search'";
     $result_c=@mysqli_query($connection, $check_log) or die('Query failed: ' . @mysqli_error());
     $check_res=mysqli_fetch_array($result_c);
     if($check_res==NULL){
     	$log_insert="INSERT INTO log (way,loginname,action) VALUES ('search','{$_SESSION['loginname']}','{$keyword}')";
     	@mysqli_query($connection, $log_insert);
     }else{
     	$log_update="UPDATE log SET action='{$keyword}' WHERE loginname='{$_SESSION['loginname']}' AND way='search'";
     	@mysqli_query($connection, $log_update);
     }

} else{
    $query=$connection->prepare("SELECT pid,deadline,pname,loginname,max,pimg FROM project WHERE pid IN (SELECT pid FROM tag WHERE catname=?)");
    $query->bind_param("s",$para);
    $para=$catname;
    $query->execute();
    $result=$query->get_result();

    $check_log="SELECT * FROM log WHERE loginname='{$_SESSION['loginname']}' AND way='cat'";
     $result_c=@mysqli_query($connection, $check_log) or die('Query failed: ' . @mysqli_error());
     $check_res=mysqli_fetch_array($result_c);
     if($check_res==NULL){
     	$log_insert="INSERT INTO log (way,loginname,action) VALUES ('cat','{$_SESSION['loginname']}','{$catname}')";
     	@mysqli_query($connection, $log_insert);
     }else{
     	$log_update="UPDATE log SET action='{$catname}' WHERE loginname='{$_SESSION['loginname']}' AND way='cat'";
     	@mysqli_query($connection, $log_update);
     }

}

while ($line = @mysqli_fetch_array($result, @MYSQL_ASSOC)) {
	$pid=$line['pid'];
	$max_amount=$line['max'];
	$get_amount="SELECT sum(amount) AS sum FROM fund WHERE pid={$pid} GROUP BY pid";
	$cur_amount_res=@mysqli_query($connection,$get_amount);
	$cur_amount_res_data=@mysqli_fetch_array($cur_amount_res,@MYSQL_ASSOC);
	$cur_amount=$cur_amount_res_data['sum'];
	$percentage=100*$cur_amount/$max_amount;
    echo "<article class='col-lg-4 col-md-4 col-sm-6'>
		    <div class='directory-section'>
				<div class='cs_thumbsection'>";

    if($line['pimg']==NULL){
    	echo "<figure><img src='https://www.vetmed.wisc.edu/wp-content/uploads/2016/10/default.jpg' alt=''></figure>";
    }else{
        echo "<figure><img src='".$line['pimg']."' alt=''></figure>";
    }
    
				echo "</div>
					<div class='content_info'>
							<div class='title'>
									<h3><a href='projectDetail.php?pid=".$line['pid']."'>";echo $line['pname']; echo"</a></h3>
										<span class='addr'>";echo $line['loginname']; echo"</span> </div>
											<div class='dr_info'>
												<ul>
													<li> <i class='cscolor icon-target5'></i> $";echo $line['max']; echo" goal </li>
													<li> <i class='cscolor icon-clock7'></i> ";echo $line['deadline']; echo" </li>
												</ul>
												<span class='bar'>";
												if($percentage>100)
													echo "<span style='width:100%;'>";
												else
												{
													echo "<span style='width:".$percentage."%;'>";
												}
												echo "</span></span>
												<div class='detail'> <span class='fund'>".$percentage."% Funded</span> <a href='#' class='star icon-star'></a> </div>
															</div>";

    echo "</div></div></article>";
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
<script src="assets/scripts/jquery.flexslider-min.js"></script> 
<script src="assets/scripts/functions.js"></script>
<script >
	jQuery(window).load(function(){
		jQuery('.flexslider').flexslider({
			animation: "slide",
			controlNav: false,
			prevText:"<em class='icon-arrow-left10'></em>",
			nextText:"<em class='icon-arrow-right10'></em>",
			start: function(slider){
				jQuery('body').removeClass('loading');
			}
		});
	});
</script>
</body>
</html>