<?php
                    
$mysql_server_name="127.0.0.1";
$mysql_username="roxanne";
$mysql_password="123";
$mysql_database="fundsys";
$connection=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database) or die('Could not connect: ' . mysqli_error());

?>