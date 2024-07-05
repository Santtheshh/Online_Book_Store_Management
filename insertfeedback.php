<form method="get">

<?php
       
      
       include "includes/connection.php";
       

  
session_start();
 $Feedback = $_GET['Feedback'];
$product_code=$_GET['pcode'];
						
						
				
					
						
									$query = "INSERT INTO feedback
								(product_code,user_id,content)
								VALUES ('".$_GET['pcode']."','".$_SESSION['userid']."','".$_GET['Feedback']."')";
								mysqli_query($db,$query)or die ('Error in updating Database');
												
						
							
						
				?>
				</form>		
    	






