<!DOCTYPE html>
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
            <li> <a href="magazines.html"> Magazines </a></li>
            <li> <a href="about.html"> About </a></li>
            <li> <a href="contacts.html"> Contact </a></li>
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


    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="js/script.js"></script>


    <?php include('categorias.php'); ?>


        <script type="text/javascript" language="javascript">


            for (i = 0; i < 8; i++) {
                var palmas = <?php echo json_encode($didi); ?>;
                //console.log("i é: " +palmas[i].categoria);
            }

            showAll();
            //ver qual a categoria selecionada

            $("#list li").on("click", function () {
                //console.log($(this).attr('id'));
                var divNome = $(this).attr('id');


                //esconder as outras divs
                $(".post").remove();

                if (divNome === 'all') {
                    showAll();
                } else {

                    for (i = 0; i < 8; i++) {

                    var codBarras = palmas[i].codBarras;

                    //  console.log("divnome==" + divNome);
                    if (divNome === palmas[i].categoria) {
                        //console.log(i + " é " + divNome);

                        jQuery('<div/>', {
                            id: 'div' + i,
                            class: 'post',
                            // text: 'div bem criada' + i
                        }).appendTo('#posts'); //id/class so sitio


                        //só meter id e imagem em variável

                        $('#div' + i).prepend("<a href='revistasCodbarras/" + codBarras + ".html'> <img src='imagesCodbarras/" + codBarras + ".jpg'> </a>");


                    }

                    }
                }

                });



            function showAll (){
                for (i = 0; i < 8; i++) {
                    var codBarras = palmas[i].codBarras;
                    jQuery('<div/>', {
                        id: 'div' + i,
                        class: 'post',
                        // text: 'div bem criada' + i
                    }).appendTo('#posts'); //id/class so sitio

                    $('#div' + i).prepend("<a href='revistasCodbarras/" + codBarras + ".html'> <img src='imagesCodbarras/" + codBarras + ".jpg'> </a>");
                }
            }


            /*


                        for (i = 0; i < 8; i++) {
                            var palmas = <?php echo json_encode($didi); ?>;
                            $('.dbresult').text("idrevista: " + palmas[i].categoria);

                        }


                        //————— mostrar nos p´s

                        $('.dbresult').text("idrevista: " + palmas[0].categoria);

                        $('.codbarras').text("codbarras: " + palmas[0].codBarras);




                        */









            //  Criar uma div com id e class na div posts

            /*         for (i = 0; i < 2; i++) { //numero de divs
                         jQuery('<div/>', {
                             id: 'div' + i,
                             class: 'post',
                             text: 'sou uma nova div' + i
                         }).appendTo('#posts'); //id/class so sitio
                     }


                     //Meter imagem na div que criei

                     for (i = 0; i < 2; i++) {
                         //console.log("iiiii" + i);
                         //$('#div' + i).prepend('<img id="theImg" src="images/magazine1.jpg" />');

                         // $('#div' + i).prepend('<a href="revistas/frankie.html"> <img src="images/frankie.jpg"></a>');

                         $('#div' + i).prepend("<a href='revistas/frankie' + '.html'> <img src='images/frankie.jpg'> </a>");
                         // $('<img src= ' + nome + '>').appendTo(".img");
                     }



             */
        </script>

</body>

</html>
