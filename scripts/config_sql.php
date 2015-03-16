<?php
	
	$sql_hostname = "localhost"; //Enter hostname
	$sql_user = "root"; // Enter Username
	$sql_password = "anurag123"; // Enter password
	$sql_db = "Cloth Lining Shop"; // Enter db_name
	
	$mysqli = new mysqli( $sql_hostname, $sql_user, $sql_password, $sql_db );
	if ($mysqli == 0) {
		die("Connection Problem. Check credentials.");
	}
?>
