<?php
	$hostname = 'localhost';
	$username = 'root';
	$password = 'Blueberry2015';
	$database_name = 'shop';

	$conn = mysql_connect($hostname, $username, $password) or die("Sorry could not connect to the database.");

	$db = mysql_select_db($database_name, $conn) or die("Unable to select database.");
?>