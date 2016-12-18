<?php 
include('revista.php');
session_start();

if(!empty($_SESSION['login_user']))
    $user = true;
else
    $user = false;
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

    <body class="index">
        <header>
            <a href="index.php"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
            <div id="login"> <a href="login.php">Login</a> / <a href="register.php">Register</a></div>
        </header>


        <nav>
            <ul>
                <!--<li> <a href="magazines.html"> Magazines </a></li>
        <li> <a href="index.html#subscriptions"> About </a></li>
        <li> <a href="index.html#contact"> Contact </a></li>-->
                <li> <a id="voltar" href="magazines.php"> &larr; Show all magazines </a></li>
            </ul>
        </nav>


        <!--——————————————— Revista —————————————————-->


        <section>
            <div id="left" class="column">
                <img id="imagem" class="cover" src="" alt="Adbusters">
                
                <!-- <div id="heart">
                    <input type="checkbox" id="like" />
                    <label for="like">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32c-5.15-4.67-8.55-7.75-8.55-11.53 0-3.08 2.42-5.5 5.5-5.5 1.74 0 3.41.81 4.5 2.09 1.09-1.28 2.76-2.09 4.5-2.09 3.08 0 5.5 2.42 5.5 5.5 0 3.78-3.4 6.86-8.55 11.54l-1.45 1.31z" />
                        </svg>
                    </label>
                </div> -->
            </div>

            <div id="right" class="column">
                <div id="text">
                    <p id="nome"> </p>
                    <br>
                    <p id="compra"> <span id="t-preco"> </span>€ <a id="preco" href="#"> BUY NOW </a></p>
                    <br>

                    <!-- pre serve para separar o texto em paragrafos -->
                    <pre><p id="descricao">
                    </p></pre>

                </div>
            </div>
        </section>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="js/script.js"></script>


        <script>
            var till = <?php echo json_encode($contador); ?>;
            var id = <?php echo json_encode($id); ?>;
            for (i = 0; i < till; i++)
                var palmas = <?php echo json_encode($didi); ?>;


            $('#imagem').attr('src', 'images/mags/' + id + '.jpg');
            $('#nome').text(palmas[0].nome + " #" + palmas[0].num);
            $('#t-preco').text(palmas[0].preco);
            $('#descricao').text(palmas[0].descricao);


            /*var heart = document.getElementById("heart");

            heart.onclick = function () {
                console.log('click');
                if (heart.className == "active") {
                    heart.className = "";
                } else {
                    heart.className = "active";
                }

            };*/
        </script>

    </body>

    </html>