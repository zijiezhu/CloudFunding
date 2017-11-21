<?php
session_start();
//Get parameters by post method from previous html
$username = $_POST['firstname'];
$password = $_POST['lastname'];
$uname=$_POST['realname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$hometown=$_POST['hometown'];
$interests=$_POST['interests'];
$credit=$_POST['credit'];
//Check input validation 
$pattern='/^[A-Za-z0-9_@\.]+$/';
if(!preg_match($pattern,$username)||!preg_match($pattern,$password)||!preg_match($pattern,$uname)||!preg_match($pattern,$email)||!preg_match($pattern,$phone)||!preg_match($pattern,$hometown)||!preg_match($pattern,$interests)||!preg_match($pattern,$credit)){
	$_SESSION['fault_msg']="Your input can only contain digits, characters, _, @ and dot!";
	echo '<script language=javascript>window.location.href="registererror.php"</script>'; 
}
//Create session

//Test database connection
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());
//Check wether user has already exist
$stmt=$connection->prepare("select loginname from users where loginname = ?");
$stmt->bind_param("s",$para1);
$para1=$username;
$stmt->execute();
$authentication = $stmt->get_result();

//If user not exist in customer then insert the new customer name into the customer
$authenticate=mysqli_fetch_array($authentication);
if($authenticate!=NULL)
{
$_SESSION['fault_msg']="The login name has been registered!";
}else{
	$insert_st=$connection->prepare("INSERT INTO users VALUES (?,?,?,?,?,?,?,?)");
	$insert_st->bind_param("ssssssss",$para_username,$para_uname,$para_password,$para_email,$para_hometown,$para_interests,$para_credit,$para_phone);
	$para_username=$username;
	$para_uname=$uname;
	$para_password=$password;
	$para_email=$email;
	$para_hometown=$hometown;
	$para_interests=$interests;
	$para_credit=$credit;
	$para_phone=$phone;
	$insert_st->execute();
}

// Free resultset
@mysqli_free_result($authentication);
// Closing connection
@mysqli_close($connection);
//Store the username in the session
$_SESSION['loginname']=$username;
if(isset($_SESSION['fault_msg'])){
    echo '<script language=javascript>window.location.href="registererror.php"</script>'; 
}else{
	echo '<script language=javascript>window.location.href="index.php"</script>';
}
?>
