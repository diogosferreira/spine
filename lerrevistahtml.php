<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Spine </title>
    <link rel="icon" href="images/minilogo.png">

    <meta name="Spine" content="An interactive plataform to sell the coolest magazines.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="index">
    <header>
        <a href="index.php"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
        <div id="login"> <a href="login.php">Login</a> / <a href="register.php">Register</a></div>
    </header>

    <p class="dbresult"></p>
    <p class="codbarras"></p>
    <p id="demo"></p>

    <!--imagem posta pelo javascript-->
    <div class="img"></div>

    <nav>
        <ul>
            <li> <a href="magazines.html"> Magazines </a></li>
            <li> <a href="about.html"> About </a></li>
            <li> <a href="contacts.html"> Contact </a></li>
        </ul>
    </nav>

    <section id="firstPage" class="fullPage"></section>



    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="js/script.js"></script>

    <?php include('lerrevista.php'); ?>

        <script type="text/javascript" language="javascript">
            for (i = 0; i < 8; i++) {
                var palmas = <?php echo json_encode($didi); ?>;
                $('.dbresult').text("idrevista: " + palmas[i].categoria);

            }


            //————— mostrar nos p´s

            $('.dbresult').text("idrevista: " + palmas[0].categoria);

            $('.codbarras').text("codbarras: " + palmas[0].codBarras);



            //————— mostrar imagem na div
            
            var nomeImg = palmas[0].codBarras;

            var nome = "images/" + nomeImg + ".jpg";
            $('<img src= ' + nome + '>').appendTo(".img");


            for (i = 0; i < 8; i++) {

                //comparar strings 
                //0 é igual -1 ou 1 diferente

                console.log("vai te a ele");
                var str1 = "social";
                var str2 = palmas[i].categoria;
                var n = str1.localeCompare(str2);
                //console.log(n);
                // document.getElementById("demo").innerHTML = n;


                if (n === 0) {
                    $('#demo').append("id= " + i + " é " + palmas[i].categoria + " // ");
                } else {
                    //$('#demo').text("not design");
                }
            }
        </script>
</body>


</html>