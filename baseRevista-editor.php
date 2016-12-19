<?php 
include('revista.php');
session_start();

$id = $_COOKIE['mag_chosen'];

    $_SESSION['welcomeowner-msg0'] = '';
    $_SESSION['welcomeowner-msg1'] = '';
    $_SESSION['welcomeowner-msg2'] = '';


if($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_REQUEST['btn-submit']=="Save Magazine") {
            if(!empty($_POST['name']) && !empty($_POST['issue'])) {
                $newname = $_POST['name'];
                $newissue = $_POST['issue'];
                
                //check if the mag name and issue already exists
                $sql = "SELECT * FROM RevistaNum WHERE (nomeRevista = '$newname' and numRevista = '$newissue') and idRevista!='$id'";
                $result = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($result);

                if($count != 0) 
                    $msg1 = 'Sorry, the issue for this magazine already exists.';
                else
                    $changenameissue = "UPDATE RevistaNum SET nomeRevista = '$newname'". ", numRevista = '$newissue'"."WHERE idRevista='$id'";
                
                if ($conn->query($changenameissue) === TRUE) 
                    $m = 1;
                
            } else  {
                if(!empty($_POST['name'])) {
                    $newname = $_POST['name'];
                    $changename = "UPDATE RevistaNum SET nomeRevista = '$newname' WHERE idRevista='$id'"; 
                    
                    if ($conn->query($changename) === TRUE) 
                        $m = 1;
                }
                if(!empty($_POST['issue'])){
                    $newissue = $_POST['issue'];
                    $changeissue = "UPDATE RevistaNum SET numRevista = '$newissue' WHERE idRevista='$id'"; 
                    
                    if ($conn->query($changeissue) === TRUE) 
                        $m = 1;
                }
            }
            if(!empty($_POST['barcode'])){
                $newbarcode = $_POST['barcode'];
                
                //check if the barcode already exists
                $sql2 = "SELECT codBarras FROM RevistaNum WHERE (codBarras = '$newbarcode' and idRevista!='$id')";
                $result2 = mysqli_query($conn,$sql2);
                $count2 = mysqli_num_rows($result2);

                
                if($count2 != 0) 
                    $msg2 = 'Sorry, the barcode already exists.';
                else                
                    $changebarcode = "UPDATE RevistaNum SET codBarras = '$newbarcode' WHERE idRevista='$id'";  
                
                if ($conn->query($changebarcode) === TRUE) 
                    $m = 1;
            }
            if(!empty($_POST['price'])) {
                $newprice = $_POST['price'];
                $changeprice = "UPDATE RevistaNum SET preco = '$newprice' WHERE idRevista='$id'"; 
                
                if ($conn->query($changeprice) === TRUE) 
                    $m = 1;
            }
            if(!empty($_POST['category'])){
                $newcategory = $_POST['category'];
                $changecategory = "UPDATE RevistaNum SET categoria = '$newcategory' WHERE idRevista='$id'";  
                
                if ($conn->query($changecategory) === TRUE) 
                    $m = 1;
            }
            if(!empty($_POST['quantity'])){
                $newquantity = $_POST['quantity'];
                $changequantity = "UPDATE RevistaNum SET quantExistente = '$newquantity' WHERE idRevista='$id'"; 
                
                if ($conn->query($changequantity) === TRUE) 
                    $m = 1;
            }
            if(!empty($_POST['description'])){
                $newdescription = $_POST['description'];
                $changedescription = "UPDATE RevistaNum SET descricao = '$newdescription' WHERE idRevista='$id'"; 
                
                if ($conn->query($changedescription) === TRUE) 
                    $m = 1;
            }
        

            
            if($m == 1)
                $msg = "Magazine saved successfully!";
            else {
                if($msg1 != null)
                    $msg = $msg1;
                else if ($msg2 != null)
                    $msg = $msg2;
                else
                    $msg ="Sorry, the magazine couldn't be saved.";
            }
        
        
    } else  if($_REQUEST['btn-submit']=="Delete Magazine") {
        $query2 = "DELETE FROM `RevistaNum` WHERE `idRevista`='$id'";
        $endresult2 = mysqli_query($conn, $query2);
        if($endresult2){
            $msg = "Magazine deleted successfully!";
            header('magazines-editor.php');

        }else{
            $msg ="Sorry, the magazine couldn't be deleted.";
        } 
    }
}
    
?>

    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Spine </title>
        <link rel="icon" href="../images/minilogo.png">

        <meta name="Spine" content="An interactive plataform to sell the coolest magazines.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="css/fonts.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/revistaindividual.css">
        <link rel="stylesheet" href="css/welcome.css">
    </head>

    <body class="index">
        <header>
            <a href="#"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
            <div id="login"> <a href="logout.php"> Logout </a> </div>
        </header>


        <nav>
            <ul>
                <li> <a id="voltar" href="magazines-editor.php"> &larr; Show all magazines </a></li>
                <br>
                <li> <a href="welcomeowner.php#profile"> Profile </a></li>
                <li> <a href="welcomeowner.php#add-editor"> Add Editor </a></li>
                <li> <a href="welcomeowner.php#add-mag"> Add Mag </a></li>
                <li> <a href="#"> Edit Mag </a></li>
            </ul>
        </nav>



        <div class="welcome" id="add-mag">
            <h2> Edit Magazine </h2>
            <div id="info">
                <form action="" method="post">
                    <div class="line">
                        <label for="name"> Name </label>
                        <input type="text" name="name" id="name" placeholder="">
                    </div>
                    <div class="line">
                        <label for="issue"> Issue </label>
                        <input type="text" name="issue" id="issue" placeholder="">
                    </div>
                    <div class="line">
                        <label for="barcode"> Bar Code </label>
                        <input type="text" name="barcode" id="barcode" placeholder="">
                    </div>
                    <div class="line">
                        <label for="price"> Price </label>
                        <input type="text" name="price" id="price" placeholder="">
                    </div>
                    <div class="line extra-line">
                        <label for="category"> Category </label>
                        <input id="category-chosen" type="text" name="category" style="display:none;">

                        <div id="dropdown-list">
                            <div class="dropdown closed">
                                <div class="title">Pick Category</div>

                                <div class="dropdown-menu">
                                    <ul id="list">
                                        <li id="design">Design</li>
                                        <li id="social">Social</li>
                                        <li id="illustration">Illustration</li>
                                        <li id="architecture">Architecture</li>
                                        <li id="technology">Technology</li>
                                        <li id="other">Other</li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="line">
                        <label for="quantity"> Quantity </label>
                        <input type="text" name="quantity" id="quantity" placeholder="">
                    </div>
                    <div class="line">
                        <label for="description"> Description </label>
                        <textarea type="text" name="description" id="description" placeholder=""></textarea>
                    </div>
                    <div class="button add-button" id="btn-edit-mag">
                        <input type="submit" name="btn-submit" value="Save Magazine">
                    </div>
                    <div class="button add-button" id="btn-del-mag">
                        <input type="submit" name="btn-submit" value="Delete Magazine">
                    </div>
                </form>
            </div>
            <p class="answer">
                <?php echo $msg; ?>
            </p>
        </div>

        <br>
        <br>
        <br>
        <br>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="js/script.js"></script>


        <script>
            var till = <?php echo json_encode($contador); ?>;
            var id = <?php echo json_encode($id); ?>;
            for (i = 0; i < till; i++)
                var palmas = <?php echo json_encode($didi); ?>;


            //$('#imagem').attr('src', 'images/mags/' + id + '.jpg');
            $('#name').attr('placeholder', palmas[0].nome);
            $('#issue').attr('placeholder', palmas[0].num);
            $('#barcode').attr('placeholder', palmas[0].codBarras);
            $('#price').attr('placeholder', palmas[0].preco);
            $('#list li').each(function () {
                if ($(this).attr('id') == palmas[0].categoria)
                    $('.title').text($(this).attr('id'));
            });
            //$('#').attr('placeholder', palmas[0].categoria);
            $('#quantity').attr('placeholder', palmas[0].quant);
            $('#description').attr('placeholder', palmas[0].descricao);
        </script>

    </body>

    </html>