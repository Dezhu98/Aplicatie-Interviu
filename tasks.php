<?php

//header
include('includes/header.php');

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title> All Tasks</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        

    #overlay {
    
    position: fixed;
    opacity: 0;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background-color:rgba(0,0,0,0.5);
    pointer-events: none;
    transition: 200ms ease-in-out;

    
    
}
        
   #overlay.active
        {
            pointer-events: all;
            opacity: 1;
        }
        
    .modalsss {
    
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    border: 1px solid black;
    border-radius:10px;
    z-index: 10;
    background-color:white;
    width:500px;
    max-width:80%;
    transition: 200ms ease-in-out;
        }
        
    .modalsss.active {

    transform: translate(-50%, -50%) scale(1);

}
    </style>
	
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
                    <h3 style="text-align:center;">My Tasks</h3>
                    <ul style="margin-left:90%; margin-bottom:10%;">
                    <a href="create_task.php"><li class="login100-form-btn" style="width:160px;">Create&nbsp;Task</li></a>
                    </ul>
				    
                
                    <?php
                
                        // query for gettings tasks for user
                        $sql = "SELECT * from Tasks WHERE forwho='".$_SESSION['username']."' ORDER BY duedate";
                        //executing query
                        $result = $conn->query($sql);
                        //setting vars
                        if ($result->num_rows > 0)
                        {  
                            
                            echo "
                                    <div style='width:100%; border: 5px solid transparent;border-image: linear-gradient(to bottom right, #b827fc 0%, #2c90fc 25%, #b8fd33 50%, #fec837 75%, #fd1892 100%);border-image-slice: 1;'>
                                            <table style='width:100%;'>
                                 ";
                            //capul de tabel
                            $color = "#" . dechex(rand(0, 0xFFFFFF));
                            echo "
                                    <tr>
                                        
                                        <td style='text-align:center;font-weight:bolder;'>Task</td>
                                        <td style='color:blue;text-align:center;font-weight:bolder;'>Due Date</td>
                                        <td style='text-align:center;font-weight:bolder;'>Urgency Level</td>
                                        <td style='width:15px;border:0px solid black;'></td>
                                    </tr>
                            
                                 ";
                            $count = 0;
                            while($row = $result->fetch_assoc())
                            {   $color = "#" . dechex(rand(0, 0xFFFFFF));
                                $whocreated = $row['whocreated'];
                                $duedate = $row['duedate'];
                                $importance_level = $row['importance_level'];
                                $taskname = $row['taskname'];
                                $task = $row['task'];
                                $count= $count+1;
                                echo "
                                        <tr style='border-top:1px solid black;border-radius:50px;'>
                                            <td style='text-align:center;text-align:center;'>$taskname <button data-modal-target='#modal$count' ><img src='images/icons/popup.png' /></button></td>
                                            
                                            <div class='modalsss' id='modal$count' >
                                                <div class='modal-header'>
                                                    <div class='title'>$taskname</div>
                                                    <button data-close-button class='close-button'>&times;</button>
                                                </div>
                                                <div class='modal-body'>
                                                   $task
                                                </div>
                                            </div>
                                            <div id='overlay'></div>
                                            
                                            
                                            
                                            <td style='color:blue;text-align:center;'>$duedate</td>
                                            ".(($importance_level == 1)?"<td style='color:red;font-weight:bolder;text-align:center;'>Very urgent!</td>"
                                                           :"<td style='text-align:center;'>Not so urgent</td>").
                                            
                                        "<td>".(($row['whocreated']==$_SESSION['username']) ? "<div style='cursor: pointer;' 
                                        onclick='        
                                                  var x = confirm(\"Are you sure you want to delete this task?\");
                       if(x == true) window.location.replace(\"delete_task.php?id=".$row['id']."\");'><img src='images/icons/cross.png'                                                                           /></div>":"")."</td></tr>
                                
                                     ";
                                
                                
                            }
                            echo "</table></div>";
                        }
                    
                        else echo "<h1 style='color:red;margin-left:12%;'>You have no tasks assigned!</h1>
                                    <div style='width:100%;height:100px;'></div>
                                        
                                  ";
                        
                
                
                
                if($_SESSION['role'] == 'Team Leader')
                    
                {
                    echo "
                    
                    
                    <h3 style='text-align:center;margin-top:5%;'>Tasks for Members</h3>
                    <ul style='margin-left:90%; margin-bottom:10%;'>
<a href='create_task_leader.php'><li class='login100-form-btn' style='font-size:11px;width:160px;'>Create Task for &nbsp; &nbsp;Team Member</li></a>
                    </ul>";
				    
                
                    
                
                        // query for gettings tasks for user
                        $sql = "SELECT * from Tasks WHERE forwho !='".$_SESSION['username']."' AND whocreated ='".$_SESSION['username']."' ORDER BY duedate";
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
                            $color = "#" . dechex(rand(0, 0xFFFFFF));
                            echo "
                                    <tr>
                                        
                                        <td style='text-align:center;font-weight:bolder;'>Task</td>
                                        <td style='text-align:center;font-weight:bolder;'>For</td>
                                        <td style='color:blue;text-align:center;font-weight:bolder;'>Due Date</td>
                                        <td style='text-align:center;font-weight:bolder;'>Urgency Level</td>
                                        <td style='width:15px;border:0px solid black;'></td>
                                    </tr>
                            
                                 ";
                            $count = 1000;
                            while($row = $result->fetch_assoc())
                            {   $color = "#" . dechex(rand(0, 0xFFFFFF));
                                $whocreated = $row['whocreated'];
                                $duedate = $row['duedate'];
                                $importance_level = $row['importance_level'];
                                $taskname = $row['taskname'];
                                $task = $row['task'];
                                $forwho = $row['forwho'];
                                $count= $count+1;
                                echo "
                                        <tr style='border-top:1px solid black;border-radius:50px;'>
                                            <td style='text-align:center;text-align:center;'>$taskname <button data-modal-target='#modal$count' ><img src='images/icons/popup.png' /></button></td>
                                            
                                            <div class='modalsss' id='modal$count' >
                                                <div class='modal-header'>
                                                    <div class='title'>$taskname</div>
                                                    <button data-close-button class='close-button'>&times;</button>
                                                </div>
                                                <div class='modal-body'>
                                                   $task
                                                </div>
                                            </div>
                                            <div id='overlay'></div>
                                            
                                            
                                            <td style='text-align:center'>$forwho</td>
                                            <td style='color:blue;text-align:center;'>$duedate</td>
                                            ".(($importance_level == 1)?"<td style='color:red;font-weight:bolder;text-align:center;'>Very urgent!</td>"
                                                           :"<td style='text-align:center;'>Not so urgent</td>").
                                            
                                        "<td>".(($row['whocreated']==$_SESSION['username']) ? "<div style='cursor: pointer;' 
                                        onclick='        
                                                  var x = confirm(\"Are you sure you want to delete this task?\");
                       if(x == true) window.location.replace(\"delete_task.php?id=".$row['id']."\");'><img src='images/icons/cross.png'                                                                           /></div>":"")."</td></tr>
                                
                                     ";
                                
                                
                            }
                            echo "</table></div>";
                        }
                    
                        else echo "<h1 style='color:red;margin-left:12%;'>You have no tasks assigned!</h1>
                                    <div style='width:100%;height:100px;'></div>
                                        
                                  ";
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                }
                
                
                
                
                
                
                
                
                    ?>
                
				<div style="width:100%;border-bottom:1px solid grey;float:right;margin-top:10%;">
				
					<ul>
						<a style="color:black;font-weight:bolder;" href="dashboard.php"><li  class="menu-option" >Dashboard</li></a>
						<a style="color:black;font-weight:bolder;" href="tasks.php"><li style='background-color:#dee0e9;color:red;' class="menu-option"> All Tasks</li></a>
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
    
    
    <script>
const openModalButtons = document.querySelectorAll('[data-modal-target]')
const closeModalButtons = document.querySelectorAll('[data-close-button]')
const overlay = document.getElementById('overlay')

openModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = document.querySelector(button.dataset.modalTarget)
    openModal(modal)
  })
})

overlay.addEventListener('click', () => {
  const modals = document.querySelectorAll('.modalsss.active')
  modals.forEach(modal => {
    closeModal(modal)
  })
})

closeModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = button.closest('.modalsss')
    closeModal(modal)
  })
})

function openModal(modal) {
  if (modal == null) return
  modal.classList.add('active')
  overlay.classList.add('active')
}

function closeModal(modal) {
  if (modal == null) return
  modal.classList.remove('active')
  overlay.classList.remove('active')
}
    </script>
    

	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
        

	</script>

	<script src="js/main.js"></script>

</body>
</html>