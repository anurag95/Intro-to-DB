<?php

$flag = 0;
require 'config_sql.php';

$username=$_POST['name'];
$password=$_POST['password'];

session_start();
if(isset($_SESSION['views'])) 
{
   $msg = 'You are already logged in ' . $_SESSION['username'];
}

else if($username == 'admin' && $password == 'password'){
	$_SESSION['username'] = 'admin';
	$_SESSION['type'] = 'admin';
	$_SESSION['views'] = 1;
	$msg = 'Login Successful';
	$flag = 1;
}
else {
	$sql = $mysqli->query("SELECT * FROM Employee_Details WHERE Name = '$username' AND Password = '$password' LIMIT 1");
	if($row = $sql->fetch_assoc()) {
		$_SESSION['username'] = $row['Name'];
		$_SESSION['type'] = 'employee';
		$_SESSION['views'] = 1;
		$flag = 1;
		$msg = 'Login Successful';
	}
	else {
		$msg = "*Invalid username or password";
	}
}

if($flag == 1)
	echo "<script>alert('".$msg."'); location.href='../index.php'; </script>";
else {
	echo "<script>alert('".$msg."'); location.href='../signin.php'; </script>";
}
?>
