<?php
include("config.php");
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
        if(empty($_POST['username']) && empty($_POST['email']) && empty($_POST['password']))
            $msg ="Insert values please.";
        else if(empty($_POST['username']))
            $msg ="Forgot to insert username.";
        else if(empty($_POST['email']))
            $msg ="Forgot to insert email.";
        else if(empty($_POST['password']))
            $msg ="Forgot to insert password.";
        else {
        
            $myusername = mysqli_real_escape_string($conn,$_POST['username']);
            $myemail = mysqli_real_escape_string($conn,$_POST['email']);
            $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
            $owner = 0;
            $myhashpassword = sha1($mypassword);

            //check if the username exists
            $sql1 = "SELECT * FROM Utilizador WHERE userName = '$myusername'";
            $result1 = mysqli_query($conn,$sql1);
            $count1 = mysqli_num_rows($result1);
            
            
            //check if the email exists
            $sql2 = "SELECT * FROM Utilizador WHERE userEmail = '$myemail'";
            $result2 = mysqli_query($conn,$sql2);
            $count2 = mysqli_num_rows($result2);
            
            
            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/'; 
            
            if($count1 != 0) {
                $msg = 'Sorry, the username already exists.';
            } else if($count2 != 0) {
                $msg = 'Sorry, the email already exists.';
            } else if (!preg_match($regex, $myemail)) {
                    $msg ="Sorry, the email is invalid.";
            } else {
                $query = "INSERT INTO `Utilizador` (`userName`, `userEmail`, `userPassword`, `dono`) VALUES ('$myusername',  '$myemail', '$myhashpassword', '$owner')";
                $endresult = mysqli_query($conn, $query);
                if($endresult){
                    $msg = "User Created Successfully!";
                    $querytext = "INSERT INTO `Utilizador_Msg` (`userName`, `message`, `date`) VALUES ('$myusername', 'Congratulations! You have now created your account, be free to shop as much as you want.', CURRENT_DATE())"; 
                    $textresult = mysqli_query($conn, $querytext);

                }else{
                    $msg ="Sorry, user Registration Failed.";
                }
            }
        }
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


                <br>
                
                <div id="login"> <a href="login.php">Login</a></div>
            </nav>
        </div>
        
        <p id="warning"> Couldn't connect to database, try later. </p>

        
        <div id="form">
            <form action="" method="post">
                <input type="text" name="username" placeholder="Username">
                <input type="text" name="email" placeholder="E-mail">
                <input type="password" id="password" name="password" placeholder="Password">
                <input type="submit" value="Register">
            </form>
            <p id="loginError">
                <?php echo $msg . $pass1 . $pass2; ?>
            </p>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" language="javascript">
            var connfailed = <?php echo json_encode($failed); ?>;
            if (connfailed)
                $('#warning').fadeIn();
        </script>
        </body>

    </html>