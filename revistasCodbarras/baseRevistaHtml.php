<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Spine </title>
    <link rel="icon" href="../images/minilogo.png">

    <meta name="Spine" content="An interactive plataform to sell the coolest magazines.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/revistaindividual.css">
</head>

<body class="index">
    <header>
        <a href="../index.html"> <img src="../images/logo.png" alt="spinelogo" id="logo"> </a>
        <div id="login"> <a href="#"> Login </a> </div>
    </header>


    <nav>
        <ul>
            <!--<li> <a href="magazines.html"> Magazines </a></li>
            <li> <a href="index.html#subscriptions"> About </a></li>
            <li> <a href="index.html#contact"> Contact </a></li>-->
            <li> <a id="voltar" href="../magazines.html"> &larr; Show all magazines </a></li>
        </ul>
    </nav>


    <!--——————————————— Revista —————————————————-->


    <section>
        <div id="left" class="column">
            <!--<img class="cover" src="../images/frankie.jpg" alt="Frankie">
            <img class="cover" src="../images/frankie.jpg" alt="Frankie">-->
        </div>

        <div id="right" class="column">
            <div id="text">
                <p id="nome">Frankie #73</p>
                <br>
                <p> €17 <a id="preco" href="#"> BUY NOW </a></p>
                <br>

                <p id="descricao"> </p>

                <br>
                <p>

                </p>
            </div>
        </div>
    </section>



    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="../js/script.js"></script>


    <?php include('../baseRevista.php'); ?>


        <script type="text/javascript" language="javascript">
            for (i = 0; i < 8; i++) {
                var palmas = <?php echo json_encode($didi); ?>;
                //console.log("i é: " +palmas[i].categoria);
            }



            //Selecionar a imagem com o codigo de barras

            var codBarras = palmas[1].codBarras;
            console.log(codBarras);
            $('#left').prepend("<img class='cover' src='../imagesCodbarras/" + codBarras + ".jpg'> </a>");


            
            //Selecionar adescricao
            
            var descricao = palmas[1].descricao;
            console.log(descricao);

            $('#descricao').text(descricao);
        </script>



</body>

</html>