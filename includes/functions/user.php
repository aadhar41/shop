<?php
function logged_in() {
	return (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) ? TRUE : FALSE;
}

?>