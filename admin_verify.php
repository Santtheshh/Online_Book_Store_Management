<?php
	session_start();
	if(!isset($_POST['submit'])){
		echo "Something wrong! Check again!";
		exit;
	}
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$name = trim($_POST['name']);
	$pass = trim($_POST['pass']);

	if($name == "" || $pass == ""){
		// echo "Name or Pass is empty!";
		echo '<script>alert("name or pass empty");window.location="admin1.php";</script>';
		exit;
	}

	$name = mysqli_real_escape_string($conn, $name);
	$pass = mysqli_real_escape_string($conn, $pass);
	$pass = sha1($pass);

	// get from db
	$query = "SELECT `name`, `pass` from `admin` where `name` = '{$name}' and `pass` ='{$pass}'";
	$result = mysqli_query($conn, $query);
	if($result->num_rows <= 0){
		$_SESSION['err_login'] = true;
		echo '<script>alert("errorr");window.location="admin1.php";</script>';

		// header("Location: admin1.php");
		exit;
	}
	if(isset($conn)) {mysqli_close($conn);}
	$_SESSION['admin'] = true;
	echo '<script>alert("logged succesfully");window.location="admin_book.php";</script>';
	
?>