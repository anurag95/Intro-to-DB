<?php
require 'config_sql.php';

$sql = $mysqli->query("SELECT * FROM Audit_Sheet ORDER BY Year, Month");
if($sql == false)
	echo "failed";
else {
	$months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
	while($row = $sql->fetch_assoc()){
		echo "<tr>";
		echo "<td>".$months[$row['Month']-1]." ".$row['Year']."</td>";
		echo "<td>Rs. ".$row['Mill_Transaction']."</td>";
		echo "<td>Rs. ".$row['Retail_Transaction']."</td>";
		echo "<td>Rs. ".$row['Salary']."</td>";
		echo "<td>Rs. ".$row['Profit']."</td>";
		echo "</tr>";
	}
}

?>