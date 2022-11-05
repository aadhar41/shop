<?php
include './includes/database/db.php';
include './includes/database/dbconfig.php';
session_start();
if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = check_input($_POST['email']);
	$password = check_input($_POST['password']);

	$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
	$result = $conn->query($query);
	$count = $result->num_rows;
	$row = $result->fetch_assoc();

	$id = $row['email'];
	$name = $row['name'];

	if ($count == 1) {
		$_SESSION['user_id'] = $name;
		$_SESSION['cart'] = array();
		header("location:index.php?id=$name");
	} else {
		$loginErr = "Incorrect Email or Password.";
	}
}

function check_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
