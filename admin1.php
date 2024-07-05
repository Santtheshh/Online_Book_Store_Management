<?php
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
    echo '<script>alert("logged successfully");window.location="admin_book.php";</script>';
	// header('location:admin_book.php');
}
	
?>

					<?php if(isset($_SESSION['err_login'])): ?>
						<div class="alert alert-danger rounded-0">
							<?= $_SESSION['err_login'] ?>
						</div>
					<?php 
						unset($_SESSION['err_login']);
						endif;
					?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <!-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> -->
    
    <title>Ludiflex | Login</title>
</head>
<body>
   <form method="post" action="admin_verify.php">
   <div class="box" >
    <div class="container">
        <div class="top">
            
            <header>Login</header>
        </div>
        <div class="input-field">
            <input type="text" class="input" name="name" placeholder="Username" id="">
            <i class='bx bx-user' ></i>
        </div>
        <br>
        <div class="input-field">
            <input type="Password" class="input" name="pass" placeholder="Password" id="">
            <i class='bx bx-lock-alt'></i>
        </div>
        <br>
        <div class="input-field">
            <input type="submit" name="submit">
        </div>
        <!-- <div class="two-col">
            <div class="one">
               <input type="checkbox" name="" id="check">
               <label for="check"> Remember Me</label>
            </div>
            <div class="two">
                <label><a href="#">Forgot password?</a></label>
            </div>
        </div> -->
    </div>
</div>  
                    </form>
</body>
</html>
<style>
    /* @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap'); */
*{
    font-family: 'poppins' ,sans-serif;
}
body{
    background-image: url("WhatsApp Image 2023-04-30 at 9.22.10 AM.jpeg");
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;
   
    
}
input[type="submit"]{
    width: 100%;
    height: 50px;
    border: 1px sloid;
    background: blue;
    border-radius: 25px;
    font-size: 18px;
    color: white;
    font-weight: 700;
    cursor: pointer;
    outline: none;

}
input[type="submit"]:hover{
    border-color: #2691d9;
    transition:.5s ;


}
.box{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 90vh;
}
.container{
    width: 350px;
    display: flex;
    flex-direction: column;
    padding: 0 15px 0 15px;
    
}
span{
    /* color: #fff; */
    font-size: small;
    display: flex;
    justify-content: center;
    padding: 10px 0 10px 0;
}
header{
    color: #fff;
    font-size: 30px;
    display: flex;
    justify-content: center;
    padding: 10px 0 10px 0;
}
.input-field .input{
    height: 45px;
    width: 87%;
    border: none;
    border-radius: 30px;
    /* color: #fff; */
    font-size: 15px;
    padding: 0 0 0 45px;
    background: rgba(255,255,255,0.1);
    outline: none;
}
i{
    position: relative;
    top: -33px;
    left: 17px;
    color: #fff;
}
::-webkit-input-placeholder{
    color: #fff;
}
.submit{
    border: none;
    border-radius: 30px;
    font-size: 15px;
    height: 45px;
    outline: none;
    width: 100%;
    color: black;
    background: rgba(255,255,255,0.7);
    cursor: pointer;
    transition: .3s ;
}
.submit:hover{
    box-shadow: 1px 5px 7px 1px rgba(0, 0, 0, 0.2);
}
.two-col{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    color: #fff;
    font-size: small;
    margin-top: 10px;
}
.one{
    display: flex;
}
label a{
    text-decoration: none;
    color: #fff;
}
</style>