<?php 
	include 'includes/overall/oheader.php';	

	$err ="";
	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repassword']) && isset($_POST['gender']) && isset($_POST['mobile'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$repassword = $_POST['repassword'];
			$gender = $_POST['gender'];
			$mobile = $_POST['mobile'];

		if($_POST['password'] !== $_POST['repassword']) {
			$err = 'Passwords do not match.';
		} else {
			$query = "INSERT INTO users(name, email, password, gender, mobile) VALUES('$name', '$email', '$password', '$gender', '$mobile')";
			mysql_query($query);
			$last_id = mysql_insert_id();
			//echo $last_id;
			$aa = 'cus'.str_pad($last_id,3,'0',STR_PAD_LEFT);
			$sql = "UPDATE users SET u_id = '$aa' WHERE id = '$last_id'";
			mysql_query($sql);
			
			header("location: login.php");
			
		}

	}
	
?>