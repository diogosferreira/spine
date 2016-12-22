<?php
include_once("config.php");
session_start();

if(empty($_SESSION['login_user'])) 
    header('login.php');


// SELECTION MAGAZINE ADDED TO THE CART
$sessionusercart = $_SESSION['login_usercart'];

if ($sessionusercart != NULL) {
    $sql = "SELECT r.idRevista, nomeRevista, numRevista, preco, quantExistente FROM RevistaNum r JOIN Carrinho c on (r.idRevista = c.idRevista) WHERE idCarrinho = '$sessionusercart'";
    $result = $conn->query($sql);


    $contador=0;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $selected[$contador] = array("id"=>$row["idRevista"], "name"=>$row["nomeRevista"], "num"=>$row["numRevista"], "price"=>$row["preco"], "quant"=>$row["quantExistente"]);

            $contador++;
            //echo "results ";
        }
    } else {
        //echo "0 results";
    }
    
} else {
    $msg = "Why haven't you added items to the cart?";
}



?>

    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Spine </title>
        <link rel="icon" href="images/minilogo.png">

        <meta name="Spine" content="An interactive plataform to sell the coolest magazines.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../css/fonts.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/welcome.css">
        <link rel="stylesheet" href="../css/paypal.css">
    </head>

    <body>
        <div class="barraMenu">
            <header>
                <a href="../index.php"> <img src="../images/logo.png" alt="spinelogo" id="logo"> </a>
            </header>


            <nav>
                <ul id="nav-menu">
                    <li> <a href="../magazines.php"> Magazines </a></li>
                    <li> <a href="../welcome.php#profile"> Profile </a></li>
                    <li> <a href="../welcome.php#messages"> Messages </a></li>
                    <li> <a href="index%202.php"> Cart </a></li>
                </ul>

                <div id="login"> <a href="../logout.php">Logout</a></div>
            </nav>
        </div>

        <p id="warning" class="server"> Server loading.. </p>
        <p id="warning"> Couldn't connect to database, try later. </p>

        <div class="welcome">
            <h2> Cart </h2>
            <table class="table-header">
                <tr>
                    <td class="label"> Item </td>
                    <td class="price"> Price </td>
                    <td class="quant"> Quantity </td>
                    <td class="buy"> Buy </td>
                </tr>
            </table>

            <p id="none">
                <?php echo msg; ?>
            </p>


            <table id="list">
                <!-- TEST
                <tr class="line">
                    <form method="post" action="process.php?paypal=checkout">

                        <td class="label">
                            <input type="text" name="itemname" value="Frankie 73" disabled/> </td>

                        <td class="id">
                            <input type="hidden" name="itemnumber" value="20000" /> </td>

                        <td class="price">
                            <input type="text" name="itemprice" value="19.99" disabled/> </td>


                        <td class="quant">
                            <select name="itemQty">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                        
                        <td class="buy">
                            <input id="0" class="dw-button" type="submit" name="button" value="Buy" />
                        </td>

                    </form>
                </tr> -->
                
                <!-- ITEMS GO HERE -->
                
                
            </table>
        </div>


        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="../js/script.js"></script>

        <script type="text/javascript" language="javascript">
            var connfailed = <?php echo json_encode($failed); ?>;
            if(connfailed)
                $('#warning').fadeIn();
            
            var cont = <?php echo json_encode($contador); ?>;
            var items = <?php echo json_encode($selected); ?>;

            if (cont == 0)
                $('#none').css('display', 'block');
            else {
                for (i = 0; i < cont; i++) {
                    var thisid = items[i].id;
                    var thisname = items[i].name + " " + items[i].num;
                    var thisprice = items[i].price;
                    var thisquant = items[i].quant;
                    console.log("id: " + thisid);
                    console.log(thisname);
                    console.log(thisprice);

                    jQuery('<tr/>', {
                        id: 'div' + thisid,
                        class: 'line',
                    }).appendTo('#list');
                    
                    $('#div' + thisid).prepend('<form method="post" action="process.php?paypal=checkout"><div class="col label"><input type="text" name="itemname" value="'+ thisname +'" disabled/></div><div class="id"><input type="hidden" name="itemnumber" value="'+thisid+'" /></div><div class="col price"><input type="text" name="itemprice" value="'+ thisprice +'" disabled/></div><div class="col quant"><select name="itemQty"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></div><div class="col buy"><input id="0" class="dw-button" type="submit" name="button" value="Buy" /></div></form>');
                }
            }


            $('.dw-button').on("click", function () {
                $('.server').fadeIn();
                $('input').prop('disabled',false);
            });
            
        </script>

    </body>

    </html>