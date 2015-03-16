<?php

require 'config_sql.php';

$name = $_POST['name'];
$salary = $_POST['salary'];
$number = $_POST['number'];
$address = $_POST['address'];
$pass = 'iiit123';
$stat = $mysqli->query("INSERT INTO Employee_Details VALUES ('', '$name',  '$number', '$salary', '$address', '$pass')");

if($stat == false){
	echo "<script type='text/javascript'>alert('Error in adding'); </script>";
}
else {
	echo "<script type='text/javascript'>alert('Successfully Added, Password is ".$pass."'); location.href = '../index.php';</script>";
}

?>