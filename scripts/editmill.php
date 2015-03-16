<?php

require 'config_sql.php';

$millname = $_POST['millname'];
$number = $_POST['number'];
$address = $_POST['address'];
$type = $_POST['type'];
$millid = $_POST['millid'];

$stat = $mysqli->query("UPDATE Mills SET Name = '$millname' WHERE Id = '$millid'");
$stat = $mysqli->query("UPDATE Mills SET Contact = '$number' WHERE Id = '$millid'");
$stat = $mysqli->query("UPDATE Mills SET Address = '$address' WHERE Id = '$millid'");
$stat = $mysqli->query("UPDATE Mills SET Quality = '$type' WHERE Id = '$millid'");

if($stat == false){
	echo "<script type='text/javascript'>alert('Error in updating'); </script>";
}
else {
	echo "<script type='text/javascript'>alert('Successfully Updated'); location.href = '../millsheet.php';</script>";
}

?>