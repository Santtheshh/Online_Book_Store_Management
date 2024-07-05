 <?php
  session_start();
  $count = 0;
  // connecto database
  require_once "./functions/database_functions.php";
  $conn = db_connect();

  $query = "SELECT book_isbn, book_image, book_title FROM books";
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of All Books</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
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

    <h3><a href="index.php" class="text-white text-decoration-none">BACK</a></h3>
    <center><h1 class="white"> List of All Books</h1></center>
    <div class="container">
    <?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
      
      <div class="row">
        <?php while($book = mysqli_fetch_assoc($result)){ ?>
          
          <div class="col-lg-3 col-md-4 col-sm-6  py-2 mb-3">
            
      		<a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>" class="card rounded-0 shadow  text-reset text-decoration-none">
            <div class="img-holder overflow-hidden">
              <img class="pimg" src="./picture/img/<?php echo $book['book_image']; ?>">
            </div>
            <div class="card-body">
              <div class="text-deco card-title fw-bolder h5 "><?= $book['book_title'] ?></div>
            </div>
            
          </a>
      	</div>
        <?php
          $count++;
          if($count >= 4){
              $count = 0;
              break;
            }
          } ?> 
      </div>
<?php
      }
  if(isset($conn)) { mysqli_close($conn); }

?>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


