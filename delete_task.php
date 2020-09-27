<?php
include 'includes/header.php';

if(!isset($_GET['id'])) echo "<script> window.location.replace('tasks.php') </script>";
    
     
$sql="DELETE FROM Tasks WHERE id=".$_GET['id'];
     
 
     
 if ($conn->query($sql) === TRUE)   
 {  
     echo "<script> window.location.replace('tasks.php') </script>";
    echo "Record updated successfully";
    
         
 }
 else
 {
    echo "There was a problem deleting this task!";
 }
   
  
    
    $conn->close();
    

?>