<?php

require 'config_sql.php';

$msg = "Successfully placed the order. The following items are getting low in supply - ";
$flag = 0;
$retailid = $_POST['retailid'];
$number = $_POST['number'];

//echo "Retailid = ".$retailid;
//echo "Number = ".$number;

$sum = 0;
for ($i=1;$i<=$number;$i++) {
	$id = 'id'.$i;
	$quan = 'quantity'.$i;
	$id = $_POST[$id];
	$quan = $_POST[$quan];
	$sql = $mysqli->query("SELECT * FROM Stocks WHERE Id = '$id' LIMIT 1");

	$row = $sql->fetch_assoc();
	
	if((int)$row['Present'] < $quan){
		echo "<script type='text/javascript'>alert('Quantity less than given quantity for item with id " . $id . "'); location.href = '../Retailorder.php';</script>";
		exit();			
	}
	else
		$sum = $sum + $quan*(int)$row['Price'];
}
$date = (string)date('Y-m-d');

$sql = $mysqli->query("SELECT * FROM Retailers WHERE Id = '$retailid' LIMIT 1");
$row = $sql->fetch_assoc();
$dalal = 0;
$dalali = 0;
if($row['Dalal'] != 0){
	$dalal = (int)$row['Dalal'];
	$dalali = ($sum)/100;
}

$sql = $mysqli->query("INSERT INTO Retail_Orders VALUES ('', '$retailid', '$sum', '$date', '$dalal', '$dalali')");
$sql = $mysqli->query("SELECT * FROM Retail_Orders WHERE Retailer_Id = '$retailid' AND Date_Of_Order = '$date'");
$row = $sql->fetch_assoc();
$order = $row['Order_Number'];

if($dalal != 0){
	$sql = $mysqli->query("SELECT * FROM Dalal WHERE Id = '$dalal' LIMIT 1");
	$row = $sql->fetch_assoc();
	$dalali = $dalali + (int)$row['Dalali'];
	$sql = $mysqli->query("UPDATE Dalal SET Dalali = '$dalali' WHERE Id = '$dalal' LIMIT 1");
}

for ($i=1;$i<=$number;$i++) {
	$id = 'id'.$i;
	$quan = 'quantity'.$i;
	$id = $_POST[$id];
	$quan = $_POST[$quan];

	$sql = $mysqli->query("SELECT * FROM Stocks WHERE Id = '$id' LIMIT 1");
	$row = $sql->fetch_assoc();

	$newquan = (int)$row['Present'] - $quan;
	$price = (int)$row['Price'];
	$quality = $row['Quality'];
	$colour = $row['Colour'];
	$price = $quan*$price;
	if($newquan < $row['Minimum']){
		$flag = 1;
		$msg = $msg . $quality . " " . $colour . ", ";
	}
	$sql = $mysqli->query("UPDATE Stocks SET Present = '$newquan' WHERE Id = '$id' LIMIT 1");
	$sql = $mysqli->query("INSERT INTO Retail_Bill_Items VALUES ('$id', '$order', '$quality', '$colour', '$quan', '$price')");
}

$sql = $mysqli->query("SELECT * FROM Retailers WHERE Id = '$retailid' LIMIT 1");
$row = $sql->fetch_assoc();
$sum = $sum + $row['Transaction'];
$sql = $mysqli->query("UPDATE Retailers SET Transaction = '$sum' WHERE Id = '$retailid'");



if($flag == 1){
	echo "<script type='text/javascript'>alert(". $msg ."); location.href = '../index.php';</script>";
}
else {
	$month = date('m');
	$year = date('Y');

	$sql = $mysqli->query("SELECT * FROM Audit_Sheet WHERE Month = '$month' AND Year = '$year'");
	if($row = $sql->fetch_assoc()){
		$milltransaction = $row['Retail_Transaction'];
		$milltransaction = $milltransaction + $sum;
		$profit = $row['Profit'];
		$profit = $profit + $milltransaction;
		$sql = $mysqli->query("UPDATE Audit_Sheet SET Retail_Transaction = '$milltransaction' WHERE Month = '$month' AND Year = '$year'");
		$sql = $mysqli->query("UPDATE Audit_Sheet SET Profit = '$profit' WHERE Month = '$month' AND Year = '$year'");
	}
	else {
		$q = $mysqli->query("SELECT * FROM Employee_Details");
		$salary = 0;
		while($row = $q->fetch_assoc()){
			$salary += $row['Salary'];
		}
		$profit = $sum;
		$sql = $mysqli->query("INSERT INTO Audit_Sheet VALUES ('$month', '$year', '0', '$profit', '$salary', '$profit')");
	}

	echo "<script type='text/javascript'>alert('Successfully placed the order'); location.href = '../retailbill.php?Ordernumber=".$order."';</script>";
}
?>