<?php

require 'config_sql.php';

$shopname = $_POST['shopname'];
$contactname = $_POST['contactname'];
$number = $_POST['number'];
$address = $_POST['address'];
$retailerid = $_POST['retailerid'];

$stat = $mysqli->query("UPDATE Retailers SET Name = '$shopname' WHERE Id = '$retailerid'");
$stat = $mysqli->query("UPDATE Retailers SET Address = '$address' WHERE Id = '$retailerid'");
$stat = $mysqli->query("UPDATE Retailers SET Contact = '$number' WHERE Id = '$retailerid'");
$stat = $mysqli->query("UPDATE Retailers SET Contact_Name = '$contactname' WHERE Id = '$retailerid'");

if($stat == false){
	echo "<script type='text/javascript'>alert('Error in updating'); </script>";
}
else {
	echo "<script type='text/javascript'>alert('Successfully Updated'); location.href = '../retailsheet.php';</script>";
}

?>