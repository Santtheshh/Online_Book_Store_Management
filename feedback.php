
<?php include 'includes/header.php'; ?>

<!--sidebar area-->
<?php include 'includes/sidebar.php'; ?>


<?php
// session_start();
?><!doctype html>
<head>
<style>
.top{
    margin:auto;
    padding:25px;
    background-color:pink;
    color:black;
    font-family:sans-serif;
    
}
.bottom{
    padding:50px;
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


    </style>


</head>
<body><form method="POST" action="">
    <div class="top">
        <h1>Feedback</h1>
    <div class="bottom">
    <!-- <label>First Name</label><input type="text" name="fn" ><br><br>
    <label>Email Id</label><input type="text" name="eid"><br><br> -->
    <label>Enter Feedback</label><textarea rows="5" cols="25" placeholder="Write Your feedback..." name="fee"></textarea><br><br>
    <label>Product code</label><input type="text" id="pro" name="pro" class="form-control" value="<?php echo $_GET['id'];?>">
    <button class="c" name="feed">Submit</button>
</div></div>
</form>
    </body>
</html>
<?php
 $r=$_SESSION['userid'];
if(isset($_POST['feed']))
{
    date_default_timezone_set('Asia/Kolkata');
    $date=date('y-m-d h:i:s');
// $fn=$_POST['fn'];
// $eid=$_POST['eid'];
$fee=$_POST['fee'];
$pro=$_POST['pro'];
// include 'connect.php';
include "includes/connection.php";
$qry="select * from tblusers where user_id='".$r."' "; 
$rslt=$db->query($qry);
if($rslt->num_rows!=0)
{
    while($rs=$rslt->fetch_assoc())
{
    $r=
    $qry="insert into feedback(user_id,content,product_code)values('".$rs['user_id']."','".$fee."','".$pro."') ";
    $rslt=$db->query($qry);
    echo'<script>alert(" feedback sent.. ");window.location="order.php";</script>';


}
}
else
{
    echo'<script>alert("No Email Id Found");window.refresh="order.php";</script>';

}
$db->close();
}
?>

