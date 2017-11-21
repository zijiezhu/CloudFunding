<?php
//Get parameters by post method from previous html
$username = $_POST['name'];
$password = $_POST['password'];
$email=$_POST['email'];
echo $username;
//$uname=$_POST['realname'];
//$phone=$_POST['phone'];
//$hometown=$_POST['hometown'];
//$interests=$_POST['interests'];
//$credit=$_POST['credit'];
//Check input validation 
//Create session
session_start();
//Test database connection
include("mysqlconnect.php");
//Check wether user has already exist
$authentication = @mysqli_query($connection,"select loginname from users where loginname = '{$username}'")
or die("failed to authenticate");
//If user not exist in customer then insert the new customer name into the customer
$authenticate=mysqli_fetch_array($authentication);
if($authenticate!=NULL)
{
$_SESSION['fault_msg']="The login name has been registered!";
}else{
	//mysqli_query($connection,"INSERT INTO users VALUES ('{$username}', '{$uname}', '{$password}','{$email}','{$hometown}','{$interests}','{$credit}','{$phone}')");
	mysqli_query($connection,"insert into users(loginname,password,email )values ('{$username}','{$password}','{$email}')")or die ("Couldn't execute queryInsert: " . mysqli_error());
}

// Free resultset
@mysqli_free_result($result);
// Closing connection
@mysqli_close($connection);
//Store the username in the session
$_SESSION['loginname']=$username;
if(isset($_SESSION['fault_msg'])){
    echo '<script language=javascript>window.location.href="registererror.php"</script>'; 
}else{
	echo '<script language=javascript>window.location.href="projects.php"</script>';
}
?>
