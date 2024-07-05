<?php
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
	header('location:admin_book.php');
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
					<form method="post" action="admin_verify.php">
						
					<div class="center">
                <h1>login</h1>
                
                    <div class="txt_field">
                        
                        <input type="text" name="name"required>
                        <span></span>
                        <label>username</label>
    
                    </div>
                    <div class="txt_field">
                        <input type="password" name="pass"required>
                        <span></span>
                        <label>password</label>
                        
                        </div>
                        <input type="submit" name="submit" value="submit">

					</form>
	 <style>
                	/* body{
    margin: 0;
    padding: 0;
    font-family: montserrat;
    background:linear-gradient(120deg,blue,pink);
     /* background:url("back.jpg"); */
    /* height: 100vh; */
    /* overflow: hidden; */
/* /* }  */
body{
    background-image: url("WhatsApp Image 2023-04-30 at 9.22.10 AM.jpeg");
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;
   
    
}
.center{
    position:absolute;
    top:50%;
    left: 50%;
    transform: translate(-50%,-50%);
    width: 400px;
    background :white;
    border-radius: 10px;

}
.center h1{
    text-align: center;
    padding: 0 0 20px 0;
    border-bottom: 1 px solid silver;
}
.center form{
    padding: 0 40px;
    box-sizing: border-box;
    

}
form .txt_field{
    position: relative;
    border-bottom: 2px solid #adadad;
    margin: 30px 0;
}
.txt_field input{
    /* width: 100%;
    padding: 0 5px;
    height: 40px;
    font-size: 16px;
    border:none;
    background: none;
    outline: none; */
    height: 45px;
    width: 87%;
    border: none;
    border-radius: 30px;
    color: #fff;
    font-size: 15px;
    padding: 0 0 0 45px;
    background: rgba(255,255,255,0.1);
    outline: none;
}
.txt_field label{
    position: absolute;
    top: 50%;
    left: 5px;
    color: #adadad;
    transform: translateY(-50%);
    font-size: 16px;
    pointer-events: none;
    transition: .5s;

}
.txt_field span::before{
    content: '';
    position: absolute;
    top: 40px;
    left: 0;
    width: 0%;
    height: 2px;
    background: #2691d9;
    transition: .5s;

}
.txt_field input:focus ~ label,
.txt_field input:valid ~ label{
    top: -5px;
    color: #2691d9;
}
.txt_field input:focus ~ span::before,
.txt_field input:valid ~ span::before{
    width: 100%;
}
.pass{
    margin: -5px 0 20;
    color: #a6a6a6;
    cursor: pointer;

}
.pass:hover{
    text-decoration: underline;

}
input[type="submit"]{
    width: 100%;
    height: 50px;
    border: 1px sloid;
    background: #2691d9;
    border-radius: 25px;
    font-size: 18px;
    color: #e9f4fb;
    font-weight: 700;
    cursor: pointer;
    outline: none;

}
input[type="submit"]:hover{
    border-color: #2691d9;
    transition:.5s ;


}
</style>

