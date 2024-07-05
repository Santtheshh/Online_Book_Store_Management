<?php
	if(!isset($_SESSION['admin']) && $_SESSION['admin'] != true){
		$_SESSION['err_login'] = "Please Login First";
		header("Location: admin.php");
	}
?>