<?php
session_start();
$user=$_REQUEST["username"];
//echo $user;
//$loginuser=$_SESSION["name"];
//$user="Sigma";
$loginuser=$_SESSION['loginname'];
//set up database connection
include("mysqlconnect.php");


$insertFollow="insert into follow values('".$loginuser."','".$user."')";
mysqli_query($connection,$insertFollow) or die ("Couldn't execute query: " . mysqli_error());
echo $user;
?>