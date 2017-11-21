<?php
//Get parameters by post method from previous html
$username = $_POST['username'];
$password = $_POST['password'];
//Check input validation 
//Create session
session_start();
if($username==NULL){
$_SESSION['fault_msg']="Login name can't be NULL!";
echo '<script language=javascript>window.location.href="loginerror.php"</script>';
}
else if($password==NULL){
$_SESSION['fault_msg']="Your password can't be NULL!";
echo '<script language=javascript>window.location.href="loginerror.php"</script>';
}
//Test database connection
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());
$stmt=$connection->prepare("select loginname,password from users where loginname = ?");
$stmt->bind_param("s",$para1);
$para1=$username;
$stmt->execute();

$authentication = $stmt->get_result();
//If user not exist in customer then insert the new customer name into the customer
$authenticate=mysqli_fetch_array($authentication);
if($username!=NULL&&$password!=NULL&&$authenticate==NULL)
{
$_SESSION['fault_msg']="The user has not been registered!";

}else if($authenticate['password']!=$password){
$_SESSION['fault_msg']="The user login name and password does not match!";

}
//Store the username in the session
$_SESSION['loginname']=$username;
if(isset($_SESSION['fault_msg'])){
    echo '<script language=javascript>window.location.href="loginerror.php"</script>'; 
}else{
	echo '<script language=javascript>window.location.href="index.php"</script>';
}

// Free resultset
@mysqli_free_result($authentication);

// Closing connection
@mysqli_close($connection);
?>
