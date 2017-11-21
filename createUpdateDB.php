<?php

//$loginname到时换成session值
$loginname=$_SESSION['loginname'];

$pid=$_POST["pid"];

$description=$_POST["description"];

//connect to database
include("mysqlconnect.php");

//insert to user table
$insertUpdate="insert into updates(pid,utime,ucontent) values('{$pid}',now(),'{$description}')";
mysqli_query($connection,$insertUpdate) or die ("Couldn't execute queryInsert: " . mysqli_error());

header("Location: createUpdateSuccess.php");

?>