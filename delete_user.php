<?php
include 'includes/header.php';

if(!isset($_GET['id'])) echo "<script> window.location.replace('index.php') </script>";
    
     
$sql="DELETE FROM Users WHERE id=".$_GET['id'];
     
 
     
 if ($conn->query($sql) === TRUE) 
 {  echo "<script> window.location.replace('admin.php') </script>";
    echo "Record updated successfully";
    
         
 }
 else
 {
    echo "There was a problem deleting this user!";
 }
   
  
    
    $conn->close();
    

?>