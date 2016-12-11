<?php
include("config.php");
session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])){
        if(empty($_POST['username']) && empty($_POST['password']))
            $msg ="Insert values please.";
        else if(empty($_POST['username']))
            $msg ="Forgot to insert username.";
        else if(empty($_POST['password']))
            $msg ="Forgot to insert password.";
        else {
        
            $myusername = mysqli_real_escape_string($db,$_POST['username']);
            $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
            $owner = 0;
 
            //check if the username exists
            $sql = "SELECT * FROM Utilizador WHERE userName = '$myusername'";
            $result = mysqli_query($db,$sql);
            $count = mysqli_num_rows($result);
      		
            if($count != 0) {
                $msg = 'Sorry, the username already exists.';
            } else {
                $query2 = "INSERT INTO `Utilizador` (`userName`, `userPassword`, `dono`) VALUES ('$myusername', '$mypassword', '$owner')";
                $result = mysqli_query($db, $query2);
                if($result){
                    $msg = "User Created Successfully.";
                }else{
                    $msg ="User Registration Failed.";
                }
            }
        }
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
            <input type="submit" value="Register">
        </form>

        <p id="loginError">
            <?php echo $msg; ?>
                <br>
                <?php echo $query; ?>
        </p>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </body>

    </html>