<?php
session_start();
$pid=$_REQUEST["pid"];
$loginuser=$_SESSION["loginname"];

//set up database connection
include("mysqlconnect.php");

$insertLike="insert into likes values('{$pid}','{$loginuser}')";
mysqli_query($connection,$insertLike) or die ("Couldn't execute query: " . mysqli_error());

?>