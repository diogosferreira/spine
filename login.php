<?php
include("config.php");
session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM Utilizador WHERE (userName = '$myusername' and userPassword = '$mypassword') or (userEmail = '$myusername' and userPassword = '$mypassword')";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         $_SESSION['login_pass'] = $mypassword;
         
         
         echo "<script> window.location.href='welcome.php';  </script>";

      }else {
         $error = "Your Login Name or Password is invalid";
      }
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
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/style.css">

    </head>

    <body class="index">
        <header>
            <a href="index.php"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
            <div id="login"> <a href="register.php">Register</a></div>
        </header>


        <nav>
            <ul>
                <li> <a href="magazines.php"> Magazines </a></li>
                <li> <a href="about.html"> About </a></li>
                <li> <a href="contacts.html"> Contact </a></li>
            </ul>
        </nav>

        <div id="form">
            <form action="" method="post">
                <input type="text" name="username" placeholder="Username or email">
                <input type="password" id="password" name="password" placeholder="Password">
                <input type="submit" value="Login">

                <p id="loginError">
                    <?php echo $error; ?>
                </p>
            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </body>

    </html>