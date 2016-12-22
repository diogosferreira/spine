<?php
include('db.php');


$id = $_COOKIE['mag_chosen'];
//echo "cookie " . $id;


$sql = "SELECT * FROM revistaNum WHERE idRevista = $id";
$result = $conn->query($sql);


$contador=0;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       // $d = $row["email"];
        //echo "nome: " . $row["nomeRevista"]. " - descricao: " . nl2br($row["descricao"]). "<br>";
        $didi[$contador] = array("nome"=>$row["nomeRevista"], "num"=>$row["numRevista"], "img"=>$row["imgRevista"], "preco"=>$row["preco"], "codBarras"=>$row["codBarras"], "descricao"=>$row["descricao"], "quant"=>$row["quantExistente"], "categoria"=>$row["categoria"]);

        $contador++;
        
        //echo " deu a " . $id;
    }
} else {
    //echo " 0 results";
}


