<?php
	// the shopping cart needs sessions, to start one
	/*
		Array of session(
			cart => array (
				book_isbn (get from $_POST['book_isbn']) => number of books
			),
			items => 0,
			total_price => '0.00'
		)
	*/
	session_start();
	require_once "./functions/database_functions.php";
	require_once "./functions/cart_functions.php";

	// book_isbn got from form post method, change this place later.
	if(isset($_POST['bookisbn'])){
		$book_isbn = $_POST['bookisbn'];
	}

	if(isset($book_isbn)){
		// new iem selected
		if(!isset($_SESSION['cart'])){
			// $_SESSION['cart'] is associative array that bookisbn => qty
			$_SESSION['cart'] = array();

			$_SESSION['total_items'] = 0;
			$_SESSION['total_price'] = '0.00';
		}

		if(!isset($_SESSION['cart'][$book_isbn])){
			$_SESSION['cart'][$book_isbn] = 1;
		} elseif(isset($_POST['cart'])){
			$_SESSION['cart'][$book_isbn]++;
			unset($_POST);
		}
	}

	// if save change button is clicked , change the qty of each bookisbn
	if(isset($_POST['save_change'])){
		foreach($_SESSION['cart'] as $isbn =>$qty){
			if($_POST[$isbn] == '0'){
				unset($_SESSION['cart']["$isbn"]);
			} else {
				$_SESSION['cart']["$isbn"] = $_POST["$isbn"];
			}
		}
	}

	// print out header here
	$title = "Your shopping cart";

?>
	<h4 class="fw-bolder text-center">Cart List</h4>
      <center>
        <hr class="bg-warning" style="width:5em;height:3px;opacity:1">
      </center>
<?php
	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
		$_SESSION['total_price'] = total_price($_SESSION['cart']);
		$_SESSION['total_items'] = total_items($_SESSION['cart']);
?> 
	<div class="card rounded-0 shadow">
		<div class="card-body">
			<div class="container-fluid">
				<form action="cart.php" method="post" id="cart-form">
					<table class="table">
						<tr class="left">
							<th>Item</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Total</th>
						</tr>
						<?php
							foreach($_SESSION['cart'] as $isbn => $qty){
								$conn = db_connect();
								$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
						?>
						<tr>
							<td><?php echo $book['book_title'] . " by " . $book['book_author']; ?></td>
							<td><?php echo "$" . $book['book_price']; ?></td>
							<td><input type="text" value="<?php echo $qty; ?>" size="2" name="<?php echo $isbn; ?>"></td>
							<td><?php echo "$" . $qty * $book['book_price']; ?></td>
						</tr>
						<?php } ?>
						<tr class="left">
							<th>&nbsp;</th>
							<th>&nbsp;</th>
							<th><?php echo $_SESSION['total_items']; ?></th>
							<th><?php echo "$" . $_SESSION['total_price']; ?></th>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<div class="card-footer text-end">
			<input type="submit" class="btn btn-primary rounded-0" name="save_change" value="Modify cart" form="cart-form">
			<a href="checkout.php" class="btn btn-dark rounded-0">Go To Checkout</a> 
			<a href="books.php" class="btn btn-warning rounded-0">Continue Shopping</a>
		

		</div>
	</div>
	
<?php
	} else {
		?>
<div class="alert alert-warning rounded-0">Your shopping cart is currently empty.To add Books in your shoping cart. start browsing through our book store.When a book intrests you.click on add to cart button. </div>
<div class="alert alert-warning rounded-0">please <a href="books.php">click here</a> to continue shopping.</div>
<?php

	}
	if(isset($conn)){ mysqli_close($conn); }
	
?>
<style>
	.fw-bolder {
    font-weight: bolder !important
}
.text-center {
    text-align: center !important
}
.bg-warning {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-warning-rgb), var(--bs-bg-opacity)) !important
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: .25rem
}
.rounded-0 {
    border-radius: 0 !important
}
.shadow {
    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important
}
.card-body {
    flex: 1 1 auto;
    padding: 1rem 1rem
}
.container,
.container-fluid
/* .container-lg,
.container-md,
.container-sm,
.container-xl,
.container-xxl { */{
    width: 100%;
    padding-right: var(--bs-gutter-x, .75rem);
    padding-left: var(--bs-gutter-x, .75rem);
    margin-right: auto;
    margin-left: auto
}
/* table {
    caption-side: bottom;
    border-collapse: collapse
} */
.table {
    --bs-table-bg: transparent;
    --bs-table-accent-bg: transparent;
    --bs-table-striped-color: #212529;
    --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
    --bs-table-active-color: #212529;
    --bs-table-active-bg: rgba(0, 0, 0, 0.1);
    --bs-table-hover-color: #212529;
    --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    vertical-align: top;
    border-color: #dee2e6
	border: 9px;
	padding:4px;
}
.card-footer {
    padding: .5rem 1rem;
    background-color: rgba(0, 0, 0, .03);
    border-top: 1px solid rgba(0, 0, 0, .125)
}
.text-end {
    text-align: right !important
}
.btn {
    display: inline-block;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: center;
    text-decoration: none;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    border-radius: .25rem;
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out
}
.btn-primary {
    color: #fff;
    background-color: #0d6efd;
    border-color: #0d6efd
}
.btn-dark {
    color: #fff;
    background-color: #212529;
    border-color: #212529
}
.btn-warning {
    color: #000;
    background-color: #ffc107;
    border-color: #ffc107
}
.btn-blue{
	color: #000;
    background-color: red;
    border-color: #ffc107
}
.alert {
    position: relative;
    padding: 1rem 1rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: .25rem
}
.alert-warning {
    color: #664d03;
    background-color: #fff3cd;
    border-color: #ffecb5
}
.left{
	text-align:left;

}
	</style>
