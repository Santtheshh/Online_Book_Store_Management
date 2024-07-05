<?php

	session_start();
	require_once "./functions/database_functions.php";
	
	?>
	<h4 class="fw-bolder text-center">Checkout</h4>
     
<?php
	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
?>
<?php
// Assuming you have established a database connection
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

// Use the $customerid as needed



?>
	<div class="card rounded-0 shadow mb-3">
		<div class="card-body">
			<div class="container-fluid">
			<table class="table" >
				<tr class="lft">
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
				<tr class="lft">
					<td><?php echo $book['book_title'] . " by " . $book['book_author']; ?></td>
					<td><?php echo "$" . $book['book_price']; ?></td>
					<td><?php echo $qty; ?></td>
					<td><?php echo "$" . $qty * $book['book_price']; ?></td>
				</tr>
				<?php } ?>
				<tr class="lft">
					<th>&nbsp;</th>
					<th>&nbsp;</th>
					<th><?php echo $_SESSION['total_items']; ?></th>
					<th><?php echo "$" . $_SESSION['total_price']; ?></th>
				</tr>
			</table>
			</div>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="cardvish">
			<div >
				<div class="card-header">
					<div class="card-title h6 fw-bold">Please Fill the following form</div>
				</div>
				<div >
					<form method="post" action="purchase.php" class="form-horizontal listsparent">
						<?php if(isset($_SESSION['err']) && $_SESSION['err'] == 1){ ?>
							<p class="text-danger">All fields have to be filled</p>
							<?php } ?>
							<!--  -->
							
						<div class="mb-31">
							<label for="name" class="control-label">E-mail</label>
							<input type="email" name="name" required class="form-control rounded-0">
						</div>
						<div class="mb-31">
							<label for="address" class="control-label">Address</label>
							<input type="text" name="address"  required class="form-control rounded-0">
						</div>
						<div class="mb-31">
							<label for="city" class="control-label">City</label>
							<input type="text" name="city" required class="form-control rounded-0">
						</div>
						<div class="mb-31">
							<label for="zip_code" class="control-label">Zip Code</label>
							<input type="tel" name="zip_code"  required pattern="[0-9]{6}" title="MUST CONTAIN 6 DIGIT"  class="form-control rounded-0">

						</div>
						<div class="mb-31">
							<label for="country" class="control-label">Country</label>
							<input type="text" name="country"required class="form-control rounded-0">
						</div>
						<div class="mb-31 d-grid">
							<input type="submit" name="submit" value="Purchase" class="btn btn-primary rounded-0">
							
						</div>
					</form>
					<p class="fw-light fst-italic"><small class="text-muted">Please press Purchase to confirm your purchase, or Continue Shopping to add or remove items.</small></p>
				</div>
			</div>
		</div>
	</div>
	
<?php
	} else {
		echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
	}
	if(isset($conn)){ mysqli_close($conn); }
	
?>

<style>
	.form-control{
		width:300px;
		height:30px;
		word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
		border-radius: .25rem
	}
.listsparent{
	display:flex;
	flex-direction:column;
	align-items:center;
	justify-content:center;

}
.mb-31{
	display:flex;
	flex-direction:column;
	align-items:left;
	justify-content:left;
	padding:10px;
	width:300px;

}
.cardvish{

	width:600px;
	display:flex;
	align-items:center;
	justify-content:center;
	padding:30px;
	
}
	.lft{
		text-align:left;
	}
	.fw-bolder {
    font-weight: bolder !important
}
.text-center {
    text-align: center !important
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
.mb-3 {
    margin-bottom: 1rem !important
}
.card-body {
    flex: 1 1 auto;
    padding: 1rem 1rem
}
.container,
.container-fluid,
.container-lg,
.container-md,
.container-sm,
.container-xl,
.container-xxl {
    width: 100%;
    padding-right: var(--bs-gutter-x, .75rem);
    padding-left: var(--bs-gutter-x, .75rem);
    margin-right: auto;
    margin-left: auto
}
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
}
.row {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(var(--bs-gutter-y) * -1);
    margin-right: calc(var(--bs-gutter-x) * -.5);
    margin-left: calc(var(--bs-gutter-x) * -.5)
}
.justify-content-center {
    justify-content: center !important
}
.col-lg-5 {
        flex: 0 0 auto;
        width: 41.66666667%
    }
	.col-md-8 {
        flex: 0 0 auto;
        width: 66.66666667%
    }
	.col-sm-10 {
        flex: 0 0 auto;
        width: 83.33333333%
    }
	.card-header {
    padding: .5rem 1rem;
    margin-bottom: 0;
    background-color: rgba(0, 0, 0, .03);
    border-bottom: 1px solid rgba(0, 0, 0, .125)
}
.card-title {
    margin-bottom: .5rem
}

.fw-bold {
    font-weight: 700 !important
}
.h6,
h6 {
    font-size: 1rem
}
.d-grid {
    display: grid !important
}
.fw-light {
    font-weight: 300 !important
}
.fst-italic {
    font-style: italic !important
}
.text-muted {
    --bs-text-opacity: 1;
    color: #6c757d !important
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
}
.btn{
	width:150px;
}
	</style>
