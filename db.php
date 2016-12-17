<?php 
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "spine";
$contador = 0;
        
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

?>