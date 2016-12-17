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
</head>

<body class="index">
    <header>
        <a href="#firstPage"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
        <div id="login"> <a href="login.php">Login</a> / <a href="register.php">Register</a></div>
    </header>

    <p class="dbresult"></p>



    <nav>
        <ul>
            <li> <a href="magazines.php"> Magazines </a></li>
            <li> <a href="about.php"> About </a></li>
            <li> <a href="contacts.php"> Contact </a></li>
        </ul>
    </nav>

    <section id="firstPage" class="fullPage"></section>




    <!--teste ler revistas———————————————————-->

    <a href="lerrevistahtml.php"> ler revistas </a>

    <!--teste ler revistas fim ———————————————————-->




    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="js/script.js"></script>
    <script>
        var user = <?php echo json_encode($user); ?>;
        if (user)
            $('#login').html('<a href="welcome.php">Profile</a> / <a href="logout.php">Logout</a>');
        console.log(user);
    </script>
</body>


</html>