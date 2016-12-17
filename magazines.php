<?php 
include('categorias.php'); 
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
        <link rel="icon" href="images/minilogo.png">

        <meta name="Spine" content="An interactive plataform to sell the coolest magazines.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="css/fonts.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/magazines.css">
    </head>

    <body class="index">
        <header>
            <a href="index.php"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
            <div id="login"> <a href="login.php">Login</a> / <a href="register.php">Register</a></div>
        </header>


        <nav>
            <ul>
                <li> <a href="magazines.php"> Magazines </a></li>
                <li> <a href="about.php"> About </a></li>
                <li> <a href="contacts.php"> Contact </a></li>
            </ul>

            <br>

            <div id="dropdown-list">
                <div class="dropdown closed">
                    <div class="title">Pick Category</div>

                    <div class="dropdown-menu">
                        <ul id="list">
                            <li id="all">All</li>
                            <li id="design">Design</li>
                            <li id="social">Social</li>
                            <li id="illustration">Illustration</li>
                        </ul>
                    </div>

                </div>
            </div>
        </nav>



        <section id="postPage">
            <div id="posts">
                <!--  cria as divs aqui   -->

            </div>

        </section>




        <div id="left" class="column">

        </div>


        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>


        <script type="text/javascript" language="javascript">
            var testeaula = $('#posts').text();
            var user = <?php echo json_encode($user); ?>;
            if (user)
                $('#login').html('<a href="welcome.php">Profile</a> / <a href="logout.php">Logout</a>');
            console.log(user);


            for (i = 0; i < 8; i++) {
                var palmas = <?php echo json_encode($didi); ?>;
                //console.log("i é: " +palmas[i].categoria);
            }
            showAll();
            //ver qual a categoria selecionada


            $("#list li").on("click", function () {
                var divNome = $(this).attr('id');


                if (divNome === 'all') {
                    showAll();
                } else {
                    for (i = 0; i < 8; i++) {
                        var id = palmas[i].id;

                        if (divNome === palmas[i].categoria) {
                            jQuery('<div/>', {
                                id: '' + id,
                                class: 'post',
                                // text: 'div bem criada' + i
                            }).appendTo('#posts'); //id/class so sitio

                            // meter id e imagem em variável

                            $('#' + id).prepend("<a href='baseRevista.php'> <img src='images/mags/" + id + ".jpg'> </a>");

                        }
                    }
                }
            });



            //mostrar todas as revistas
            function showAll() {
                for (i = 0; i < 8; i++) {
                    var id = palmas[i].id;
                    jQuery('<div/>', {
                        id: '' + id,
                        class: 'post',
                        // text: 'div bem criada' + i
                    }).appendTo('#posts'); //id/class so sitio

                    //$('#div' + i).prepend("<a href='revistasCodbarras/" + codBarras + ".html'> <img src='imagesCodbarras/" + codBarras + ".jpg'> </a>");

                   $('#' + id).prepend("<a href='baseRevista.php'> <img src='images/mags/" + id + ".jpg'> </a>");
                }
            }

        </script>


    </body>
    <script src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    </html>