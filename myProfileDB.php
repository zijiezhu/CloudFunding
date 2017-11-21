<?php
session_start();
//$loginname到时换成session值
$loginname=$_SESSION['loginname'];

$username=$_POST["username"];

echo "$username";

$hometown=$_POST['hometown'];

$interest=$_POST['interest'];

$cardno=$_POST['cardno'];

$phoneno=$_POST['phoneno'];

$image=$_POST['mimage'];



//connect to database
include("mysqlconnect.php");

//insert to user table
$updateUser="update users set uname='{$username}',hometown='{$hometown}',interests='{$interest}',credit='{$cardno}',phone='{$phoneno}',uimg='{$image}' where loginname='{$loginname}'";
mysqli_query($connection,$updateUser) or die ("Couldn't execute queryInsert: " . mysqli_error());

header("Location: myProfileSuccess.php");

?>