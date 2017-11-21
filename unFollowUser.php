<?php
session_start();
$user=$_REQUEST["username"];
//$loginuser=$_SESSION["name"];
$loginuser=$_SESSION['loginname'];

//set up database connection
include("mysqlconnect.php");

$deleteFollow="delete from follow where loginA='{$loginuser}' and loginB='{$user}'";
mysqli_query($connection,$deleteFollow) or die ("Couldn't execute query: " . mysqli_error());
echo $user;
?>