<?php
require 'config_sql.php';

$sql = $mysqli->query("SELECT * FROM Employee_Details");
if($sql == false)
	echo "failed";
else {
	while($row = $sql->fetch_assoc()){
		echo "<tr>";
		echo "<td>".$row['Id']."</td>";
		echo "<td>".$row['Name']."</td>";
		echo "<td>".$row['Address']."</td>";
		echo "<td>".$row['Contact']."</td>";
		echo "<td>".$row['Salary']."</td>";
		echo "<td><button class='edit btn btn-lg btn-primary btn-block' onclick='display(".$row['Id'].")' id = '".$row['Id']."'>Edit</button></td>";
		echo "</tr>";
	}
}

?>