<?php 
include('db.php'); 
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
        <link rel="stylesheet" href="css/about.css">
    </head>

    <body class="index">

        <div class="barraMenu">

            <header>
                <a href="index.php"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>

            </header>


            <nav>
                <ul id="nav-menu">
                    <li> <a href="magazines.php"> Magazines </a></li>
                    <li> <a href="about.php"> About </a></li>
                    <li> <a href="contacts.php"> Contact </a></li>
                </ul>


                <div id="login"> <a href="login.php">Login</a> / <a href="register.php">Register</a></div>
            </nav>
        </div>
        <p id="warning"> Couldn't connect to database, try later. </p>

        
        <img src="images/about.png" alt="about" id="aboutimage">

        <div id="about">
            <p class="about">
                Spine is a contemporary bookshop based in Coimbra. We offer a wide range of international magazines, journals, books and artworks that were carefully chosen to inspire the modern reader.</p>
            <br>
            <p class="about">
                Our reading materials cover all kind of topics, from art, fashion, photography, food, traveling, architecture, culture and society, to design, literature and music. We are drawn to free expression and provocative thinking.
            </p>
        </div>


        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="js/script.js"></script>
        <script type="text/javascript" language="javascript">
            var connfailed = <?php echo json_encode($failed); ?>;
            if(connfailed)
                $('#warning').fadeIn();            
            
            var user = <?php echo json_encode($user); ?>;
            if (user)
                $('#login').html('<a href="welcome.php">Profile</a> / <a href="logout.php">Logout</a>');
            console.log(user);
        </script>

    </body>

    </html>