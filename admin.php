<?php

//header
include('includes/header.php');

if($_SESSION['role'] != 'Admin') echo "<script> window.location.replace('dashboard.php') </script>";

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Panel</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">

	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">

	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                    
                <?php
    
    
                echo "
                    
                    <h3 style='text-align:center;margin-bottom:3%;'>Admin Panel</h3>";
                
                    
                
                        // query for gettings tasks for user
                        $sql = "SELECT * from Users WHERE role != 'Admin' ORDER BY username ASC";
                        //executing query
                        $result = $conn->query($sql);
                        //setting vars
                        if ($result->num_rows > 0)
                        {  
                            
                            echo "
                                    <div style='width:100%; border: 5px solid transparent;border-image: linear-gradient(to bottom right, #b827fc 0%, #2c90fc 25%, #b8fd33 50%, #fec837 75%, #fd1892 100%);border-image-slice: 1;'>
                                            <table style='width:100%;'>
                                 ";
                            //table head

                            echo "
                                    <tr>
                                        
                                        <td style='text-align:center;font-weight:bolder;'>User</td>
                                        <td style='text-align:center;font-weight:bolder;'>Role</td>
                                        <td style='text-align:center;font-weight:bolder;'>Promote/Demote</td>
                                        <td style='width:15px;border:0px solid black;'></td>

                                    </tr>
                            
                                 ";

                            while($row = $result->fetch_assoc())
                            {   
                                $user = $row['username'];
                                $role = $row['role'];
                                if($row['role'] == 'Team Member') $promote_demote=1;
                                else $promote_demote=0;
                                
                                echo "
                                        <tr style='border-top:1px solid black;border-radius:50px;'>
                                            <td style='text-align:center;text-align:center;'>$user </td>
                                            <td style='text-align:center;text-align:center;'>$role </td>
                                            <td style='text-align:center;text-align:center;'><div style='cursor: pointer;' 
                                        onclick='        
                                                  var x = confirm(\"Are you sure you want to ".(($promote_demote?"promote ":"demote ")).$row['username']."?\");
                       if(x == true) window.location.replace(\"promote_demote.php?do=$promote_demote&id=".$row['id']."\");'><i class='fa fa-arrow-".(($promote_demote==1) ? "up":"down")."' aria-hidden='true'></i></td>
                                            <td><div style='cursor: pointer;' 
                                        onclick='        
                                                  var x = confirm(\"Are you sure you want to delete ".$row['username']."?\");
                       if(x == true) window.location.replace(\"delete_user.php?id=".$row['id']."\");'><img  src='images/icons/cross.png'/></div></td>

                                        </tr>
                                
                                     ";
                                
                                
                            }
                            echo "</table></div>";
                        }
                    
                        else echo "<br/><br/><h2 style='color:red;margin-left:12%;'>You have no tasks assigned for today!</h2>
                                    <div style='width:100%;height:100px;'></div>
                                        
                                  ";
                    
    
    
    
    
    
                ?>
                    
                    <br/><br/>
				
					<ul style='margin-left:40%;'>
                        <br/>
						<a class='login100-form-btn' href="create_user.php"><li>Create an User</li></a>

					</ul>
                
                                    
				
					<ul style='margin-left:38%;margin-top:5%;'>
                     <a href="logout.php" style="color:black;font-weight:bolder;" ><li class='menu-option' style='border-bottom:1px solid black'>Log Out</li></a>
					</ul>
				</div>

			</div>
		</div>

	
	

	
	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>

	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	<script src="vendor/select2/select2.min.js"></script>

	<script src="vendor/tilt/tilt.jquery.min.js"></script>


	<script src="js/main.js"></script>

</body>
</html>