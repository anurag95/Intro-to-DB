<?php

require 'config_sql.php';
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$name = test_input($_POST['name']);
$salary = test_input($_POST['salary']);
$number = test_input($_POST['number'];
$address = test_input($_POST['address'];
$pass = 'iiit123';
$stat = $mysqli->query("INSERT INTO Employee_Details VALUES ('', '$name',  '$number', '$salary', '$address', '$pass')");

if($stat == false){
	echo "<script type='text/javascript'>alert('Error in adding'); </script>";
}
else {
	echo "<script type='text/javascript'>alert('Successfully Added, Password is ".$pass."'); location.href = '../index.php';</script>";
}

?>
