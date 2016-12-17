<?php
include('db.php');


$sql = "SELECT categoria, idRevista FROM revistaNum";
$result = $conn->query($sql);


$contador=0;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       // $d = $row["email"];
        //echo "nome: " . $row["email"]. " - pass: " . $row["userPassword"]. "<br>";
        $didi[$contador] = array("categoria"=>$row["categoria"], "id"=>$row["idRevista"]);

        $contador++;
    }
} else {
    echo "0 results";
}


?>
