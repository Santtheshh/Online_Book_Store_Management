<?php
	session_start();
	require_once "./functions/admin.php";
	$title = "List book";
	
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getcustomer($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom Styles */
        /* Add your custom styles here */
    </style>
</head>
<body>
<nav id="navbar" class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Simple Online Bookstore</span>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="admin_book.php">Book List</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_add.php">Add new book</a></li>
                <li class="nav-item"><a class="nav-link" href="detail.php">Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="customer.php">Customer</a></li>
                <li class="nav-item"><a class="nav-link" href="blank.php">Feedback</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_signout.php">Log out</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
    

        <?php if(isset($_SESSION['book_success'])): ?>
            <div class="alert alert-success rounded-0">
                <?= $_SESSION['book_success'] ?>
            </div>
        <?php 
            unset($_SESSION['book_success']);
        endif;
        ?>

        <h2 class="fw-bolder text-center mt-4">Customer Lists</h2>
        <div class="card rounded-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Zip Code</th>
                                <th>Country</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $row['customerid'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['address'] ?></td>
                                <td><?= $row['city'] ?></td>
                                <td><?= $row['zip_code'] ?></td>
                                <td><?= $row['country'] ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
