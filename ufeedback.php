<?php
// session_start();
?><!doctype html>
<head>
<style>
.top{
    margin:auto;
    padding:180px;
    background-color:black;
    color:black;
    background-color: black !important
    font-family:sans-serif;
    
}
.bottom{
    align-items:right;
    padding:80px;
    height:100px;
    width:400px;
    background-color:lightblue;
    font-size: 27px;
    font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;

}
.c{
    background-color: purple;
    color: white;
    border-radius: 7px;
    font-size: 25px;
}

#navbar{
    display: flex;
    align-items: center;
    background-color: black;
    position: sticky;
    top: 0px;
}

#navbar::before{
    content: "";
    background-color: black;
    color:black;
    position: absolute;
    top:0px;
    left:0px;
    height: 100%;
    width:100%;
    z-index: -1;
    opacity: 0.7;
}
#navbar ul{
    display: flex;
    font-family: 'Baloo Bhai', cursive;
}

#navbar ul li{ 
    list-style: none;
    font-size: 1.3rem;
}

#navbar ul li a{
    color: white;
    display: block;
    padding: 3px 22px;
    border-radius: 20px;
    text-decoration: none;
}

#navbar ul li a:hover{
    color: black;
    background-color: white;
}
				.fw-bolder {
    font-weight: bolder !important
}
.h5,
h5 {
    font-size: 2.25rem
}
.text-center {
    text-align: center !important
}

    </style>


</head>
<body><form method="POST" action="">
<body class="back">
         <nav id="navbar">
             
             <ul>
                    <li class="item"><a href="index.php">simple online bookstore</a></li>
                    <li class="item"><a href="publisher_list.php">publishers</a></li>
                    <li class="item"><a href="books.php">books</a></li>
                    <li class="item"><a href="ufeedback.php">feedback</a></li>
               
                       
                    <li class="item"><a href="cart.php">my cart</a></li>
            </ul>
                     <br>
                     <br>
                     <br>
                     
                     
        </nav>
    <div class="top">
        <h1>Feedback</h1>
    <div class="bottom">
    <!-- <label>First Name</label><input type="text" name="fn" ><br><br>
    <label>Email Id</label><input type="text" name="eid"><br><br> -->
    <label>Enter Feedback</label><textarea rows="5" cols="25" placeholder="Write Your feedback..." name="fee" required></textarea><br><br>
    <label>Email Id</label><input type="text" id="pro" name="pro" class="form-control" required >
    <button class="c" name="feed">Submit</button>
</div></div>
</form>
    </body>
</html>
<?php
$db=mysqli_connect('localhost','root','')or
die('unable');
mysqli_select_db($db,'obs_db')or die(mysqli_error($db));

 
if(isset($_POST['feed']))
{
    date_default_timezone_set('Asia/Kolkata');
    $date=date('y-m-d h:i:s');
// $fn=$_POST['fn'];
// $eid=$_POST['eid'];
$fee=$_POST['fee'];
$pro=$_POST['pro'];
// include 'connect.php';
 include "functions/database_functions.php>";
$qry="select * from customers where email='".$pro."' ";
$rslt=$db->query($qry);

if($rslt->num_rows!=0){

    while($rs=$rslt->fetch_assoc())
{ 
    
    $qry="insert into feedback(email,content)values('".$pro."','".$fee."') ";
    $rslt=$db->query($qry);
    echo'<script>alert(" feedback sent.. ");window.location="";</script>';


}
}
else
{
    echo'<script>alert("No Email Id Found");window.refresh="";</script>';

}
$db->close();
}
?>

