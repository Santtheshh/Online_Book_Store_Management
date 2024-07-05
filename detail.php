<?php
    session_start();
    require_once "./functions/admin.php";
    $title = "List book";
    
    require_once "./functions/database_functions.php";
    $conn = db_connect();
    $result = getAllrders($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Book</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS styles */
        /* Add your custom CSS styles here */
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
    <?php if(isset($_SESSION['book_success'])): ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['book_success'] ?>
        </div>
        <?php unset($_SESSION['book_success']); ?>
    <?php endif; ?>

    <h2 class="fw-bolder text-center mt-4">Orders</h2>
    <div class="container mt-4">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer ID</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['orderid']; ?></td>
                            <td><?= $row['customerid']; ?></td>
                            <td><?= $row['amount']; ?></td>
                            <td><?= $row['date']; ?></td>
                            <td><?= $row['e-mail']; ?></td>
                            <td><?= $row['ship_address']; ?></td>
                            <td><?= $row['ship_city']; ?></td>
                            <td>
                                <?php if($row['status'] == 'pending'): ?>
                                    <a href="confirm.php?e-mail=<?= $row['e-mail']; ?>&orderid=<?= $row['orderid']; ?>" class="btn btn-primary btn-sm" title="Confirm">Confirm</a>
                                    <a href="reject.php?e-mail=<?= $row['e-mail']; ?>&orderid=<?= $row['orderid']; ?>" class="btn btn-danger btn-sm" title="Reject" onclick="return confirm('Are you sure to cancel this book order?')">Cancel</a>
                                <?php elseif($row['status'] == 'Confirmed'): ?>
                                    <a href="reject.php?e-mail=<?= $row['e-mail']; ?>&orderid=<?= $row['orderid']; ?>" class="btn btn-danger btn-sm" title="Reject" onclick="return confirm('Are you sure to cancel this book order?')">Cancel</a>
                                <?php elseif($row['status'] == 'Canceled'): ?>
                                    <a href="confirm.php?e-mail=<?= $row['e-mail']; ?>&orderid=<?= $row['orderid']; ?>" class="btn btn-primary btn-sm" title="Confirm">Confirm</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
