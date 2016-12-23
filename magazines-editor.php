<?php 

/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/

    include('db.php');
    session_start();

    if(!empty($_SESSION['login_user'])) {
        $user = true;
        $sessionusername = $_SESSION['login_user'];
    }
    else
        $user = false;



    // -- TODOS

    $sql = "SELECT categoria, idRevista, imgRevista FROM revistaNum";
    $result = $conn->query($sql);


    $contador=0;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
           // $d = $row["email"];
            //echo "nome: " . $row["email"]. " - pass: " . $row["userPassword"]. "<br>";
            $didi[$contador] = array("categoria"=>$row["categoria"], "id"=>$row["idRevista"], "img"=>$row["imgRevista"]);

            $contador++;
        }
    } else {
        //echo "0 results";
    }


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
        $nofav = "No products were found matching your selection.";
    }



    // -- SEARCH

   


    $option = $_POST["option"];  //o que foi escrito na pesquisa
    $date = $_POST["date"];
    
    $filtro="";
    if ($option!=""){
        $filtro = "(nomeRevista LIKE '%$option%' OR descricao LIKE '%$option%')";
    }

    if ($date !=''){
        if ($option!=''){
             $filtro = "$filtro AND ";
        }
       $filtro = "$filtro ano = $date";
    }
     if ($filtro=="") {$filtro="1=1";}
  
    $sql3 = "SELECT nomeRevista, idRevista, imgRevista, ano, descricao FROM revistaNum WHERE $filtro";
    //$sql3=$sql3+$filtro;

    /*$sql3 = "SELECT nomeRevista, idRevista, imgRevista, ano FROM revistaNum WHERE nomeRevista LIKE '%$option%' and ano LIKE '%$name%'";*/
    
    $result3 = $conn->query($sql3);
    $contador3=0;

    if ($result3->num_rows > 0  ) {
        while($row3 = $result3->fetch_assoc()) {
            $pesquisa[$contador3] = array("nome"=>$row3["nomeRevista"], "id"=>$row3["idRevista"], "img"=>$row3["imgRevista"]);
            $contador3++; 
            //echo "<div class=" . "posts" . ">" . $row["nomeRevista"] . "</div>";  
        }
    } else {
        $nosearch = "No products were found matching your selection.";
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




        <!--filtros-->

        <!-- <select name="taskOption">
            <option value="data">Data</option>
            <option value="descricao">Descrição</option>
        </select>

 
        -->
        <!--
                <form class="pesquisa" method="post">
                    <i class="material-icons md-30">search</i>
                    <input class="inputtext" type="text" autocomplete="off" name="date" placeholder="Date" />
                </form>
        -->


        <!--filtros-->




        <!--barra de menu  ———————————————————————————————-->

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





                <form class="pesquisa" method="post">

                    <div id="nomedesc">

                        <i class="material-icons md-30">search</i>
                        <input class="inputtext" type="text" autocomplete="off" name="option" placeholder="Search Products " />

                        <span id="spanSearch"><p id="enter"> Press <u>enter</u> to search.</p></span>
                    </div>

                    <br>
                    <br>
                    <br>


                    <div id="data">
                        <input id="datain" class="inputtext" type="text" autocomplete="off" name="date" placeholder="Search Date" maxlength="4" />
                        <i class="material-icons md-30">search</i>

                    </div>
                    <span id="spanSearch"><p id="enter1"> Press <u>enter</u> to search.</p></span>
                    <br>

                    <p id="tutorial"> You can searh products by name, description, date, and also combine both.</p>

                    <input class="btn" type="submit" value="Search" style="display:none;" />
                </form>







            </nav>
        </div>

        <p id="warning"> Couldn't connect to database, try later. </p>

        <section id="postPage">

            <p id="msg"> </p>
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
                $('#login').html('<a href="welcomeowner.php">Profile</a> / <a href="logout.php">Logout</a>');
                console.log(user);
                $('#favourites').css("display", "block");
            } else
                $('#favourites').css("display", "none");



            //  variables from php
            var palmas = <?php echo json_encode($didi); ?>;
            var cont1 = <?php echo json_encode($contador); ?>;
            var palmas2 = <?php echo json_encode($didi2); ?>;
            var cont2 = <?php echo json_encode($contador2); ?>;
            var no2 = <?php echo json_encode($nofav); ?>;
            var resultadoPesquisa = <?php echo json_encode($pesquisa); ?>;
            var option = <?php echo json_encode($option); ?>;
            var no3 = <?php echo json_encode($nosearch); ?>;



            //  mostrar todas as revistas
            function showAll() {
                for (i = 0; i < cont1; i++) {
                    var id = palmas[i].id;
                    var img = palmas[i].img;
                    jQuery('<div/>', {
                        id: '' + id,
                        class: 'post',
                        // text: 'div bem criada' + i
                    }).appendTo('#posts'); //id/class so sitio

                    $('#' + id).prepend("<a href='baseRevista-editor.php'> <img src='images/mags/" + img + "'> </a>");
                }
            }




            /* ———————————————————  search magazines  ————————————————————————— */

            if (option == null) {
                $(".post").remove();
                showAll();

            } else if (resultadoPesquisa == null) {
                $('#msg').text(no3);
                $('#msg').css('display', 'block');
            } else {
                var tamanho = resultadoPesquisa.length;
                $(".post").remove();

                for (i = 0; i < tamanho; i++) {
                    var procura = resultadoPesquisa[i].id;
                    var img = resultadoPesquisa[i].img;


                    jQuery('<div/>', {
                        id: '' + procura,
                        class: 'post',
                        //text: 'div bem criada' + i
                    }).appendTo('#posts');
                    $('#' + procura).prepend("<a href='baseRevista-editor.php'> <img src='images/mags/" + img + "'> </a>");
                }

            }





            /* ———————————————————  Mostrar categorias   —————————————————————————— */

            $("#list li").on("click", function () {
                $(".post").remove();
                $('#msg').css('display', 'none');
                var divNome = $(this).attr('id');

                $("div").remove(".post");

                if (divNome === 'all') {
                    showAll();
                } else if (divNome === 'favourites') {
                    if (cont2 == 0) {
                        $('#msg').text(no2);
                        $('#msg').css('display', 'block');

                    } else {
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

                            $('#' + id).prepend("<a href='baseRevista-editor.php'> <img src='images/mags/" + img + "'> </a>");
                        }
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
                            $('#' + id).prepend("<a href='baseRevista-editor.php'> <img src='images/mags/" + img + "'> </a>");

                            andaLaSenaoApanhas++;

                        }


                    }
                    if (andaLaSenaoApanhas == 0) {
                        $('#msg').text("We currently don't have magazine in this category.");
                        $('#msg').css('display', 'block');
                    }
                }
            });




            //  -- p da pesquisa  PRESS ENTER TO SEARCH

            $("#enter").hide();
            $("#enter1").hide();

            $("#data").on("click", function () {
                $("#enter1").fadeIn("slow");
                $("#enter").fadeOut("slow");
            });

            $("#nomedesc").on("click", function () {
                $("#enter").fadeIn("slow");
                $("#enter1").fadeOut("slow");
            });


            $("#postPage").on("click", function () {
                $("#enter").fadeOut("slow");
                $("#enter1").fadeOut("slow");
            });


            $("#tutorial").delay(4000).fadeOut("slow");
        </script>


    </body>
    <script src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    </html>