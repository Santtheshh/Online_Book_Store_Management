
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Online Bookstore</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="back">

<nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Simple Online Bookstore</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="publisher_list.php">Publishers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="books.php">Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ufeedback.php">Feedback</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cart.php">My Cart</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <center><h1 class="text-white">Latest Books</h1></center>
 
<?php
  session_start();
  $count = 0;
  
 
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $row = select4LatestBook($conn);
?>
    <!-- <h3 ><a href="index.html" class="text-white text-decoration-none">BACK</a></h3> -->
   
     <center><h1 class="text-white"> Latest books</h1></center>

      
      <div class="row">
        <?php foreach($row as $book) { ?>
      	<div class="col-lg-3 col-md-4 col-sm-6  py-2 mb-2">
      		<a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>" class="card rounded-0 shadow text-reset text-decoration-none">
             <div class="img-holder overflow-hidden">
              <img class="pimg" src="./picture/img/<?php echo $book['book_image']; ?>">
             </div> 
            <div class="card-body">
              <div class="text-white card-title fw-bolder h5 text-center"><?= $book['book_title'] ?></div>
            </div>
          </a>
      	</div>
        <?php } ?>
      </div>
</div>

<a class="btn btn-secondary back-button" href="index.html">Back</a>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

        

