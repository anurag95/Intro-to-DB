<?php

require 'config_sql.php';

$msg = "Successfully placed the order";
$flag = 0;
$retailid = $_POST['retailid'];
$number = $_POST['number'];
$sql = $mysqli->query("SELECT * FROM Mills WHERE Id = '$retailid' LIMIT 1");
$row = $sql->fetch_assoc();
$clothtype = $row['Quality'];

$sum = 0;
for ($i=1;$i<=$number;$i++) {
	$id = 'id'.$i;
	$quan = 'quantity'.$i;
	$id = $_POST[$id];
	$quan = $_POST[$quan];
	$sql = $mysqli->query("SELECT * FROM Stocks WHERE Id = '$id' LIMIT 1");
	$row = $sql->fetch_assoc();
	//if($row['Quality'] == $clothtype)
		$sum = $sum + $quan*(int)$row['Price'];
}
$date = (string)date('Y-m-d');

$sql = $mysqli->query("SELECT * FROM Retailers WHERE Id = '$retailid' LIMIT 1");
$row = $sql->fetch_assoc();

$sql = $mysqli->query("INSERT INTO Mill_Orders VALUES ('', '$retailid', '$sum', '$date')");
$sql = $mysqli->query("SELECT * FROM Mill_Orders WHERE Mill_Id = '$retailid' AND Date_Of_Order = '$date'");
$row = $sql->fetch_assoc();
$order = $row['Order_Number'];


for ($i=1;$i<=$number;$i++) {
	$id = 'id'.$i;
	$quan = 'quantity'.$i;
	$id = $_POST[$id];
	$quan = $_POST[$quan];

	$sql = $mysqli->query("SELECT * FROM Stocks WHERE Id = '$id' LIMIT 1");
	$row = $sql->fetch_assoc();
	//if($row['Quality'] == $clothtype){
		$newquan = (int)$row['Present'] + $quan;
		$price = (int)$row['Price'];
		$quality = $row['Quality'];
		$colour = $row['Colour'];
		$price = $quan*$price;
		$sql = $mysqli->query("UPDATE Stocks SET Present = '$newquan' WHERE Id = '$id' LIMIT 1");
		$sql = $mysqli->query("INSERT INTO Mill_Bill_Items VALUES ('$id', '$order', '$quality', '$colour', '$quan', '$price')");
	//}
}

$sql = $mysqli->query("SELECT * FROM Mills WHERE Id = '$retailid' LIMIT 1");
$row = $sql->fetch_assoc();
$sum = $sum + $row['Transaction'];
$sql = $mysqli->query("UPDATE Mills SET Transaction = '$sum' WHERE Id = '$retailid'");

$month = date('m');
$year = date('Y');

$sql = $mysqli->query("SELECT * FROM Audit_Sheet WHERE Month = '$month' AND Year = '$year'");
if($row = $sql->fetch_assoc()){
	$milltransaction = $row['Mill_Transaction'];
	$milltransaction = $milltransaction + $sum;
	$profit = $row['Profit'];
	$profit = $profit - $milltransaction;
	$sql = $mysqli->query("UPDATE Audit_Sheet SET Mill_Transaction = '$milltransaction' WHERE Month = '$month' AND Year = '$year'");
	$sql = $mysqli->query("UPDATE Audit_Sheet SET Profit = '$profit' WHERE Month = '$month' AND Year = '$year'");
}
else {
	$q = $mysqli->query("SELECT * FROM Employee_Details");
	$salary = 0;
	while($row = $q->fetch_assoc()){
		$salary += $row['Salary'];
	}
	$profit = $sum*(-1);
	$sql = $mysqli->query("INSERT INTO Audit_Sheet VALUES ('$month', '$year', '$sum', '0', '$salary', '$profit')");
}



//echo "<script type='text/javascript'>alert('Successfully placed the order'); location.href = '../index.php'</script>";
echo "<script type='text/javascript'>alert('Successfully placed the order'); location.href = '../millbill.php?Ordernumber=".$order."';</script>";

?>