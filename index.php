<?php 
include('db.php'); 
session_start();

if(!empty($_SESSION['login_user']))
    $user = true;
else
    $user = false;





$sql = "SELECT imgRevista FROM revistaNum ORDER BY ano DESC";
$result = $conn->query($sql);


$contador=0;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $didi[$contador] = array("img"=>$row["imgRevista"]);

        $contador++;
    }
} else {
    //echo " 0 results";
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

                <div id="login"> <a href="login.php">Login</a> / <a href="register.php">Register</a></div>
            </nav>
        </div>
        <p id="warning"> Couldn't connect to database, try later. </p>


        <section id="firstPage" class="fullPage"></section>


        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript" language="javascript">
            var connfailed = <?php echo json_encode($failed); ?>;
            if (connfailed)
                $('#warning').fadeIn();

            var user = <?php echo json_encode($user); ?>;
            if (user)
                $('#login').html('<a href="welcome.php">Profile</a> / <a href="logout.php">Logout</a>');
            console.log(user);

            var palmas = <?php echo json_encode($didi); ?>;
        </script>
        <script src="js/script.js"></script>

    </body>


    </html>