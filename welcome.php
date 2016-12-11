<?php
   include('session.php');

    if($login_type == 1){
      header("location:welcomeowner.php");
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
        <link rel="stylesheet" href="css/welcome.css">
    </head>

    <body class="index">
        <header>
            <a href="index.php"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
            <div id="login"> <a href="logout.php"> Logout </a> </div>
        </header>


        <nav>
            <ul>
                <li> <a href="#profile"> Profile </a></li>
                <li> <a href="#messages"> Messages </a></li>
                <li> <a href="#orders"> Orders </a></li>
                <br>
                <li> <a href="magazines.php"> Magazines </a></li>
            </ul>
        </nav>

        <div class="welcome" id="profile">
            <div id="main">
                <div id="profile-pic"></div>
                <div id="profile-main">
                    <div id="profile-name"> Beatriz Lacerda
                    </div>
                    <div class="" id="edit-button"> Edit</div>
                </div>
            </div>
            <div id="info">
                <form action="" method="post">
                    <div class="line">
                        <label for="username"> Username </label>
                        <input type="text" name="username" placeholder="Username" disabled>
                    </div>
                    <div class="line">
                        <label for="email"> Email </label>
                        <input type="text" name="email" placeholder="E-mail" disabled>
                    </div>
                    <div class="line">
                        <label for="email"> Password </label>
                        <input type="password" id="password" name="password" placeholder="Password" disabled>
                    </div>
                    <div class="line">
                        <label for="username"> NIF </label>
                        <input type="text" name="nif" placeholder="Username" disabled>
                    </div>
                    <div class="line">
                        <label for="email"> Adress </label>
                        <input type="text" name="adress" placeholder="E-mail" disabled>
                    </div>
                    <!--<div class="line-button">
                        <input type="submit" value="Save">
                    </div>-->
                </form>
            </div>

        </div>
        
        
        <div class="welcome" id="messages">


        </div> 
        
        
        <div class="welcome" id="orders">


        </div>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="js/script.js"></script>
        <script src="js/welcome.js"></script>
    </body>


    </html>