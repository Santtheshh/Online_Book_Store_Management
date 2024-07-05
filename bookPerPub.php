<?php
	session_start();
	require_once "./functions/database_functions.php";
	// get pubid
	if(isset($_GET['pubid'])){
		$pubid = $_GET['pubid'];
	} else {
		echo "Wrong query! Check again!";
		exit;
	}

	// connect database
	$conn = db_connect();
	$pubName = getPubName($conn, $pubid);

	$query = "SELECT book_isbn, book_title, book_image, book_descr FROM books WHERE publisherid = '$pubid'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	if(mysqli_num_rows($result) == 0){
	 echo '<script>alert("no books found! please wait untill new book arrived.");window.location="publisher_list.php";</script>';
		exit;
	}

	
?>
<style>
	.book-item .img-holder {
		height: 20em;
	}
	.book-item:nth-child(even){
		direction: rtl !important;
	}
	.breadcrumb {
    display: flex;
    flex-wrap: wrap;
    padding: 0 0;
    margin-bottom: 1rem;
    list-style: none
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
.btn{
  display:inline-block;
  font-weight:400;
  line-height:1.5;
  text-align:center;
  vertical-align:middle;
  text-decoration:none;
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
.row {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(var(--bs-gutter-y) * -1);
    margin-right: calc(var(--bs-gutter-x) * -.5);
    margin-left: calc(var(--bs-gutter-x) * -.5)
}
.mb-2 {
    margin-bottom: .5rem !important
}
.col-md-3 {
        flex: 0 0 auto;
        width: 25%
    }
	.col-md-9 {
        flex: 0 0 auto;
        width: 75%
    }
	.rounded-0 {
    border-radius: 0 !important
}

</style>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="publisher_list.php" class="text-decoration-none text-muted fw-light">Publishers</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo $pubName; ?></li>
		</ol>
	</nav>
	<div id="pubBooks">
	<?php while($row = mysqli_fetch_assoc($result)){
?>
	<div class="row book-item mb-2">
		<div class="col-md-3">
			<div class="img-holder overflow-hidden">
				<img class="img-top" src="./picture/img/<?php echo $row['book_image'];?>">
			</div>
		</div>
		<div class="col-md-9">
			<h4><?php echo $row['book_title'];?></h4>
			<hr>
			<p class="truncate-5"><?= $row['book_descr'] ?></p>
			<a href="book.php?bookisbn=<?php echo $row['book_isbn'];?>" class="btn btn-primary">Get Details</a>
		</div>
	</div>
<?php
	}
?>
</div>


