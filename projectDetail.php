<?php 
session_start();
if(!isset($_SESSION['loginname'])){
	echo '<script language=javascript>window.location.href="loginremind.html"</script>';

}
$GLOBALS['loginname']=$_SESSION['loginname'];
$GLOBALS['p_id']=$_GET['pid'];
$pid=$GLOBALS['p_id'];
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());


     $check_log="SELECT * FROM log WHERE loginname='{$_SESSION['loginname']}' AND way='look'";
     $result_c=@mysqli_query($connection, $check_log) or die('Query failed: ' . @mysqli_error());
     $check_res=mysqli_fetch_array($result_c);
     if($check_res==NULL){
     	$log_insert="INSERT INTO log (way,loginname,action) VALUES ('look','{$_SESSION['loginname']}','{$pid}')";
     	@mysqli_query($connection, $log_insert);
     }else{
     	$log_update="UPDATE log SET action='{$pid}' WHERE loginname='{$_SESSION['loginname']}' AND way='look'";
     	@mysqli_query($connection, $log_update);
     }

$query=$connection->prepare("SELECT * FROM project WHERE pid=?");
$query->bind_param("s",$para);
$para=$pid;
$query->execute();
$result=$query->get_result();
$line = @mysqli_fetch_array($result, @MYSQL_ASSOC);

$max_amount=$line['max'];
$get_amount="SELECT sum(amount) AS sum FROM fund WHERE pid={$pid} GROUP BY pid";
$cur_amount_res=@mysqli_query($connection,$get_amount);
$cur_amount_res_data=@mysqli_fetch_array($cur_amount_res,@MYSQL_ASSOC);
$cur_amount=$cur_amount_res_data['sum'];
$percentage=100*$cur_amount/$max_amount;

$GLOBALS['p_pname']=$line['pname'];
$GLOBALS['p_loginname']=$line['loginname'];
$GLOBALS['p_description']=$line['pdescription'];
$GLOBALS['p_min']=$line['min'];
$GLOBALS['p_max']=$line['max'];
$GLOBALS['p_posttime']=$line['posttime'];
$GLOBALS['p_deadline']=$line['deadline'];
$GLOBALS['p_comptime']=$line['comptime'];
$GLOBALS['p_status']=$line['pstatus'];
$GLOBALS['p_raised']=$cur_amount;
$GLOBALS['p_percent']=$percentage;
$GLOBALS['p_id']=$line['pid'];
$GLOBALS['p_img']=$line['pimg'];

$ploginname=$GLOBALS['p_loginname'];
$querypu=$connection->prepare("SELECT * FROM users WHERE loginname=?");
$querypu->bind_param("s",$parammp);
$parammp=$ploginname;
$querypu->execute();
$resultpu=$querypu->get_result();
$linepx = @mysqli_fetch_array($resultpu, @MYSQL_ASSOC);
$GLOBALS['puimg']=$linepx['uimg'];

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



function Project_percent(){
    echo htmlspecialchars($GLOBALS['p_percent']);
}
function Project_raised(){
    echo htmlspecialchars($GLOBALS['p_raised']);
}
function Project_name(){
    echo htmlspecialchars($GLOBALS['p_pname']);
}
function Project_user(){
    echo htmlspecialchars($GLOBALS['p_loginname']);
}
function Project_description(){
    echo htmlspecialchars($GLOBALS['p_description']);
}
function Project_min(){
    echo htmlspecialchars($GLOBALS['p_min']);
}
function Project_max(){
    echo htmlspecialchars($GLOBALS['p_max']);
}
function Project_posttime(){
    echo htmlspecialchars($GLOBALS['p_posttime']);
}
function Project_deadline(){
    echo htmlspecialchars($GLOBALS['p_deadline']);
}
function Project_comptime(){
    echo htmlspecialchars($GLOBALS['p_comptime']);
}
function Project_status(){
    echo htmlspecialchars($GLOBALS['p_status']);
}
function Project_img(){
    echo htmlspecialchars($GLOBALS['p_img']);
}
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
    <div class="mob-nav"></div>
    </div>
  </header>
  <!-- Header -->
	<!-- Main Content -->
	<main id="main-content">
		<div class="main-section">
			<section class="page-section contribute-sec" style="background:#f8f8f8;">
				<div class="container">
					<div class="row">
						<div class="section-fullwidth col-lg-12">
							<div class="cs-content-holder">
								<div class="row">
									<div class="post-detail">
										<div class="main-heading col-lg-12">
											<h1><?php Project_name();?></h1>
										</div>
										<div class="cause-detail">
											<div class="col-lg-9"><figure>
												<?php
                                                 if($GLOBALS[p_img]==NULL){
                                                 	echo "<img src='assets/extra-images/detail-img.jpg' alt=''>";
                                                 }else{
                                                 	echo "<img src='".$GLOBALS[p_img]."' alt=''>";
                                                 }
												?>
												</figure>
											</div>
											<div class="col-lg-3 col-md-3 col-sm-6">
												<div class="price-area">
													<span class="price-raised"><span>$<?php Project_raised();?></span> raised</span>
													<span class="price-goal">Max:$<?php Project_max();?> Min:$<?php Project_min();?></span>
												</div>
												<span class="bar">
												<?php
                                                 if($GLOBALS[p_percent]>100){
                                                 	echo "<span style='width:100%;'>";
                                                 }else{
                                                 	echo "<span style='width:".$GLOBALS[p_percent]."%;'>";
                                                 }
												?>
													
												</span></span>
												<span class="fund"><?php Project_percent();?>% Funded</span>
												<a href="donate.php?pid=<?php echo $GLOBALS['p_id'];?>" class="cs-btn"><span>Contribute now</span></a>
                                                <?php 
												include("mysqlconnect.php");
												$judgeLike="select * from likes where loginname='".$GLOBALS['loginname']."' and pid='".$GLOBALS['p_id']."'";
												$result=mysqli_query($connection,$judgeLike) or die ("Couldn't execute query: " . mysqli_error());
												if($result->num_rows==0){
												echo "<button type=\"button\" id=\"like\" class=\"cs-btn\" style=\"width: 260px; height: 50px;\" onclick=likeProject(\"".$GLOBALS['p_id']."\")><span>Like</span></button>";}
                                                else{
                                                	echo "<button type=\"button\" id=\"like\" class=\"cs-btn\" style=\"width: 260px; height: 50px;\" onclick=\"#\")><span>Liked</span></button>";
                                                }
                                                ?>
												
												<div class="detail-list">
													<ul>
														<li><i class="icon-clock7 cscolor"></i><a href="#">Deadline: <?php Project_deadline();?></a></li>
														<li><i class="icon-map-marker cscolor"></i><a href="#"><?php Project_status();?></a></li><li>


<?php 
$pid=$GLOBALS['p_id'];
//Test database connection
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());
//Check wether keyword is null if so then display all products esle just display relevent
$query= "SELECT * FROM tag WHERE pid='{$pid}'";
$result=@mysqli_query($connection, $query) or die('Query failed: ' . @mysql_error());
while ($line = @mysqli_fetch_array($result, @MYSQL_ASSOC)) {
    echo "<div class='div10086'><form method='POST' action='projects.php' theme='simple' >";
    echo "<input hidden name='category' value='".$line['catname']."'>";
    echo "<input type='submit'  value='".$line['catname']."'>";
    echo "</form></div>";
}
?></li><br>



														
													</ul>
													<div class="user-info">
														<figure><img alt="" src="<?php echo $GLOBALS['puimg'];?>" draggable="false"></figure>
														<span class="cs-author">
															<span>Created By</span>
															<a href="userProfile.php?view_user=<?php echo $GLOBALS['p_loginname']?>"><?php Project_user();?></a>
														</span>
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
			</section>
			<section class="page-section tab-sec">
				<div class="container">
					<div class="row">
						<div class="section-fullwidth col-lg-12">
							<div class="cs-content-holder">
								<div class="row">
									<div class="page-content col-lg-9">
										<div class="post-sec">
											<div class="row">
												<div class="col-lg-12">
												<div class="detail-tabs">
				
												  <!-- Nav tabs -->
												  <ul class="nav nav-tabs" role="tablist">
													<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
													<!-- <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Contributions</a></li> -->
													<li role="presentation"><a href="#comments" aria-controls="messages" role="tab" data-toggle="tab">Comments</a></li>
												
													<li role="presentation"><a href="#messages" aria-controls="settings" role="tab" data-toggle="tab">Updates</a></li>
												  </ul>
												   
												  <!--Description-->
												  <!-- Tab panes -->
												  <div class="tab-content">
													<div role="tabpanel" class="tab-pane active" id="home">
														<div class="post-block summary-sec rich_editor_text">
															<h2>Project Description</h2>
															
															<p><?php Project_description();?></p>
															<figure>
																<img src="assets/extra-images/tab1.jpg" alt="#">
															</figure>
															
															<!--<div class="tags">
																<i class="icon-tag7 cs-bgcolor"></i>
																<ul>
																	<li><a href="#">Art</a></li>
																	<li><a href="#">Craft</a></li>
																	<li><a href="#">Photos</a></li>
																	<li><a href="#">Colors</a></li>
																	<li><a href="#">People</a></li>
																	<li><a href="#">Thanks</a></li>
																</ul>
															</div>-->
														</div>
													</div>
													
													<!--Comment-->
													<div role="tabpanel" class="tab-pane" id="comments">
														<div id="comment">
														  <div class="cs-section-title"><h2>Comments</h2></div><ul>
<?php 
$pid=$GLOBALS['p_id'];
//Test database connection
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());
$query3= "SELECT * FROM projectcomments WHERE pid='{$pid}'";
$result3=@mysqli_query($connection, $query3) or die('Query failed: ' . @mysql_error());
while ($line3 = @mysqli_fetch_array($result3, @MYSQL_ASSOC)) {
    $pccontent=htmlspecialchars($line3['pcomment']);
    $pctime=$line3['pctime'];
    $pcuser=$line3['loginname'];
    $sqlst="SELECT * FROM users WHERE loginname='{$pcuser}'";
    $result4=@mysqli_query($connection, $sqlst) or die('Query failed: ' . @mysql_error());
    $line4=@mysqli_fetch_array($result4, @MYSQL_ASSOC);
    $pcuimg=$line4['uimg'];

    echo "<li id='li-comment-1'>
			<div id='comment-1' class='thumblist'>
				<ul>
					<li>
						<figure> <a href='#''><img src='".$pcuimg."' alt='#''></a> </figure>
							<div class='text-box'>
								<a class='comment-reply' href='#''><i class='icon-play'></i>Reply</a>
									<a href='userProfile.php?view_user=".$pcuser."'><h4>".$pcuser."</h4></a>
									<time datetime='2011-01-12'>".$pctime."</time>
										<p>".$pccontent."</p>
							</div>
					</li>
				</ul>
			</div>
		 </li>";


}
?>
														  <!-- Ul Start -->
														  
															<li id="li-comment-1">
															  <div id="comment-1" class="thumblist">
																<ul>
																  <li>
																	<figure> <a href="#"><img src="assets/extra-images/img-coment2.png" alt="#"></a> </figure>
																	<div class="text-box">
																	<a class="comment-reply" href="#"><i class="icon-play"></i>Reply</a>
																	  <h4>Sunshine Agency</h4>
																	  <time datetime="2011-01-12">September 23, 2014, 08:59PM</time>
																	  <p>Laughed wow lighted or harmful one beyond more ostrich lost impetuously robin fallaciously hello dolphin a flimsily nightingale quail underneath dear much cut essentially oppressively up and thus meretricious immense bet due egret conclusive that excepting with much through dear well kept.</p>
																	</div>
																  </li>
																</ul>
															  </div>
															</li>
															<!-- #comment-## -->
															<li id="li-comment-52">
															  <div id="comment-52" class="thumblist">
																<ul>
																  <li>
																	<figure> <a href="#"><img src="assets/extra-images/img-coment1.png" alt="#"></a> </figure>
																	<div class="text-box">
																	<a class="comment-reply" href="#"><i class="icon-play"></i>Reply</a>
																	  <h4>James Warson</h4>
																	  <time datetime="2011-01-12">September 23, 2014, 08:59PM</time>
																	  <p>Laughed wow lighted or harmful one beyond more ostrich lost impetuously robin fallaciously hello dolphin a flimsily nightingale quail underneath dear much cut essentially oppressively up and thus meretricious immense bet due egret conclusive that excepting with much through dear well kept.</p>
																	</div>
																  </li>
																</ul>
															  </div>
															</li>
															<!-- #comment-## -->
														  </ul>
														</div>
														<!--sendMessage-->
														<div class="comment-respond" id="respond">
														  <h2>Leave us a comment</h2>
														  <form class="comment-form contact-form" id="commentform" method=POST action=project_process.php>
														    <input hidden name='p_id' value='<?php echo $GLOBALS['p_id']; ?>'>
														    <input hidden name='way' value='pjc'>
															<p class="comment-form-comment fullwidt">
																<label>
																  <i class="icon-comments-o"></i>
																  <textarea name="pcomment" placeholder="Enter Message"></textarea>
																</label>
															</p>
															<p class="form-submit">
																<input type="submit" value="Submit Message" name="submit" class="form-style csbg-color">
															</p>
														  </form>
														</div>
													</div>

											        <!-update-->
											        	<div role="tabpanel" class="tab-pane" id="messages">
														<div class="post-block ">

															<h2>Recently Updates</h2>
															 
															  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php 
$pid=$GLOBALS['p_id'];
//Test database connection
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());

$query= "SELECT * FROM Updates WHERE pid='{$pid}'";
$result=@mysqli_query($connection, $query) or die('Query failed: ' . @mysql_error());

while ($line = @mysqli_fetch_array($result, @MYSQL_ASSOC)) {
    $ucontent=$line['ucontent'];
    $utime=$line['utime'];
    $uid=$line['uid'];

    echo "<div class='panel panel-default'>
			<div class='panel-heading' role='tab' id='h".$uid."'>
				<h4 class='panel-title'>
					<a role='button' data-toggle='collapse' data-parent='#accordion' href='#".$uid."' aria-expanded='true' aria-controls='".$uid."'>
						
							".$utime."
					</a>
				</h4>
			</div>
			<div id='".$uid."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='h".$uid."'>
				<div class='panel-body'>
					<p><span style='font-weight:bold'>".$ucontent."</span><br><br></p><div role='tabpanel' class='tab-pane' ><div id='comment'><ul>";
    $query2="SELECT * FROM updatescomments WHERE uid='{$uid}'";
    $result2=@mysqli_query($connection, $query2) or die('Query failed: ' . @mysql_error());
    while ($line2 = @mysqli_fetch_array($result2, @MYSQL_ASSOC)){
            $uccontent=htmlspecialchars($line2['ucomment']);
            $uctime=$line2['uctime'];
            $ucuser=$line2['loginname'];
            $sqlstUC="SELECT * FROM users WHERE loginname='{$ucuser}'";
            $result5=@mysqli_query($connection, $sqlstUC) or die('Query failed: ' . @mysql_error());
            $line5=@mysqli_fetch_array($result5, @MYSQL_ASSOC);
            $ucuimg=$line5['uimg'];
    echo "<li >
			<div  class='thumblist'>
				<ul>
					<li>
					<figure> <a href='#''><img src='".$ucuimg."' alt='#''></a> </figure>
						<div class='text-box'>
							<a class='comment-reply' href='#''><i class='icon-play'></i>Reply</a>
								<a href='userProfile.php?view_user=".$ucuser."'><h4>".$ucuser."</h4></a>
								<time datetime='2011-01-12'>".$uctime."</time>
								<p>".$uccontent."</p>
						</div>
					</li>
				</ul>
			</div>
		 </li>";
    }
    echo "</ul></div></div><div class='comment-respond' id='respond'>
				<h2>Comment on this Update</h2>
					<form class='comment-form contact-form' id='commentform' method=POST action=project_process.php>
					    <input hidden name='p_id' value='".$pid."'>
					    <input hidden name='u_id' value='".$uid."'>
						<input hidden name='way' value='upc'>
						<p class='comment-form-comment fullwidt'>
							<label>
								<i class='icon-comments-o'></i>
									<textarea name='ureply' placeholder='Enter Message'></textarea>
							</label>
						</p>
						<p class='form-submit'>
							<input type='submit' value='Submit Message' name='submit' class='form-style csbg-color'>
						</p>
					</form>
			</div>";

				echo "</div>
			</div>
		</div>";
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
									<aside class="page-sidebar col-lg-3">
									</aside>
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
<script>
   function likeProject(pid){
       var xmlhttp=new XMLHttpRequest();
       xmlhttp.onreadystatechange=function(){
           if(this.readyState=4&&this.status==200){
               document.getElementById("like").innerHTML="Liked";
           }
       };
       xmlhttp.open("POST","likeProject.php?pid="+pid,true);
       xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
       xmlhttp.send();
   }
</script>
<script src="assets/scripts/functions.js"></script>
<script>
$('.detail-tabs').tab('show');
$('.tab-pane').addClass('fade in');
</script>
</body>
</html>