<?php

//header
include('includes/header.php');

if($_SESSION['role'] != 'Team Leader') echo "<script> window.location.replace('index.php') </script>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $task = stripslashes($_POST['task']);
    $duedate = stripslashes($_POST['duedate']);
    $forwho = stripslashes($_POST['forwho']);
    
    $task = mysqli_real_escape_string($conn, $task);
    $duedate = mysqli_real_escape_string($conn, $duedate);
    $forwho = mysqli_real_escape_string($conn, $forwho);
    
    $taskname = stripslashes($_POST['taskname']);
    $taskname = mysqli_real_escape_string($conn, $taskname);
    
    
    $sql = "INSERT INTO `Tasks` (`id`, `whocreated`, `forwho`, `duedate`, `importance_level`, `task` ,`taskname`) VALUES (NULL, '".$_SESSION['username']."', '$forwho', '$duedate', '".$_POST['urgency']."', '$task', '$taskname')";

    if(mysqli_query($conn, $sql)) echo "<h3 style='text-align:center;color:green;position:absolute;top:23%;left:26%;font-size:16px;'>The task was successfully created!The member has recieved his task.</h3>";
    else echo "<h3 style='text-align:center;color:red;'>There was a problem creating your task!</h3>";

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Create a task</title>
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


                
                <form class="login100-form validate-form" method="post" action="create_task_leader.php" style="margin-left:30%;">
					<span class="login100-form-title">
						<h4 style='font-size:20px;'> Create  task for a member</h4>
					</span>

                    
                    <div class="wrap-input100 validate-input" data-validate = "Task Name is required">
						<input class="input100" type="text" name="taskname" placeholder="Task Name &lrm; &lrm; &lrm; &lrm; &lrm; &lrm; &lrm; &lrm; &lrm; &lrm; &lrm;" style="text-align:center;"/>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-edit" aria-hidden="true"></i>
						</span>
					</div>
                    
                    
                    
					<div class="wrap-input100 validate-input" data-validate = "Task is required">
                        <textarea class="input100"  name="task" placeholder="&#10;&#10;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your Task" style="height:100px;width:290px;word-break: break-word;margin-left:0%;" ></textarea>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-suitcase" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Date is required">
						<input class="input100" type="text" name="duedate" placeholder="Due Date	&lrm;	&lrm;" style="text-align:center;" onfocus="(this.type='date')">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
					           <i class="fa fa-calendar" aria-hidden="true"></i>
						</span>
					</div>
                    
                   <div class="wrap-input100 validate-input" d>
                       <h4 style='text-align:center;color:red;'>Urgent Task?</h4><br/>
                       <h5 style='text-align:center;'>No</h5>
                       <input class="input100" type="radio" name="urgency" value="0" checked>
                       <h5 style='text-align:center;'>Yes</h5>
                       <input class="input100" type="radio" name="urgency" value="1">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
					
						</span>
					</div>
                    
                    <?php
                        //we will create a dropdown with all team members to avoid human error
                        $sql = "SELECT DISTINCT username FROM Users WHERE role='Team Member'";
                        $result = $conn->query($sql);
                    ?>
                    
                   <div class="wrap-input100 validate-input" data-validate = "Member is required" style="margin-left:10%;">
                        <select name='forwho' required>
                        <option disabled hidden selected value="">Choose a Team Member</option>    
                                <?php 
                                      if ($result->num_rows > 0)
                                      {
                                          while($row = $result->fetch_assoc())
                                          {
                                              echo "<option value='".$row['username']."'>".$row['username']."</option>";
                                          }
                                      }
                                ?>
                            
                        </select>
						<span class="focus-input100"></span>
						<span class="symbol-input100" style="margin-left:70%;">
					           <i class="fa fa-group" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<input type="submit" class="login100-form-btn" value="Create Task" name="submit"/>
					</div>
					

										
					<div class="text-center p-t-136">

					</div>

				</form>
				

				<div style="width:800px;border-bottom:1px solid grey;position:relative;bottom:0%;left:0%;">
				
					<ul>
						<a style="color:black;font-weight:bolder;" href="dashboard.php"><li  class="menu-option" >Dashboard</li></a>
						<a style="color:black;font-weight:bolder;" href="tasks.php"><li  class="menu-option">All Tasks</li></a>
						<a style="color:black;font-weight:bolder;" href="logout.php"><li  class="menu-option">Log Out</li></a>


					</ul>
				</div>

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