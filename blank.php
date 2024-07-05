<?php
    session_start();
    require_once "./functions/admin.php";
    $title = "List book";
    
    require_once "./functions/database_functions.php";
    $conn = db_connect();
    $result = getfeed($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS styles */
        body {
            background-color: #f8f9fa;
        }
        .back {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar {
            background-color: #000;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff !important;
        }
        .container {
            max-width: 100%;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
        }
        .headingcol {
            background-color: #000;
            color: #fff;
        }
        .belowdata {
            background-color: #f3f4f6;
        }
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
        <div class="alert alert-success rounded-0">
            <?= $_SESSION['book_success'] ?>
        </div>
        <?php unset($_SESSION['book_success']); ?>
    <?php endif; ?>

    <div class="container mt-4">
        <h2 class="fw-bolder text-center">Feedback</h2>
        <div class="card rounded-0">
            <div class="card-body back">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <colgroup>
                            <col width="50%">
                            <col width="50%">
                        </colgroup>
                        <thead>
                            <tr class="headingcol">
                                <th class="px-2 py-1 align-middle">Content</th>
                                <th class="px-2 py-1 align-middle">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr class="belowdata">
                                    <td class="px-2 py-1 align-middle"><?= $row['content']; ?></td>
                                    <td class="px-2 py-1 align-middle"><?= $row['email']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
