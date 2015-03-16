<?php

require 'config_sql.php';

$shopname = $_POST['shopname'];
$type = $_POST['type'];
$number = $_POST['number'];
$address = $_POST['address'];

$stat = $mysqli->query("INSERT INTO Mills VALUES ('', '$shopname', '$address', '$number', '$type', '0')");

if($stat == false){
	echo "<script type='text/javascript'>alert('Error in adding'); </script>";
}
else {
	echo "<script type='text/javascript'>alert('Successfully Added'); location.href = '../index.php';</script>";
}

?>