<?php

require 'config_sql.php';

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


$string = "";
$dalalid = 0;
$retailid = 0;

$shopname = test_input($_POST['shopname']);
$contactname = test_input($_POST['contactname']);
$number = test_input($_POST['number']);
$address = test_input($_POST['address']);
$dalal = test_input($_POST['dalal']);

$stat = $mysqli->query("INSERT INTO Retailers VALUES ('', '$shopname', '$address', '$contactname', '$number', '0', '0')");
$stat = $mysqli->query("SELECT * FROM Retailers WHERE Contact LIKE '$number' LIMIT 1");
while($row = $stat->fetch_assoc()){
	$retailid = $row['Id'];
}

$stat = $mysqli->query("SELECT * FROM Dalal WHERE Name LIKE '$dalal' LIMIT 1");

while($row = $stat->fetch_assoc()){
	$string = $row['Retailers_Catered'];
	$dalalid = $row['Id'];
	$string = $string . "," . $retailid;

	$stat = $mysqli->query("UPDATE Dalal SET Retailers_Catered = '$string' WHERE Name LIKE '$dalal' LIMIT 1");
	$stat = $mysqli->query("UPDATE Retailers SET Dalal = '$dalalid' WHERE Contact LIKE '$number' LIMIT 1");

}

if($stat == false){
	echo "<script type='text/javascript'>alert('Error in adding'); </script>";
}
else {
	echo "<script type='text/javascript'>alert('Successfully Added'); location.href = '../index.php';</script>";
}

?>
