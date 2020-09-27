<?php

//header
include('includes/header.php');
if($_SESSION['role'] != 'Admin') echo "<script> window.location.replace('index.php') </script>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $username = stripslashes($_POST['username']);
    $password = stripslashes($_POST['password']);
    
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    $role = stripslashes($_POST['role']);
    $role = mysqli_real_escape_string($conn, $role);
    
    $sql = "INSERT INTO `Users` (`id`, `username`, `password`, `role`) VALUES (NULL, '$username', '$password', '$role')";
    

    if(mysqli_query($conn, $sql)) echo "<script> window.location.replace('admin.php') </script>";
    else echo "<h3 style='text-align:center;color:red;'>There was a problem creating the user!</h3>";


}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Create User </title>
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


                
                <form class="login100-form validate-form" method="post" action="create_user.php" style="margin-left:30%;">
					<span class="login100-form-title">
						 Create a user
					</span>

                    <div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Username &lrm; &lrm; &lrm; &lrm; &lrm; &lrm; &lrm; &lrm; &lrm; &lrm; &lrm;" style="text-align:center;"/>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
                    
                

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password	&lrm;	&lrm;" style="text-align:center;">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
					   <i class="fa fa-key" aria-hidden="true"></i>
						</span>
					</div>
        
                    
                    <div class="wrap-input100 validate-input" data-validate = "Role is required" style="margin-left:25%;">
                        <select name='role' required>
                            <option disabled hidden selected value="">Choose a Role</option>    
                            <option value="Team Member">Team Member</option>
                            <option value="Team Leader">Team Leader</option>
                        </select>
						<span class="focus-input100"></span>
						<span class="symbol-input100" style="margin-left:70%;">
					         
						</span>
					</div>

					
					<div class="container-login100-form-btn">
						<input type="submit" class="login100-form-btn" value="Create User" name="submit"/>
					</div>
					

										
					<div class="text-center p-t-136">

					</div>

				</form>
				

		
				
				    <ul style='margin-left:38%;'>
                     <a href="admin.php" style="color:black;font-weight:bolder;" ><li class='menu-option' style='border-bottom:1px solid black'>Back to Admin Panel</li></a>
					</ul>
				

			</div>
		</div>
	</div>
	
	

	
	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>

	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	<script src="vendor/select2/select2.min.js"></script>

	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

	<script src="js/main.js"></script>

</body>
</html>