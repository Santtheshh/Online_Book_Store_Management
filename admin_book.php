<?php
	session_start();
	// require_once "./functions/admin1.php";
	$title = "List book";
	
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getAll($conn);
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
        .headingcol {
            border: 1px solid black;
        }
        .belowdata {
            border: 1px solid black;
        }
        .align-middle {
            vertical-align: middle !important;
        }
        .text-center {
            text-align: center !important;
        }
        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            width: 15em;
        }
        .px-2 {
            padding-right: 0.25rem !important;
            padding-left: 0.25rem !important;
        }
        .card {
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }
        .card-body {
            padding: 1rem;
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
    <?php 
        unset($_SESSION['book_success']);
    endif;
    ?>

    <div class="container mt-4">
        <h2 class="fw-bolder text-center"><?= $title ?></h2>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="headingcol">
                                <th>ISBN</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Publisher</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="belowdata">
                                <td class="underline align-middle"><?= $row['book_isbn'];?></td>
                                <td class="align-middle"><?= $row['book_title']; ?></td>
                                <td class="align-middle"><?= $row['book_author']; ?></td>
                                <td class="align-middle"><?= $row['book_image']; ?></td>
                                <td class="align-middle"><p class="text-truncate"><?= $row['book_descr']; ?></p></td>
                                <td class="align-middle"><?= $row['book_price']; ?></td>
                                <td class="align-middle"><?= getPubName($conn, $row['publisherid']); ?></td>
                                <td class="text-center align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <a href="admin_edit.php?bookisbn=<?= $row['book_isbn']; ?>" class="btn btn-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="admin_delete.php?bookisbn=<?= $row['book_isbn']; ?>" class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure to delete this book?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>

