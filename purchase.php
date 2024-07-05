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
		header("Location: checkout.php");
	} else {
		unset($_SESSION['err']);
	}


	$_SESSION['ship'] = array();
	foreach($_POST as $key => $value){
		if($key != "submit"){
			$_SESSION['ship'][$key] = $value;
		}
	}
	require_once "./functions/database_functions.php";
	// print out header here
	$title = "Purchase";

	?>

	<h4 class="fw-bolder text-center">Payment</h4>
      <center>
        <hr class="bg-warning" style="width:5em;height:3px;opacity:1">
      </center>
<?php
	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
?>

<?php 
	$val=$_POST['name'];

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
				<table class="table">
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
					<tr  class="lft">
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th><?php echo $_SESSION['total_items']; ?></th>
						<th><?php echo "$" . $_SESSION['total_price']; ?></th>
					</tr>
					<tr class="lft">
						<td>Shipping</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>20.00</td>
					</tr>
					<tr class="lft">
						<th>Total Including Shipping</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th><?php echo "$" . ($_SESSION['total_price'] + 20); ?></th>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="row justify-content-center">
	<div class="cardvish">
		<div class="col-lg-5 col-md-8 col-sm-10 col-xs-12">
			<div class="card rounded-0 shadow">
				<div class="card-header">
					<div class="card-title h6 fw-bold">Please Fill the following form</div>
				</div>
				<div class="card-body">
					<div class="container-fluid">
						<form method="post" action="process.php" class="form-horizontal">
							<?php if(isset($_SESSION['err']) && $_SESSION['err'] == 1){ ?>
							<p class="text-danger">All fields have to be filled</p>
							<?php } ?>
							<div class="form-group mb-3">
								<label for="card_type" class="control-label">Type</label>
								<select class="form-select rounded-0" name="card_type">
									<option value="VISA">VISA</option>
									<option value="MasterCard">MasterCard</option>
									<option value="American Express">American Express</option>
								</select>
							</div>
							<div class="form-group mb-31">
								<label for="card_number" class="control-label">Number</label>
								<input type="tel" class="form-control rounded-0" name="card_number"required pattern="[0-9]{8}" title="MUST CONTAIN 8 DIGIT">
							</div>
							<div class="form-group mb-31">
								<label for="card_PID" class="control-label">PID</label>
								<input type="tel" class="form-control rounded-0" name="card_PID" required pattern="[0-9]{6}" title="MUST CONTAIN 6 DIGIT">
							</div>
							<div class="form-group mb-31">
								<label for="card_expire" class="control-label">Expiry Date</label>
								<input type="date" name="card_expire" class="form-control rounded-0"min="2023-01-01" max="2033-01-01" required>
							</div>
							<!--  -->
							<div class="form-group mb-31">
								<label for="card_owner" class="control-label">mail</label>
								<input type="email" class="form-control rounded-0" name="card_owner" value=<?php echo $val; ?>>
							</div>
							<div class="form-group mb-31">
								<div class="d-grid gap-2">
									<button type="submit" class="btn btn-primary rounded-0">Purchase</button>
									<button type="reset" class="btn btn-default bg-light bg-gradient border rounded-0">Cancel</button>
								</div>
							</div>
						</form>
						<p class="fw-light fst-italic"><small class="text-muted">Please press Purchase to confirm your purchase, or Continue Shopping to add or remove items.</small></p>
					</div>
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
	.form-select {
    display: block;
    width: 60%;
    padding: .375rem 2.25rem .375rem .75rem;
    -moz-padding-start: calc(0.75rem - 3px);
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right .75rem center;
    background-size: 16px 12px;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none
}

		.form-control{
		width:300px;
		height:30px;
		word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
		border-radius: .25rem
	}
	.cardvish{

width:600px;
display:flex;
align-items:right;
justify-content:right;
padding:30px;

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
.lft{
		text-align:left;
		justify-content:space-between;
	}
	.fw-bolder {
  font-weight: bolder !important;
}
.text-center {
  text-align: center !important;
}
.bg-warning {
  --bs-bg-opacity: 1;
  background-color: rgba(var(--bs-warning-rgb), var(--bs-bg-opacity)) !important;
}
.card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 1px solid rgba(0, 0, 0, 0.125);
  border-radius: 0.25rem;
}
.rounded-0 {
  border-radius: 0 !important;
}
.shadow {
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
.card-header {
  padding: 0.5rem 1rem;
  margin-bottom: 0;
  background-color: rgba(0, 0, 0, 0.03);
  border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}
.card-title {
  margin-bottom: 0.5rem;
}
.h6, h5, .h5, h4, .h4, h3, .h3, h2, .h2, h1, .h1 {
  margin-top: 0;
  margin-bottom: 0.5rem;
  font-weight: 500;
  line-height: 1.2;
}
.fw-bold {
  font-weight: 700 !important;
}
.card-body {
  flex: 1 1 auto;
  padding: 1rem 1rem;
}
.container-fluid,
.container-xxl,
.container-xl,
.container-lg,
.container-md,
.container-sm {
  width: 100%;
  padding-right: var(--bs-gutter-x, 0.75rem);
  padding-left: var(--bs-gutter-x, 0.75rem);
  margin-right: auto;
  margin-left: auto;
}
.text-danger {
  --bs-text-opacity: 1;
  color: rgba(var(--bs-danger-rgb), var(--bs-text-opacity)) !important;
}
.mb-3 {
  margin-bottom: 1rem !important;
}.mb-31{
	display:flex;
	flex-direction:column;
	align-items:left;
	justify-content:left;
	padding:10px;
	width:300px;

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

.btn-default
{
	color: ;
    background-color:red;	
}
	</style>