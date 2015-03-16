<?php

require 'config_sql.php';

$name = $_POST['name'];
$number = $_POST['number'];
$address = $_POST['address'];
$salary = $_POST['salary'];
$empid = $_POST['empid'];

$stat = $mysqli->query("UPDATE Employee_Details SET Name = '$name' WHERE Id = '$empid'");
$stat = $mysqli->query("UPDATE Employee_Details SET Address = '$address' WHERE Id = '$empid'");
$stat = $mysqli->query("UPDATE Employee_Details SET Contact = '$number' WHERE Id = '$empid'");
$stat = $mysqli->query("UPDATE Employee_Details SET Salary = '$salary' WHERE Id = '$empid'");

if($stat == false){
	echo "<script type='text/javascript'>alert('Error in updating'); </script>";
}
else {
	echo "<script type='text/javascript'>alert('Successfully Updated'); location.href = '../employee.php';</script>";
}

?>