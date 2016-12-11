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
</head>

<body class="index">
    <header>
        <a href="#firstPage"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
        <div id="login"> <a href="logout.php"> Logout </a> </div>
    </header>

    <p class="dbresult"></p>


    <nav>
        <ul>
            <li> <a href="magazines.html"> Magazines </a></li>
            <li> <a href="about.html"> About </a></li>
            <li> <a href="contacts.html"> Contact </a></li>
        </ul>
    </nav>

    <section id="firstPage">
          <h1>Welcome <?php echo $login_session . $login_type; ?></h1> 

    
    </section>

</body>


</html>