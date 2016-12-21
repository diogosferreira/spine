<?php 
include('categorias.php'); 
session_start();

if(!empty($_SESSION['login_user']))
    $user = true;
else
    $user = false;

    $_SESSION['welcomeowner-msg0'] = '';
    $_SESSION['welcomeowner-msg1'] = '';
    $_SESSION['welcomeowner-msg2'] = '';
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

    <style>
        #dropdown-list {
            top: 35vh;
        }
        
        .pesquisa {
            top: 5vh;
        }
        
        nav ul li:nth-child(1) {
            text-decoration: none;
        }
        
        nav ul li:nth-child(8) {
            text-decoration: underline;
        }
    </style>

    <body>


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

                <div id="login"> <a href="logout.php">Logout</a></div>


                <div id="dropdown-list">
                    <div class="dropdown closed">
                        <div class="title">Pick Category</div>

                        <div class="piro">
                            <div class="dropdown-menu">
                                <ul id="list">
                                    <li id="all">All</li>
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
        
                <p id="warning"> Couldn't connect to database, try later. </p>

                
                <form class="pesquisa" method="post">
                    <i class="material-icons md-30">search</i>
                    <input class="inputtext" type="text" autocomplete="off" name="option" placeholder="Search Products " />
                    <br>

                    <span id="spanSearch"><p id="enter"> Press <u>enter</u> to search.</p></span>
                    <!--<input class="btn" type="submit" value="Search" />-->

                </form>
            </nav>
        </div>


        <section id="postPage">
            <div id="posts">
                <!--  cria as divs aqui   -->
            </div>
        </section>


        <div id="left" class="column"></div>


        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>



        <!--————————————————   Search   —————————————————-->

        <?php 
        
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
            echo "No products were found matching your selection.";
        }
        
        ?>


        <script type="text/javascript" language="javascript">
            var connfailed = <?php echo json_encode($failed); ?>;
            if (connfailed)
                $('#warning').fadeIn();
            
            
            
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
                $('#' + procura).prepend("<a href='baseRevista-editor.php'> <img src='images/mags/" + img + "'> </a>");

            }



            /* ———————————————————  search categories   —————————————————————————— */

            $("#list li").on("click", function () {
                $(".post").remove();


                var testeaula = $('#posts').text();


                for (i = 0; i < 8; i++) {
                    var palmas = <?php echo json_encode($didi); ?>;
                    //console.log("i é: " +palmas[i].categoria);
                }
                //showAll();
                //ver qual a categoria selecionada


                var divNome = $(this).attr('id');

                $("div").remove(".post");
                if (divNome === 'all') {
                    showAll();
                } else {
                    for (i = 0; i < 8; i++) {
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

                        }
                    }
                }
            });

            //mostrar todas as revistas
            function showAll() {
                for (i = 0; i < 8; i++) {
                    var id = palmas[i].id;
                    var img = palmas[i].img;
                    jQuery('<div/>', {
                        id: '' + id,
                        class: 'post',
                        // text: 'div bem criada' + i
                    }).appendTo('#posts'); //id/class so sitio

                    //$('#div' + i).prepend("<a href='revistasCodbarras/" + codBarras + ".html'> <img src='imagesCodbarras/" + codBarras + ".jpg'> </a>");

                    $('#' + id).prepend("<a href='baseRevista-editor.php'> <img src='images/mags/" + img + "'> </a>");
                }
            }


            //  -- p da pesquisa 
            $("#enter").hide();

            $(".inputtext").on("click", function () {
                $("#enter").fadeIn("slow");
            });

            $("#postPage").on("click", function () {
                $("#enter").fadeOut("slow");
            });
        </script>




</body>
<script src="js/script.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

</html>