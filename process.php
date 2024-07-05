<?php
	session_start();

	$_SESSION['err'] = 1;
	foreach($_POST as $key => $value){
		if(trim($value) == ''){
			$_SESSION['err'] = 0;
		}
		break;
	}

	if($_SESSION['err'] == 0){
		header("Location: purchase.php");
	} else {
		unset($_SESSION['err']);
	}

	require_once "./functions/database_functions.php";
	// print out header here
	$title = "Purchase Process";
	
	// connect database
	$conn = db_connect();
	extract($_SESSION['ship']);

	// validate post section
	$card_type=$_POST['card_type'];
	$card_number = $_POST['card_number'];
	$card_PID = $_POST['card_PID'];
	$card_expire = $_POST['card_expire'];
	$conn = mysqli_connect("localhost", "root", "", "obs_db");
// Check if the customers table is empty
$result = $conn->query("SELECT COUNT(*) FROM customers");
$row = $result->fetch_row();
$isTableEmpty = ($row[0] == 0);

// Fetch the customers table
if ($isTableEmpty) {
    $customerid = 1;
} else {
    // Fetch the maximum customerid and increment it
    $result = $conn->query("SELECT MAX(customerid) FROM customers");
    $row = $result->fetch_row();
    $customerid = $row[0] + 1;
}

	$card_owner = $_POST['card_owner'];

	
	$query = "INSERT INTO transaction VALUES 
	( '" . $card_type . "', '" . $card_number . "', '" . $card_PID . "', '" . $card_expire. "','" . $customerid. "', '" . $card_owner . "')";
	$result = mysqli_query($conn, $query);
// 	if($result)
//    {
// 	   echo '<script>alert("ggg");window.location="";</script>';
// }
   
// else{
// echo '<script>alert("uuuu");window.location="";</script>';

// }
	// find customer

// Assuming you have established a database connection


// Use the $customerid as needed




	$customerid = getCustomerId($name, $address, $city, $zip_code, $country);
	if($customerid == null) {
		// insert customer into database and return customerid
		$customerid = setCustomerId($name, $address, $city, $zip_code, $country);
	}
	$date = date("Y-m-d H:i:s");
	$status='pending';
	insertIntoOrder($conn, $customerid, $_SESSION['total_price'], $date, $name, $address, $city, $zip_code, $country,$status);

	// take orderid from order to insert order items
	$orderid = getOrderId($conn, $customerid);

	foreach($_SESSION['cart'] as $isbn => $qty){
		$bookprice = getbookprice($isbn);
		$query = "INSERT INTO order_items VALUES 
		('$orderid', '$isbn', '$bookprice', '$qty')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Insert value false!" . mysqli_error($conn2);
			exit;
		}
	}
	

	session_unset();
?>
	<div class="alert alert-success rounded-0 my-4">Your order has been processed sucessfully. We'll be reaching you out to confirm your order. Thanks!</div>
	<!-- <button  class="c"><a href="index.html">back </a></button></li> -->
	<button class="btn" ><a class="tex-dec" href="index.html">back</a></button>
<?php
	if(isset($conn)){
		mysqli_close($conn);
	}

?>
<style>
	   .tex-dec{
        text-decoration: none;
        /* color: aliceblue; */
        color:rgb(215, 230, 5);
       
    }
	.c{
    background-color: lightblue;
    color: white;
	text-decoration:none;
    border-radius: 7px;
    font-size: 25px;
}

	.alert {
    position: relative;
    padding: 1rem 1rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: .25rem
}
.alert-success {
    color: #0f5132;
    background-color: #d1e7dd;
    border-color: #badbcc
}
.rounded-0 {
    border-radius: 0 !important
}
.my-4 {
    margin-top: 1.5rem !important;
    margin-bottom: 1.5rem !important
}
	
.btn{
  display:inline-block;
  font-weight:400;
  line-height:1.5;
  text-align:center;
  vertical-align:middle;
  user-select:none;
  border:1px solid white transparent;
  padding:.375rem.75rem;
  font-size:1rem;
} </style>
