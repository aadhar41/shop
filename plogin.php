<?php 
	include 'includes/database/dbconfig.php';
	session_start();
	if(isset($_POST['email']) && isset($_POST['password'])) {
			$email = check_input($_POST['email']);
			$password = check_input($_POST['password']);
		
			$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
			$result = mysql_query($query);
			$count = mysql_num_rows($result);
			$row = mysql_fetch_assoc($result);
			
			$id = $row['email'];
	
			if($count==1) {
				$_SESSION['user_id'] = $id;
				$_SESSION['cart'] = array();
				header("location:index.php?id=$id");
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
?>
