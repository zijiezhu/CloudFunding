<?php
session_start();
date_default_timezone_set('America/New_York');
$loginname=$_SESSION['loginname'];

$name=$_POST["name"];

$tag=$_POST['category'];

$min=$_POST['min'];

$max=$_POST['max'];

$ddl=$_POST['ddl'];
$ddl = strtotime($ddl);
$ddl=date('Y-m-d H:i:s', $ddl);

$comptime=$_POST['comptime'];
$comptime = strtotime($comptime);
$comptime=date('Y-m-d H:i:s', $comptime);

$description=$_POST['description'];
$image=$_POST['image'];


//connect to database
include("mysqlconnect.php");

//insert to project table
$queryInsert="insert into project(loginname,pname,pdescription,min,max,posttime,deadline,comptime,pimg) values('".$loginname."','".$name."','".$description."','".$min."','".$max."',now(),'".$ddl."','".$comptime."','".$image."')";
mysqli_query($connection,$queryInsert) or die ("Couldn't execute queryInsert: " . mysqli_error());

//insert to tag table
$getPID="select pid from project where loginname='$loginname'and pname='$name'";
$result=mysqli_query($connection,$getPID) or die ("Couldn't execute queryInsert: " . mysqli_error());

$row = @mysqli_fetch_array($result,MYSQLI_ASSOC);
$pid=$row['pid'];

//$insertTag="insert into tag values('".$pid."','".$tag."')";
//mysqli_query($connection,$insertTag) or die ("Couldn't execute queryInsert: " . mysqli_error());

header("Location: createProjectSuccess.php");

?>