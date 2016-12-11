<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'root');
   define('DB_DATABASE', 'spine');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);


if (!$db){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($db, DB_DATABASE);
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
?>