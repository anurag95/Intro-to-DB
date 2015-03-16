<?php

require 'config_sql.php';

$string = "";
$dalalid = 0;
$retailid = 0;

$shopname = $_POST['shopname'];
$contactname = $_POST['contactname'];
$number = $_POST['number'];
$address = $_POST['address'];
$dalal = $_POST['dalal'];

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