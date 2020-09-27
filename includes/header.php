<?php
session_start(); // Starting Session

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
 echo "<script> window.location.replace('../index.php') </script>";
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


if(!isset($_SESSION['username'])) 
{
    include 'logout.php';
 
}


$info_file = fopen("database.txt", "r") or die("An error has occured when trying to connect to database!");
$info=fread($info_file,filesize("database.txt"));
fclose($info_file);

//setting variables
$info = explode("/", $info);
$db_servername = $info[0];
$db_username = $info[1];
$db_password = $info[2];
$db_database = $info[3];

// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 