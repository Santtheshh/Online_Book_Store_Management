<?php
require_once "./functions/database_functions.php";

$conn = db_connect();
$val=$_GET['e-mail'];
$receiver = "$val";
$subject = "Ordered was cnceled ";
$body = "Hi, ". $receiver ."we sorry to inform you that your order has been canceled";
$sender = "From:santheshspoojary77@gmail.com";
if(mail($receiver, $subject, $body, $sender)){
    mysqli_query($conn, "UPDATE orders SET status = 'Canceled' WHERE orderid='".$_GET['orderid']."'")or die(mysqli_error($db));
    echo '<script>alert("Email sent successfully");window.location="detail.php";</script>';
}else{
    echo '<script>alert("Sorry, failed while sending mail!");window.location="detail.php";</script>';
}
?>