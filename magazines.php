<?php 
    include('categorias.php'); 
    session_start();

    if(!empty($_SESSION['login_user'])) {
        $user = true;
        $sessionusername = $_SESSION['login_user'];
    }
    else
        $user = false;




    // -- FAVORITOS

    //$sql2 = "SELECT idRevista FROM Utilizador_RevistaNum WHERE userName = '$sessionusername'";
    $sql2 = "SELECT userName, u.idRevista, imgRevista FROM RevistaNum r JOIN Utilizador_RevistaNum u on (u.idRevista = r.idRevista) WHERE userName = '$sessionusername'";
    $result2 = $conn->query($sql2);


    $contador2=0;
    if ($result2->num_rows > 0) {
        while($row2 = $result2->fetch_assoc()) {
            $didi2[$contador2] = array("id"=>$row2["idRevista"], "img"=>$row2["imgRevista"]);

            $contador2++;
        }
    } else {
        //echo "0 results";
    }



    // -- SEARCH


    $option = $_POST["option"];  //o que foi escrito na pesquisa
    $sql = "SELECT nomeRevista, idRevista, imgRevista FROM revistaNum WHERE nomeRevista LIKE '%$option%'";
    $result = $conn->query($sql);
    $contador=0;

    if ($result->num_rows > 0  ) {
        while($row = $result->fetch_assoc()) {
            $pesquisa[$contador] = array("nome"=>$row["nomeRevista"], "id"=>$row["idRevista"], "img"=>$row["imgRevista"]);
            $contador++; 
            //echo "<div class=" . "posts" . ">" . $row["nomeRevista"] . "</div>";  
        }
    } else {
        $no = "No products were found matching your selection.";
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

        <link rel="stylesheet" href="css/fonts.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/magazines.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>

    <body class="index">


        <!--barra de menu  ———————————————————————————————-->

        <div class="barraMenu">
            <header>
                <a href="index.php"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
                <a href="paypal/index%202.php"> <img src="images/cart.png" alt="cart" id="cart"> </a>
            </header>


            <nav>
                <ul id="nav-menu">
                    <li> <a href="magazines.php"> Magazines </a></li>
                    <li> <a href="about.php"> About </a></li>
                    <li> <a href="contacts.php"> Contact </a></li>
                </ul>


                <br>

                <div id="login"> <a href="login.php">Login</a> / <a href="register.php">Register</a></div>


                <div id="dropdown-list">
                    <div class="dropdown closed">
                        <div class="title">Pick Category</div>

                        <div class="piro">
                            <div class="dropdown-menu">
                                <ul id="list">
                                    <li id="all">All</li>
                                    <li id="favourites">Favourites</li>
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


                <!--filtros

                <select>
                    <option value="data">Data</option>
                    <option value="artigos">Artigos</option>
                    <option value="nome">Nome</option>
                </select>

                <!--filtros-->

                <form class="pesquisa" method="post">
                    <i class="material-icons md-30">search</i>
                    <input class="inputtext" type="text" autocomplete="off" name="option" placeholder="Search Products " />
                    <br>

                    <span id="spanSearch"><p id="enter"> Press <u>enter</u> to search.</p></span>
                    <!--<input class="btn" type="submit" value="Search" />-->

                </form>
            </nav>
        </div>

        <p id="warning"> Couldn't connect to database, try later. </p>

        <section id="postPage">
            
        <p id="msg"> <?php echo $no;?> </p>
            <div id="posts">
                <!--  cria as divs aqui   -->
            </div>


            <div id="infoEcistencia"></div>
        </section>


        <div id="left" class="column"></div>


        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript" language="javascript">
            var connfailed = <?php echo json_encode($failed); ?>;
            if (connfailed)
                $('#warning').fadeIn();            
            
            
            var user = <?php echo json_encode($user); ?>;
            if (user) {
                $('#login').html('<a href="welcome.php">Profile</a> / <a href="logout.php">Logout</a>');
                console.log(user);
                $('#favourites').css("display", "block");
            } else
                $('#favourites').css("display", "none");




            /* ———————————————————  search magazines  ————————————————————————— */

            for (i = 0; i < 8; i++) {
                var resultadoPesquisa = <?php echo json_encode($pesquisa); ?>;
                //var procura = resultadoPesquisa[i].id;
                $("div").remove(".post");
            }

            var tamanho = resultadoPesquisa.length;
            //console.log("tamanho  " + tamanho);


            $(".post").remove();

            for (i = 0; i < tamanho; i++) {
                console.log("top  " + resultadoPesquisa[i].id);

                var procura = resultadoPesquisa[i].id;
                var img = resultadoPesquisa[i].img;


                jQuery('<div/>', {
                    id: '' + procura,
                    class: 'post',
                    //text: 'div bem criada' + i
                }).appendTo('#posts');
                $('#' + procura).prepend("<a href='baseRevista.php'> <img src='images/mags/" + img + "'> </a>");


            }



            //  mostrar todas as revistas
            var palmas = <?php echo json_encode($didi); ?>;
            var cont1 = <?php echo json_encode($contador); ?>;

            function showAll() {
                for (i = 0; i < cont1; i++) {
                    var id = palmas[i].id;
                    var img = palmas[i].img;
                    jQuery('<div/>', {
                        id: '' + id,
                        class: 'post',
                        // text: 'div bem criada' + i
                    }).appendTo('#posts'); //id/class so sitio

                    //$('#div' + i).prepend("<a href='revistasCodbarras/" + codBarras + ".html'> <img src='imagesCodbarras/" + codBarras + ".jpg'> </a>");

                    $('#' + id).prepend("<a href='baseRevista.php'> <img src='images/mags/" + img + "'> </a>");
                }
            }


            /* ———————————————————  search magazines FIM  —————————————————————————— */




            /* ———————————————————  Mostrar categorias   —————————————————————————— */

            $("#list li").on("click", function () {
                $(".post").remove();

                for (i = 0; i < 8; i++) {
                    var palmas2 = <?php echo json_encode($didi2); ?>;
                    var cont2 = <?php echo json_encode($contador2); ?>;
                }

                var divNome = $(this).attr('id');

                $("div").remove(".post");
                if (divNome === 'all') {
                    showAll();
                } else if (divNome === 'favourites') {
                    var andaLaSenaoApanhas1 = 0;


                    for (i = 0; i < cont2; i++) {

                        var img = palmas2[i].img;
                        console.log("img: " + img);
                        var id = palmas2[i].id;
                        console.log("id: " + id);
                        jQuery('<div/>', {
                            id: '' + id,
                            class: 'post',
                            // text: 'div bem criada' + i
                        }).appendTo('#posts'); //id/class so sitio

                        $('#' + id).prepend("<a href='baseRevista.php'> <img src='images/mags/" + img + "'> </a>");

                        andaLaSenaoApanhas1++;
                        /*if(palmas2.length){
                        $('#posts').prepend("<p> Não Existem revistas desta categoria. </p>");  
                        }*/
                    }

                    if (andaLaSenaoApanhas1 == 0) {
                        $("#infoEcistencia").empty();
                        console.log("passa");
                        $('#infoEcistencia').prepend("<p> Ainda não tem favoritos. </p>");
                    }
                } else {


                    var andaLaSenaoApanhas = 0;


                    for (i = 0; i < cont1; i++) {


                        var id = palmas[i].id;
                        var img = palmas[i].img;

                        if (divNome === palmas[i].categoria) {
                            jQuery('<div/>', {
                                id: '' + id,
                                class: 'post',
                                // text: 'div bem criada' + i
                            }).appendTo('#posts'); //id/class so sitio

                            // meter id e imagem em variável
                            $('#' + id).prepend("<a href='baseRevista.php'> <img src='images/mags/" + img + "'> </a>");

                            andaLaSenaoApanhas++;

                        }
                        if (andaLaSenaoApanhas == 0) {
                            $("#infoEcistencia").empty();
                            $('#infoEcistencia').prepend("<p> Ainda não existem revistas nesta categoria </p>");
                        }

                    }

                }
            });

            /* ———————————————————  Mostrar categorias FIM —————————————————————— */



            //  -- p da pesquisa  PRESS ENTER TO SEARCH

            $("#enter").hide();

            $(".inputtext").on("click", function () {
                $("#enter").fadeIn("slow");
            });

            $("#postPage").on("click", function () {
                $("#enter").fadeOut("slow");
            });

            //  -- p da pesquisa  PRESS ENTER TO SEARCH
        </script>


    </body>
    <script src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    </html>