<?php
include('db.php');

$id = $_COOKIE['mag_chosen'];
echo "cookie " . $id;



$option = $_POST["option"];  //o que foi escrito na pesquisa

$sql = "SELECT nomeRevista FROM revistaNum WHERE nomeRevista LIKE '%$option%'";

$result = $conn->query($sql);

//$contador=0;

if ($result->num_rows > 0) {
   
    //
    
    while($row = $result->fetch_assoc()) {
        //$didi[$contador] = array("nome"=>$row["nomeRevista"]);
        //$contador++;
        echo "<div> $row["nomeRevista"] </div>";
        
    }
} else {
    echo " 0 results";
}
?>