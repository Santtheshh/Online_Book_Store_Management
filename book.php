<?php
  session_start();
  $book_isbn = $_GET['bookisbn'];
  // connecto database
  require_once "./functions/database_functions.php";
  $conn = db_connect();

  $query = "SELECT * FROM books WHERE book_isbn = '$book_isbn'";
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }

  $row = mysqli_fetch_assoc($result);
  if(!$row){
    echo "Empty book";
    exit;
  }


?>
      <!-- Example row of columns -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="books.php" class="text-decoration-none text-muted fw-light">Book Publishers</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo $row['book_title']; ?></li>
        </ol>
      </nav>
      <div class="row">
        <div class="col-md-3 text-center">
          <div class="pimg overflow-hidden">
          <img class="img-top" src="./picture/img/<?php echo $row['book_image']; ?>">
          </div>
        </div>
        <div class="col-md-9">
          <div class="card rounded-0 shadow">
            <div class="card-body">
              <div class="container-fluid">
                <h2><?= $row['book_title'] ?></h2>
                <hr>
                  <p><?php echo $row['book_descr']; ?></p>
                  <h4>Details</h4>
                  <table class="table">
                    <?php foreach($row as $key => $value){
                      if($key == "book_descr" || $key == "book_image" || $key == "publisherid" || $key == "book_title"){
                        continue;
                      }
                      switch($key){
                        case "book_isbn":
                          $key = "ISBN";
                          break;
                        case "book_title":
                          $key = "Title";
                          break;
                        case "book_author":
                          $key = "Author";
                          break;
                        case "book_price":
                          $key = "Price";
                          break;
                      }
                    ?>
                    <tr>
                      <td><?php echo $key; ?></td>
                      <td><?php echo $value; ?></td>
                    </tr>
                    <?php 
                      } 
                      if(isset($conn)) {mysqli_close($conn); }
                    ?>
                  </table>
                  <form method="post" action="cart.php">
                    <input type="hidden" name="bookisbn" value="<?php echo $book_isbn;?>">
                    <div class="text-center">
                      <input type="submit" value="Purchase / Add to cart" name="cart" class="btn btn-primary rounded-0">
                    </div>
                  </form>
              </div>
            </div>
          </div>
       	</div>
      </div>
      <!DOCTYPE html>
<html>
<head>
    <title>Back Button Example</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <a class="back-button" href="javascript:history.back()">Back</a>
</body>
</html>
<style>
.back-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #f1f1f1;
    color: #333;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
}

.back-button:hover {
    background-color: #ddd;
}
</style>
<style>
  	.breadcrumb {
    display: flex;
    flex-wrap: wrap;
    padding: 0 0;
    margin-bottom: 1rem;
    list-style: none
}


.overflow-hidden {
    overflow: hidden !important
}

.breadcrumb-item+.breadcrumb-item {
    padding-left: .5rem
}
.text-decoration-none {
    text-decoration: none !important
}
.text-muted {
    --bs-text-opacity: 1;
    color: #6c757d !important
}
.fw-light {
    font-weight: 300 !important
}
.col-md-3 {
        flex: 0 0 auto;
        width: 25%
    }
	.col-md-9 {
        flex: 0 0 auto;
        width: 75%
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
.btn{
  display:inline-block;
  font-weight:400;
  line-height:1.5;
  text-align:center;
  vertical-align:middle;
  user-select:none;
  border:1px solid white transparent;
  padding:.375rem.75rem;
  font-size:1rem;
}
.btn-primary {
    color: #fff;
    background-color: #0d6efd;
    border-color: #0d6efd
}
.text-center {
    text-align: center !important
}
table {
    caption-side: bottom;
    border-collapse: collapse
}
.card-body {
    flex: 1 1 auto;
    padding: 1rem 1rem
}

.container-fluid
 {
    width: 100%;
    padding-right: var(--bs-gutter-x, .75rem);
    padding-left: var(--bs-gutter-x, .75rem);
    margin-right: auto;
    margin-left: auto
}
.shadow {
    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important
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
.pimg{
    height:500px;
    width:300px;
}


  </style>