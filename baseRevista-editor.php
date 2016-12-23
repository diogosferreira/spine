<?php 
include('revista.php');
session_start();

$id = $_COOKIE['mag_chosen'];

    $_SESSION['welcomeowner-msg0'] = '';
    $_SESSION['welcomeowner-msg1'] = '';
    $_SESSION['welcomeowner-msg2'] = '';


if($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_REQUEST['btn-submit']=="Save Magazine") {
        $counter =0;
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
                    $m[$counter] = 1;
                else
                    $m[$counter] = 0;
                $counter++;
                
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
                    $m[$counter] = 1;
                else
                    $m[$counter] = 0;
                $counter++;
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
                    $m[$counter] = 1;
                else
                    $m[$counter] = 0;
                $counter++;
            }
            if(!empty($_POST['price'])) {
                $newprice = $_POST['price'];
                $changeprice = "UPDATE RevistaNum SET preco = '$newprice' WHERE idRevista='$id'"; 
                
                if ($conn->query($changeprice) === TRUE) 
                    $m[$counter] = 1;
                else
                    $m[$counter] = 0;
                $counter++;
            }
            if(!empty($_POST['category'])){
                $newcategory = $_POST['category'];
                $changecategory = "UPDATE RevistaNum SET categoria = '$newcategory' WHERE idRevista='$id'";  
                
                if ($conn->query($changecategory) === TRUE) 
                    $m[$counter] = 1;
                else
                    $m[$counter] = 0;
                $counter++;
            }
            if(!empty($_POST['quantity'])){
                $newquantity = $_POST['quantity'];
                $changequantity = "UPDATE RevistaNum SET quantExistente = '$newquantity' WHERE idRevista='$id'"; 
                
                if ($conn->query($changequantity) === TRUE) 
                    $m[$counter] = 1;
                else
                    $m[$counter] = 0;
                $counter++;
            }
            if(!empty($_POST['description'])){
                $newdescription = $_POST['description'];
                $changedescription = "UPDATE RevistaNum SET descricao = '$newdescription' WHERE idRevista='$id'"; 
                
                if ($conn->query($changedescription) === TRUE) 
                    $m[$counter] = 1;
                else
                    $m[$counter] = 0;
                $counter++;
            }
          
            if(!empty($_POST['year'])){
                $newyear = $_POST['year'];
                $changeyear = "UPDATE RevistaNum SET ano = '$newyear' WHERE idRevista='$id'"; 
                
                if ($conn->query($changeyear) === TRUE) 
                    $m[$counter] = 1;
                else
                    $m[$counter] = 0;
                $counter++;
            }
          
        
            if(!($_FILES['magimage']['size'] == 0)){
              $errors= array();
              $file_size = $_FILES['magimage']['size'];
              $file_tmp = $_FILES['magimage']['tmp_name'];
              $file_type = $_FILES['magimage']['type'];
              $file_ext=strtolower(end(explode('.',$_FILES['magimage']['name'])));

              $expensions= array("jpeg","jpg","png");

              if(in_array($file_ext,$expensions)=== false){
                 $errors[]="Extension not allowed, please choose a JPEG or PNG file. ";
                 $m01 ="Extension not allowed, please choose a JPEG or PNG file. ";
              }

              if($file_size > 2097152) {
                 $errors[]='File size must be inferior to 2 MB. ';
                 $m02 ='File size must be inferior to 2 MB. ';
              }
                
              if(empty($errors)==false) {
                $msg3 = 'Sorry, could not upload image. ' . $m01 . $m02;
            }
            }

                if($msg1 != null)
                    $msg = $msg1;
                else if ($msg2 != null)
                    $msg = $msg2;
                else if ($msg3 != null)
                    $msg = $msg3;
                else {
                    for($i=0; $i<$m.length; $i++){
                        if($m[$i]==false)
                            $error=1;
                    }
                }
                
                if(!empty($error))
                    $msg ="Sorry, error ocurred. Some of your data might not have been saved.";
                else
                    $msg = "Magazine saved successfully!";
        
    echo"<script language='javascript'> window.location.href = 'baseRevista-editor.php'; </script> ";
            
        
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

    <body >
        <div class="barraMenu">
            <header>
                <a href="index.php"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
            </header>


            <nav>
                <ul id="nav-menu">
                    <li> <a href="magazines.php"> Magazines </a></li>
                    <li> <a href="welcomeowner.php#profile"> Profile </a></li>
                    <li> <a href="welcomeowner.php#add-editor"> Add Editor </a></li>
                    <li> <a href="welcomeowner.php#add-mag"> Add Mag </a></li>
                    <li> <a href="magazines-editor.php"> Edit Mag </a></li>
                </ul>

                <div id="login"> <a href="logout.php">Logout</a></div>
            </nav>
        </div>

        <p id="warning"> Couldn't connect to database, try later. </p>

        
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
                    <div class="line">
                        <label for="year"> Year </label>
                        <input type="text" name="year" id="year" placeholder=""></input>
                    </div>
                    <div class="line">
                        <label for="image"> Image </label>
                        <input id="mag-pic" onclick="document.getElementById('mag-pic-button').click();" placeholder="Choose Image" />
                        <input onchange="pressed()" style="display:none;" id="mag-pic-button" type="file" name="magimage" accept=".jpg, .jpeg, .png" />
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
            var connfailed = <?php echo json_encode($failed); ?>;
            if(connfailed)
                $('#warning').fadeIn();
            
            
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
            $('#year').attr('placeholder', palmas[0].ano);
            $('#mag-pic').attr('placeholder', palmas[0].img);
            
            
            
            //-- MAGAZINES --

            function pressed() {
                var a = document.getElementById('mag-pic-button');
                if (a.value == "")
                    $("#mag-pic").attr("placeholder", "Choose Image");
                else {
                    var theSplit = a.value.split('\\');
                    var theSplitofSplits = theSplit[theSplit.length - 1];
                    $("#mag-pic").attr("placeholder", theSplitofSplits);
                }
            };
        </script>

    </body>

    </html>