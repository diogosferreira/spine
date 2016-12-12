<?php
   include('session.php');
    session_start();

?>
    <script type="text/javascript" language="javascript">
        var type = <?php echo json_encode($login_type); ?>;
        console.log("type: " + type);
        if (type == 1)
            location.href = "welcomeowner.php";
    </script>


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
            <div id="login"> <a href="magazines.php">Magazines</a> / <a href="logout.php">Logout</a> </div>
        </header>


        <nav>
            <ul>
                <li> <a href="#profile"> Profile </a></li>
                <li> <a href="#messages"> Messages </a></li>
                <li> <a href="#cart"> Cart </a></li>
            </ul>
        </nav>

        <div class="welcome" id="profile">
            <div id="main">
                <form method="post" enctype="multipart/form-data">
                    <input id="profile-pic-button" type="file" name="file" accept="image/*" />
                    <input id="profile-pic" onclick="document.getElementById('profile-pic-button').click();" />
                </form>
                <div id="profile-main">
                    <div id="profile-name"> Beatriz Lacerda </div>
                    <input class="button" type="submit" name="submit" value="Edit" />
                </div>
            </div>
            <div id="info">
                <form action="" method="post">
                    <div class="line">
                        <label for="username"> Username </label>
                        <input type="text" id="username" name="username" placeholder="" disabled>
                    </div>
                    <div class="line">
                        <label for="email"> Email </label>
                        <input type="text" id="email" name="email" placeholder="" disabled>
                    </div>
                    <div class="line">
                        <label for="password"> Password </label>
                        <input class="changeable" type="password" id="password" name="password" placeholder="*" disabled>
                    </div>
                    <div class="line">
                        <label for="nif"> NIF </label>
                        <input class="changeable" type="text" id="nif" name="nif" placeholder="" disabled>
                    </div>
                    <div class="line">
                        <label for="address"> Address </label>
                        <input class="changeable" type="text" id="address" name="address" placeholder="" disabled>
                    </div>
                    <input style="display:none;" id="hidden-button" type="submit" name="submit" value="Hidden" />

                    <!--<div class="line-button">
                        <input type="submit" value="Save">
                    </div>-->
                </form>
            </div>

        </div>


        <div class="welcome" id="messages">
            <h2> Messages </h2>
            <div id="msg-container"></div>
        </div>


        <div class="welcome" id="cart">
            <h2> Cart </h2>
            <div class="line">
                <div class="date"></div>
                <div class="msg"></div>
            </div>
            <div class="line" id="total">
                Your total is 0 euros.
            </div>
        </div>



        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="js/script.js"></script>


        <script type="text/javascript" language="javascript">
            //-- PROFILE --
            var username = <?php echo json_encode($login_session); ?>;
            var email = <?php echo json_encode($login_email); ?>;
            var nif = <?php echo json_encode($login_nif); ?>;
            var address = <?php echo json_encode($login_address); ?>;


            $('#profile-name').text(username);

            $('#username').attr("placeholder", username);
            $('#email').attr("placeholder", email);
            $('#nif').attr("placeholder", nif);
            $('#address').attr("placeholder", address);


            //-- EDIT PROFILE --
            $('.button').on("click", function () {
                $(".changeable").toggleClass('enabled');
                $("#profile-pic").toggleClass('profile-pic-enabled');

                if ($("form input").hasClass('enabled')) {
                    $(this).val('Save');
                    $("form input").prop('disabled', false);
                } else {
                    document.getElementById('hidden-button').click();
                    $(this).val('Edit');
                    $("form input").prop('disabled', true);
                }
            });


            //-- MESSAGES --

            var msg_amount = <?php echo json_encode($contador); ?>;
            for (i = 0; i < msg_amount; i++) {
                var palmas = <?php echo json_encode($didi); ?>;
            }

            console.log(msg_amount);
            console.log(palmas);

            for (i = 0; i < msg_amount; i++) {
                var date = palmas[i].date;
                var msg = palmas[i].message;

                jQuery('<div/>', {
                    id: 'msg' + i,
                    class: 'line',
                    // text: 'div bem criada' + i
                }).appendTo('#msg-container'); //id/class so sitio


                $('#msg' + i).prepend("<div class='date'> " + date + "</div> <div class='msg'> " + msg + " </div>");


            }
        </script>

        <?php 
        
        
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(!empty($_POST['password'])) {
                $newpassword = $_POST['password'];
                $changepasssword = "UPDATE Utilizador SET userPassword = '$newpassword' WHERE userName='bibs'";  
            }
            if(!empty($_POST['nif'])){
                $newnif = $_POST['nif'];
                $changenif = "UPDATE Utilizador SET nif = '$newnif' WHERE userName='bibs'";  
            }
            if(!empty($_POST['address'])){
                $newaddress = $_POST['address'];
                $changeaddress = "UPDATE Utilizador SET morada = '$newaddress' WHERE userName='bibs'";  
            }
            
            if ($conn->query($changepasssword) === TRUE) {
                $m1 = "Records were updated successfully.";
            } else {
                $m1 = "ERROR: Could not able to execute $changepasssword. ";
            } 
            
            if ($conn->query($changenif) === TRUE) {
                $m2 = "Records were updated successfully.";
            } else {
                $m2 = "ERROR: Could not able to execute $changenif. ";
            }            
            
            if ($conn->query($changeaddress) === TRUE) {
                $m3 = "Records were updated successfully.";
            } else {
                $m3 = "ERROR: Could not able to execute $changeaddress. ";
            }
            
            
            
            
//$change = "UPDATE Utilizador SET userPassword = '$newpassword'".", nif = '$newnif'".", morada = '$newaddress'"."WHERE userName='bibs'";
            
            //$change = "UPDATE Utilizador SET userPassword = 'bibz'".", nif = '44'".", morada = 'dz'"."WHERE userName='bibs'";

            /*if ($bd->query($change) === TRUE) {
                echo "Records were updated successfully.";
            } else {
                echo "ERROR: Could not able to execute $change. " . mysqli_error($link);
            }*/

        }
        ?>
    </body>


    </html>