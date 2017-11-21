<?php
session_start();
date_default_timezone_set('America/New_York');
//Get parameters by post method from previous html
unset($_SESSION['fault_msg']);
$pid = $_POST['pid'];
$money= $_POST['totalm'];
$username=$_SESSION['loginname'];
$time = date("y-m-d h:i:s");
//Test database connection
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());
//Check wether input is valid
if(!is_numeric($money)){
	$_SESSION['fault_msg']="Your input should be numetic!";
}else if($money<=0){
	$_SESSION['fault_msg']="Money should be greater than 0!";
}

if(isset($_SESSION['fault_msg'])){
    echo '<script language=javascript>window.location.href="projecterror.php"</script>'; 
}else{
	$sqlcheck="SELECT pstatus FROM project WHERE pid='{$pid}'";
	$result=mysqli_query($connection,$sqlcheck);
	$line=mysqli_fetch_array($result);
	switch ($line['pstatus']){
		case 'Completed':
		   $_SESSION['fault_msg']="Donation failed! The project has been completed!";break;
		case 'Failed':
		   $_SESSION['fault_msg']="Donation failed! The project has failed!";break;
        case 'Executing':
           $_SESSION['fault_msg']="Donation failed! The project has been executing!";break;
        default:
		   # code...
		   break;
	}
}

if(isset($_SESSION['fault_msg'])){
    echo '<script language=javascript>window.location.href="projecterror.php"</script>'; 
}else{
	$query="call inserttofund('{$username}', '{$pid}', '{$money}')";
	mysqli_query($connection,$query);
	echo "<script language=javascript>window.location.href='donate3.php?pid=".$pid."'</script>";
}
// Free resultset
@mysqli_free_result($result);
// Closing connection
@mysqli_close($connection);
//Store the username in the session

?>
