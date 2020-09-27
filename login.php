<?php

$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection 
///Reading info for connection
$info_file = fopen("database.txt", "r") or die("An error has occured when trying to connect to database!");
$info=fread($info_file,filesize("database.txt"));
fclose($info_file);

//setting variables
$info = explode("/", $info);
$db_servername = $info[0];
$db_username = $info[1];
$db_password = $info[2];
$db_database = $info[3];

$conn = new mysqli($db_servername, $db_username, $db_password,$db_database);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);


   
// SQL query to fetch information of registerd users and finds user match.
    $sql="select * from Users where username='".$username."'";
   

$result = $conn->query($sql);
    
if ($result->num_rows > 0) {
    
      
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])){
   //session_start(); // Starting Session
    // Initializing Session   
    $_SESSION['username']=$username; 
    $_SESSION['role']=$row['role'];
    $_SESSION['LAST_ACTIVITY'] = time();
        
        if($row['role'] == 'Admin')  echo "<script> window.location.replace('admin.php') </script>";  // Redirecting To Admin Page
        else                         echo "<script> window.location.replace('dashboard.php') </script>";  // Redirecting To Dashboard Page

} else{
       
    $error = "Username or Password is invalid!";
}
}else{
    
    $error = "Username or Password is invalid!";
}

echo "<p style='position:absolute;color:red;top:80%;left:57%;'>$error</p>";
$conn->close();

}
}
?>



