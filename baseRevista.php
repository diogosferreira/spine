<?php include('revista.php');?>

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
            <a href="../index.php"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
            <div id="login"> <a href="#"> Login </a> </div>
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
                <img id="imagem" class="cover" src="images/mags/1.jpg" alt="Adbusters">
            </div>

            <div id="right" class="column">
                <div id="text">
                    <p id="nome"> </p>
                    <br>
                    <p> <span id="t-preco"> </span>€ <a id="preco" href="#"> BUY NOW </a></p>
                    <br>

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
            
                
            $('#imagem').attr('src', 'images/mags/'+id+'.jpg');
            $('#nome').text(palmas[0].nome+" #"+palmas[0].num);
            $('#t-preco').text(palmas[0].preco);
            $('#descricao').text(palmas[0].descricao);
        </script>

    </body>

    </html>