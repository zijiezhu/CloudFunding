<?php
/**
 * Created by PhpStorm.
 * User: zijie_zhu
 * Date: 5/2/17
 * Time: 02:42
 */

$data2=$_POST["name"];
echo $data2;


$data=$_REQUEST["name"];
echo $data;


$imgData=$_FILES["file"]['temp_name'];
echo $imgData;
$imageProperties = getimageSize($_FILES['file']['tmp_name']);



//$mysql_server_name="127.0.0.1";
//$mysql_username="root";
//$mysql_password="123456";
//$mysql_database="fundsys";
//$connection=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database) or die('Could not connect: ' . mysqli_error());;



//$query="select imdata from pimgandmcs where pid='48'";
//$result=mysqli_query($connection,$query) or die ("Couldn't execute queryInsert: " . mysqli_error());
//$row = @mysqli_fetch_array($result,MYSQLI_ASSOC);
//$image=$row['imdata'];

//echo '<img src="data:image/jpeg;base64,'.base64_encode($image) .'" />';

//$insertImg="insert into pimgandmcs(pid,imtype,imdata)values('1','".$imageProperties['mime']."','".$imgData."')";
//mysqli_query($connection,$insertImg) or die ("Couldn't execute queryInsert: " . mysqli_error());

?>