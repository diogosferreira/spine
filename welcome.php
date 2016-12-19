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

    <body>
        <div class="barraMenu">
            <header>
                <a href="index.php"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
            </header>


            <nav>
                <ul id="nav-menu">
                    <li> <a href="magazines.php"> Magazines </a></li>
                    <li> <a href="#profile"> Profile </a></li>
                    <li> <a href="#messages"> Messages </a></li>
                    <li> <a href="paypal/index%202.php"> Cart </a></li>
                </ul>


                <br>

                <div id="login"><a href="logout.php">Logout</a></div>


            </nav>
        </div>
        <p id="warning"> Couldn't connect to database, try later. </p>

        <div class="welcome" id="profile">
                <div id="main">
                    <form method="post" enctype="multipart/form-data">
                        <input id="profile-pic" onclick="document.getElementById('profile-pic-button').click();" />
                    </form>
                    <div id="profile-main">
                        <div id="profile-name"> </div>
                        <input class="button" type="submit" name="submit" value="Edit" />
                    </div>
                </div>
                <div id="info">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input class="changeable" id="profile-pic-button" type="file" name="image" onchange="previewFile()" disabled accept=".jpg, .jpeg, .png" />
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
                <p class="answer"></p>
            </div>


            <div class="welcome" id="messages">
                <h2> Messages </h2>
                <div id="msg-container"></div>
            </div>


            <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
            <script src="js/script.js"></script>


            <script type="text/javascript" language="javascript">
            var connfailed = <?php echo json_encode($failed); ?>;
            if (connfailed)
                $('#warning').fadeIn();                
                
                
                //-- PROFILE --
                var pic = <?php echo json_encode($login_pic); ?>;
                var username = <?php echo json_encode($login_session); ?>;
                var email = <?php echo json_encode($login_email); ?>;
                var nif = <?php echo json_encode($login_nif); ?>;
                var address = <?php echo json_encode($login_address); ?>;


                //change message when data edited
                var newmsg = <?php echo json_encode($_SESSION['welcome-msg']); ?>;
                if (newmsg != null)
                    $('.answer').text(newmsg);

                setTimeout(function () {
                    $('.answer').fadeOut();
                }, 2000);


                $('#profile-name').text(username);
                $('#profile-pic').css("background-image", "url('images/users/" + pic + "')");
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


                //PROFILE PHOTO
                function previewFile() {
                    var preview = document.querySelector('#profile-pic'); //selects the query named img
                    var file = document.querySelector('input[type=file]').files[0]; //sames as here
                    var reader = new FileReader();

                    reader.onloadend = function () {
                        preview.style.backgroundImage = "url(" + reader.result + ")";
                    }

                    if (file) {
                        reader.readAsDataURL(file); //reads the data as a URL
                    } else {
                        preview.style.backgroundImage = "url('')";
                    }
                }



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
           if(isset($_FILES['image'])){
               
              $errors= array();
              $file_size = $_FILES['image']['size'];
              $file_tmp = $_FILES['image']['tmp_name'];
              $file_type = $_FILES['image']['type'];
              $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

              $expensions= array("jpeg","jpg","png");

              if(in_array($file_ext,$expensions)=== false){
                 $errors[]="Extension not allowed, please choose a JPEG or PNG file. ";
                 $m01 ="Extension not allowed, please choose a JPEG or PNG file. ";
              }

              if($file_size > 2097152) {
                 $errors[]='File size must be inferior to 2 MB';
                 $m02 ='File size must be inferior to 2 MB';
              }

              if(empty($errors)==true) {
                 $directory = $login_session . "." . $file_ext;
                 move_uploaded_file($file_tmp,"images/users/" . $directory);
                 $changeimage = "UPDATE Utilizador SET userImage = '$directory' WHERE userName='$login_session'";  
                 
                if ($conn->query($changeimage) === TRUE) 
                    $m0 = "Changed image. ";
                else 
                    $m0 = "Couldn't change image. ";
              }else{
                 $m0 = $m01 . $m02;
              }
           }
            
            if(!empty($_POST['password'])) {
                $newpassword = $_POST['password'];
                $changepasssword = "UPDATE Utilizador SET userPassword = '$newpassword' WHERE userName='$login_session'";  
                
                if ($conn->query($changepasssword) === TRUE) 
                    $m1 = "Changed password. ";
                else 
                    $m1 = "Couldn't change password. ";
            }
            if(!empty($_POST['nif'])){
                $newnif = $_POST['nif'];
                $changenif = "UPDATE Utilizador SET nif = '$newnif' WHERE userName='$login_session'"; 
                
                if ($conn->query($changenif) === TRUE) 
                    $m2 = "Changed nif. ";
                else 
                    $m2 = "Couldn't change nif. ";
            }
            if(!empty($_POST['address'])){
                $newaddress = $_POST['address'];
                $changeaddress = "UPDATE Utilizador SET morada = '$newaddress' WHERE userName='$login_session'";  
                
                if ($conn->query($changeaddress) === TRUE) 
                    $m3 = "Changed address. ";
                else 
                    $m3 = "Couldn't change address. ";
            }
            
            
            $msg = $m0 . $m1 . $m2 . $m3;
            $_SESSION['welcome-msg'] = $msg;
    
            echo"<script language='javascript'> window.location.href = 'welcome.php'; </script> ";
            

        }
        ?>
    </body>


    </html>