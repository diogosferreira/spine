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
        <link rel="stylesheet" href="css/welcome.css">
    </head>

    <body class="index">
        <header>
            <a href="#"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
            <div id="login"> <a href="logout.php"> Logout </a> </div>
        </header>


        <nav>
            <ul>
                <li> <a href="welcomeowner.php#profile"> Profile </a></li>
                <li> <a href="welcomeowner.php#add-editor"> Add Editor </a></li>
                <li> <a href="welcomeowner.php#add-mag"> Add Mag </a></li>
                <li> <a href="#"> Edit Mag </a></li>
            </ul>
        </nav>


            <!--  search   -->
            <!--<form action="form.php" method="post">-->
            <!--<form method="post">
                Search:
                <br>
                <br>
                <input class="inputtext" type="text" name="option" placeholder="Search Products" />
                <br/>
                <br>
                <input class="btn" type="submit" value="Search" />
            </form>-->
            <!--  search   -->


        <!--————————————————   Search   —————————————————-->

        <?php 
        
        $option = $_POST["option"];  //o que foi escrito na pesquisa

        $sql = "SELECT nomeRevista, idRevista FROM revistaNum WHERE nomeRevista LIKE '%$option%'";

        $result = $conn->query($sql);

        $contador=0;

        if ($result->num_rows > 0  ) {
               
            //

            while($row = $result->fetch_assoc()) {
                
                $pesquisa[$contador] = array("nome"=>$row["nomeRevista"], "id"=>$row["idRevista"]);
                $contador++; 
                //echo "<div class=" . "posts" . ">" . $row["nomeRevista"] . "</div>";  
            
            }
        } else {
            echo "No products were found matching your selection.";
        }
        
        ?>

            <!--—————————————   Search   ————————————————————-->


            <section id="postPage">
                <div id="posts">
                    <!--  cria as divs aqui   -->
                </div>

            </section>




            <div id="left" class="column">

            </div>


            <script src="https://code.jquery.com/jquery-1.10.2.js"></script>


            <script type="text/javascript" language="javascript">
                /* ———————————————————  search magazines  ————————————————————————— */




                var testarcenas = 0;

                for (i = 0; i < 8; i++) {
                    var resultadoPesquisa = <?php echo json_encode($pesquisa); ?>;
                    //var procura = resultadoPesquisa[i].id;
                    $("div").remove(".post");
                }

                var tamanho = resultadoPesquisa.length;
                //console.log("tamanho  " + tamanho);


                $(".post").remove();


                $(".btn").on("click", function () {
                    console.log("pir");
                    testarcenas = 1;
                });
                
                
                
                $(".ropdown-menu").on("click", function () {
                    console.log("pir");
                    testarcenas = 2;
                });




                for (i = 0; i < tamanho; i++) {
                    console.log("top  " + resultadoPesquisa[i].id);

                    var procura = resultadoPesquisa[i].id;


                    jQuery('<div/>', {
                        id: '' + procura,
                        class: 'post',
                    }).appendTo('#posts');
                    $('#' + procura).prepend("<a href='baseRevista-editor.php'> <img src='images/mags/" + procura + ".jpg'> </a>");






                }


                /* ———————————————————  search magazines  ————————————————————————————————— */




                if (testarcenas > 1) {


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

                        $("div").remove(".post");
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

                                    $('#' + id).prepend("<a href='baseRevista-editor.php'> <img src='images/mags/" + id + ".jpg'> </a>");

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

                            $('#' + id).prepend("<a href='baseRevista-editor.php'> <img src='images/mags/" + id + ".jpg'> </a>");
                        }
                    }




                }
            </script>


    </body>
    <script src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    </html>