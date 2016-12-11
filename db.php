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
 

$sql = "SELECT * FROM Utilizador";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       // $d = $row["email"];
        //echo "nome: " . $row["email"]. " - pass: " . $row["userPassword"]. "<br>";
        $didi[$contador] = array("Id"=>$row["email"],"Name"=>$row["userPassword"]);
            
            $contador++;
    }
} else {
    echo "0 results"; 
}


?>