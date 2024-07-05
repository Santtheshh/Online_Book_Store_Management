
<?php
						
						?>
						<?php
	session_start();
	// require_once "./functions/admin1.php";
	$title = "Edit book";
	//require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	if(isset($_GET['bookisbn'])){
		$book_isbn = $_GET['bookisbn'];
	} else {
		echo "Empty query!";
		exit;
	}

	if(!isset($book_isbn)){
		echo "Empty isbn! check again!";
		exit;
	}

	// get book data
	$query = "SELECT * FROM books WHERE book_isbn = '{$book_isbn}'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo $err = "Can't retrieve data ";
		exit;
	}else{
		$row = mysqli_fetch_assoc($result);
		$bt=$row['book_title'];
		$ba=$row['book_author'];
		$bd=$row['book_descr'];
		$bp=$row['book_price'];
	

	}
	if(isset($_POST['edit'])){
		$isbn = trim($_POST['isbn']);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, ['edit', 'isbn'])){
				if(!empty($data)) $data .=", ";
				$data .= "`{$k}` = '".(mysqli_real_escape_string($conn, $v))."'";
			}
		}
						$btt=$_POST['book_title'];
						$baa=$_POST['book_author'];
						$bdd=$_POST['book_descr'];
						$bpp=$_POST['book_price'];
		if($bt==$btt&$ba==$baa&$bd==$bdd&$bp==$bpp)
		{
			echo '<script>alert("NO Changes Made");window.location="";</script>';
		}
		else{


		$query = "UPDATE books set $data where book_isbn = '{$book_isbn}'";
		$result = mysqli_query($conn, $query);
		if($result){
			$_SESSION['book_success'] = "Book Details has been updated successfully";
			header("Location: admin_book.php");
		} else {
			$err =  "Can't update data " . mysqli_error($conn);
		}
	}}
?>

	<h4 class="text-center"><center><h2>Edit Book Details<h2></center></h4>
	<center>
	<hr class="bg-warning" style="width:5em;height:3px;opacity:1">
	</center>
	<div class="row justify-content-center">
		<div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
			<div class="card rounded-0 shadow">
				<div class="card-body">
					<div class="container-fluid">
						<?php if(isset($err)): ?>
							<div class="alert alert-danger rounded-0">
								<?= $_SESSION['err_login'] ?>
							</div>
						<?php 
							endif;
						?>
					
						<form method="post" action="admin_edit.php?bookisbn=<?php echo $row['book_isbn'];?>" enctype="multipart/form-data">
								<div class="mb-3">
									<label class="control-label">ISBN</label>
									<input class="form-control rounded-0" type="text" name="isbn" value="<?php echo $row['book_isbn'];?>" readOnly="true">
								</div>
								<div class="mb-3">
									<label class="control-label">Title</label>
									<input class="form-control rounded-0" type="text" name="book_title" value="<?php echo $bt;?>" required>
								</div>
								<div class="mb-3">
									<label class="control-label">Author</label>
									<input class="form-control rounded-0" type="text" name="book_author" value="<?php echo $ba;?>" required>
								</div>
								<div class="mb-3">
									<label class="control-label">Description</label>
									<textarea class="form-control rounded-0" name="book_descr" cols="40" rows="5"><?php echo $bd;?></textarea>
								</div>
								<div class="mb-3">
									<label class="control-label">Price</label>
									<input class="form-control rounded-0" type="text" name="book_price" value="<?php echo $bp;?>" required>
								</div>
								<div class="mb-3">
									<label class="control-label">Publisher</label>
									<select class="form-select rounded-0"  name="publisherid" required>
										<?php 
										$psql = mysqli_query($conn, "SELECT * FROM `publisher` order by publisher_name asc");
										while($row = mysqli_fetch_assoc($psql)):
										?>
										<option value="<?= $row['publisherid'] ?>" <?= $row['publisherid']==$row['publisherid'] ? 'selected' : '' ?>><?= $row['publisher_name'] ?></option>
										<?php endwhile; ?>
									</select>

								</div>
								<div class="text-center">
									<button type="submit" name="edit"  class="btn btn-primary btn-sm rounded-0">Update</button>
									<button><a class="decor" href="admin_book.php">Cancel</a></button>
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<style>
		.decor{
			text-decoration:none;
		}

		.form-control {
    display: block;
    width: 70%;
    padding: .375rem .50rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
	
}
.form-select {
    display: block;
    width: 70%;
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
.btn-sm {
    padding: .25rem .5rem;
    font-size: .875rem;
    border-radius: .2rem
}
.btn-primary {
    color: #fff;
    background-color: #0d6efd;
    border-color: #0d6efd
}
.border {
    border: 1px solid #dee2e6 !important
}

		.mb-3 {
    margin-bottom: 1rem !important
}
.fw-bolder {
    font-weight: bolder !important
}
.alert-danger {
    color: #842029;
    background-color: #f8d7da;
    border-color: #f5c2c7
}

.alert-danger .alert-link {
    color: #6a1a21
}
.shadow {
    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important
}
.alert {
    position: relative;
    padding: 1rem 1rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: .25rem
}

.container-fluid
 {
    width: 70%;
    padding-right: var(--bs-gutter-x, .75rem);
    padding-left: var(--bs-gutter-x, .75rem);
    margin-right: auto;
    margin-left: auto
}

.card-body {
    flex: 1 1 auto;
    padding: .75rem .75rem
}
.shadow-sm {
    box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important
}

.shadow-lg {
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important
}

.shadow-none {
    box-shadow: none !important
}
.rounded-0 {
    border-radius: 0 !important
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
.col-md-8 {
        flex: 0 0 auto;
        width: 66.66666667%
    }
.col-lg-6 {
        flex: 0 0 auto;
        width: 50%
    }
	.col-sm-10 {
        flex: 0 0 auto;
        width: 83.33333333%
    }

.text-center {
    text-align: center !important
}
.bg-warning {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-warning-rgb), var(--bs-bg-opacity)) !important
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

		</style>

<!-- <?php
	//if(isset($conn)) {mysqli_close($conn);}
//	require "./template/footer.php"
?> -->