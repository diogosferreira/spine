<?php
include("config.php");
session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM Utilizador WHERE userName = '$myusername' and userPassword = '$mypassword'";
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
        <title>Spine - LogIn </title>
        <link rel="stylesheet" href="css/login.css">
    </head>

    <body>

        <form action="" method="post">
            <input type="text" id="login" name="username" placeholder="Username">
            <input type="password" id="password" name="password" placeholder="Password">
            <input type="submit" value="Login">
        </form>

        <p id="loginError">
            <?php echo $error; ?>
        </p>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </body>

    </html>