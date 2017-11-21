<?php
session_start();
date_default_timezone_set('America/New_York');
//Get parameters by post method from previous html
unset($_SESSION['fault_msg']);
$puser = $_POST['p_user'];
$pid = $_POST['p_id'];
$ureply= $_POST['ureply'];
$uid= $_POST['u_id'];
$way= $_POST['way'];
$pcomment= $_POST['pcomment'];
$username=$_SESSION['loginname'];
$time = date("y-m-d h:i:s");

//Test database connection
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());
//Check wether user has already exist
switch ($way) {
	case 'fol':
		{
	$checksql="SELECT * FROM follow WHERE loginA='{$username}' AND loginB='{$puser}'";
	$authentication1 = @mysqli_query($connection,$checksql) or die("failed to authenticate");
	$authenticate1=mysqli_fetch_array($authentication1);
	if($authenticate1!=NULL){
		$_SESSION['fault_msg']="You have followed the user!";
	}else{
      mysqli_query($connection,"INSERT INTO follow VALUES ('{$username}','{$puser}')");
	}
		}
		break;
	case 'lik':
	{
	$checksql="SELECT * FROM likes WHERE pid='{$pid}' AND loginname='{$username}'";
	$authentication2 = @mysqli_query($connection,$checksql) or die("failed to authenticate");
	$authenticate2=mysqli_fetch_array($authentication2);
	if($authenticate2!=NULL){
		$_SESSION['fault_msg']="You have liked the project!";
	}else{
      mysqli_query($connection,"INSERT INTO likes VALUES ('{$pid}','{$username}')");
	}
	}
	break;
	case 'upc':
	{
       if($ureply==NULL){$_SESSION['fault_msg']="You cannot add blank comment!";}
       else{
       	$query="INSERT INTO updatescomments VALUES ('{$uid}','{$time}','{$username}','{$ureply}')";
       	mysqli_query($connection,$query);
       }
	}
    break;
    case 'pjc':
    {
       if($pcomment==NULL){$_SESSION['fault_msg']="You cannot add blank comment!";}
       else{
       	$query="INSERT INTO projectcomments VALUES ('{$pid}','{$username}','{$time}','{$pcomment}')";
       	mysqli_query($connection,$query);
       }
    }
    	break;
	default:
		# code...
		break;
}


// Free resultset
@mysqli_free_result($result);
// Closing connection
@mysqli_close($connection);
//Store the username in the session

if(isset($_SESSION['fault_msg'])){
    echo '<script language=javascript>window.location.href="projecterror.php"</script>'; 
}else{
	//echo '<script language=javascript>window.location.href="../index.html"</script>';
}
?>
