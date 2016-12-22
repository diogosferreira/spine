<?php 
include('revista.php');
session_start();

if(!empty($_SESSION['login_user'])) {
    $user = true;
    $sessionusername = $_SESSION['login_username'];
    $sessionusertype = $_SESSION['login_usertype'];
    $sessionusercart = $_SESSION['login_usercart'];
} else
    $user = false;




// SELECTION TO CHECK IF IT IS ALREADY A FAVOURITE
$sql0 = "SELECT * FROM `Utilizador_RevistaNum` WHERE (`userName`='$sessionusername' and `idRevista` = '$id')";
$result0 = $conn->query($sql0);


if ($result0->num_rows > 0) {
    $favourite = true;
} else {
    $favourite = false;
}




// SELECTION TO CHECK IF HAS BEEN ALREADY ADDED TO THE CART
if ($sessionusercart != NULL) {
    $query0 = "SELECT * FROM `Carrinho` WHERE (`idCarrinho` ='$sessionusercart' and `idRevista`='$id')";
    $endresult0 = $conn->query($query0);


    if ($endresult0->num_rows > 0) {
        $added = true;
    } else {
        $added = false;
    }
}

        
        
        
        
if($_SERVER["REQUEST_METHOD"] == "POST") {
if($_REQUEST['btn-submit']=="Submit") {
    if (isset($_POST['like'])) {
        $query1 = "INSERT INTO `Utilizador_RevistaNum` (`userName`, `idRevista`) VALUES ('$sessionusername', '$id')";
        $endresult1 = mysqli_query($conn, $query1);
        if($endresult1){
            $msg = "Added to favourites";
        }else{
            $msg ="Sorry, action Failed.";
        }
        
    } else {
        $query2 = "DELETE FROM `Utilizador_RevistaNum` WHERE `idRevista`='$id'";
        $endresult2 = mysqli_query($conn, $query2);
        if($endresult2){
            $msg = "Deleted from favourites";
        }else{
            $msg ="Sorry, action Failed.";
        } 
    }
    
} else if($_REQUEST['btn-submit']=="Buy") {
    if (isset($_POST['buy']) && ($added==false)) {
        $query3 = "INSERT INTO `Carrinho` (`idCarrinho`, `idRevista`) VALUES ('$sessionusercart', '$id')";
        $endresult3 = mysqli_query($conn, $query3);
        if($endresult3){
            $msg = "Added to favourites";
        }else{
            $msg ="Sorry, action Failed.";
        }
        
    } else if ($added==true){
        $query4 = "DELETE FROM `Carrinho` WHERE (`idCarrinho` ='$sessionusercart' and `idRevista`='$id')";
        $endresult4 = mysqli_query($conn, $query4);
        if($endresult4){
            $msg = "Deleted from favourites";
        }else{
            $msg ="Sorry, action Failed.";
        } 
    }    
}
    echo"<script language='javascript'> window.location.href = 'baseRevista.php'; </script> ";

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
    </head>

    <body>
        <div class="barraMenu">
            <header>
                <a href="index.php"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
                <a href="paypal/index%202.php"> <img src="images/cart.png" alt="cart" id="cart"> </a>
            </header>


            <nav>
                <ul id="nav-menu">
                    <li> <a id="voltar" href="magazines.php"> &larr; Show all magazines </a></li>
                </ul>


                <div id="login"> <a href="login.php">Login</a> / <a href="register.php">Register</a></div>
            </nav>
        </div>
        
        <p id="warning"> Couldn't connect to database, try later. </p>

        <!--——————————————— Revista —————————————————-->


        <section>
            <div id="left" class="column">
                <img id="imagem" class="cover" src="" alt="Adbusters">
            </div>

            <div id="right" class="column">
                <div id="text">
                    <p id="nome"> </p>
                    <div id="heart">
                        <form action="" method="post">
                            <input type="checkbox" id="like" name="like" />
                            <label for="like">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32c-5.15-4.67-8.55-7.75-8.55-11.53 0-3.08 2.42-5.5 5.5-5.5 1.74 0 3.41.81 4.5 2.09 1.09-1.28 2.76-2.09 4.5-2.09 3.08 0 5.5 2.42 5.5 5.5 0 3.78-3.4 6.86-8.55 11.54l-1.45 1.31z" />
                                </svg>
                            </label>
                            <input type="submit" name="btn-submit" id="submit" value="Submit" style="display:none;">
                        </form>
                    </div>
                    <br>
                    <form action="" method="post">
                        <p id="compra">
                            <span id="t-preco"> </span>€
                            <a id="preco"> ADD TO CART </a>
                            <input type="checkbox" id="buy" name="buy" />
                            <input type="submit" name="btn-submit" id="submit-buy" value="Buy" style="display:none;">
                        </p>
                    </form>

                    <br>

                    <!-- pre serve para separar o texto em paragrafos -->
                    <pre><p id="descricao">
                    </p></pre>

                </div>
            </div>
        </section>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="js/script.js"></script>
        <script type="text/javascript" language="javascript">
            var connfailed = <?php echo json_encode($failed); ?>;
            if(connfailed)
                $('#warning').fadeIn();
            
            
            
            var user = <?php echo json_encode($user); ?>;
            var username = <?php echo json_encode($sessionusername); ?>;
            var usertype = <?php echo json_encode($sessionusertype); ?>;
            var usercart = <?php echo json_encode($sessionusercart); ?>;
            console.log("user: " + user);
            console.log("userr: " + username);
            console.log("userrr: " + usertype);
            console.log("userrrrrrr: " + usercart);
            if (user) {
                $('#login').html('<a href="welcome.php">Profile</a> / <a href="logout.php">Logout</a>');
                $('#cart').css('display','block');
                console.log(user);

                if (usertype == 0)
                    $('#heart').css("display", "block");
                else
                    $('#heart').css("display", "none");
            } else
                $('#heart').css("display", "none");


            var till = <?php echo json_encode($contador); ?>;
            for (i = 0; i < till; i++)
                var palmas = <?php echo json_encode($didi); ?>;


            $('#imagem').attr('src', 'images/mags/' + palmas[0].img);
            $('#nome').text(palmas[0].nome + " #" + palmas[0].num);
            $('#t-preco').text(palmas[0].preco);
            $('#descricao').text(palmas[0].descricao);
                console.log(<?php echo json_encode($id); ?>);


            //----- FAVOURITE -----

            //check if it is favourite
            var favourite = <?php echo json_encode($favourite); ?>;
                console.log("favourite "+favourite);
            if (favourite)
                $('svg').addClass('active');



            //add or remove favourite
            $('svg').on("click", function () {
                console.log('rumor');
                $(this).toggleClass('active');

                if ($(this).hasClass('active')) {
                    console.log('has it');
                    $('#like').attr('checked', true);
                } else {
                    console.log('dont has it');
                    $('#like').attr('checked', false);
                }
                document.getElementById('submit').click();
            });




            //----- ADDED TO CART -----

            //check if already added
            var added = <?php echo json_encode($added); ?>;
                    console.log('added '+added);

            if (added)
                $('#preco').text('REMOVE FROM CART');
            else
                $('#preco').text('ADD TO CART');



            $('#preco').on("click", function () {
                console.log('rumor');
                $(this).toggleClass('remove');

                if ($(this).hasClass('remove')) {
                    console.log('has it');
                    $('#buy').attr('checked', true);
                } else {
                    console.log('dont has it');
                    $('#buy').attr('checked', false);
                }
                document.getElementById('submit-buy').click();
            });
        </script>

    </body>

    </html>