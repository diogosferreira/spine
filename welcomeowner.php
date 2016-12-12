<?php   
include('session.php');
include('register-editor.php');
session_start();
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
            <li> <a href="#add-editor"> Add Editor </a></li>
            <li> <a href="#add-mag"> Add Mag </a></li>
            <li> <a href="#edit-mag"> Edit Mag </a></li>
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
                <input class="button" id="button" type="submit" name="submit" value="Edit" />
                <!--<input class="button" id="cancel-button" type="submit" name="submit" value="Cancel" />-->
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
                <input style="display:none;" id="hidden-button" type="submit" name="btn-submit" value="Hidden" />
            </form>
        </div>

    </div>


    <div class="welcome" id="add-editor">
        <h2> Add Editor </h2>
        <div id="info">
            <form action="" method="post">
                <div class="line">
                    <label for="username"> Username </label>
                    <input type="text" id="username" name="username" placeholder="Username" >
                </div>
                <div class="line">
                    <label for="email"> Email </label>
                    <input type="text" id="email" name="email" placeholder="Email" >
                </div>
                <div class="line">
                    <label for="password"> Password </label>
                    <input class="changeable" type="password" id="password" name="password" placeholder="Password">
                </div>
                <div class="button add-button" id="btn-add-editor">
                    <input type="submit" name="btn-submit" value="Add">
                </div>
            </form>
        </div>
    </div>

    
    <div class="welcome" id="add-mag">
        <h2> Add Magazine </h2>
        <div id="info">
            <form action="" method="post">
                <div class="line">
                    <label for="name"> Name </label>
                    <input type="text" name="name" placeholder="Name" >
                </div>
                <div class="line">
                    <label for="issue"> Issue </label>
                    <input type="text" name="issue" placeholder="Issue" >
                </div>
                <div class="line">
                    <label for="barcode"> Bar Code </label>
                    <input type="text" name="barcode" placeholder="Bar Code" >
                </div>
                <div class="line">
                    <label for="price"> Price </label>
                    <input type="text" name="price" placeholder="Price" >
                </div>
                <div class="line">
                    <label for="category"> Category </label>
                    <input type="text" name="category" placeholder="Category" >
                </div>
                <div class="line">
                    <label for="description"> Description </label>
                    <input type="text" name="description" placeholder="Description" >
                </div>
                <div class="button add-button" id="btn-add-editor">
                    <input type="submit" name="btn-submit" value="Add Magazine">
                </div>
            </form>
        </div>
    </div>

    
    <div class="welcome" id="edit-mag">
        <h2> Edit Magazine 
        
        <div id="dropdown-list">
            <div class="dropdown closed">
                <div class="title">Pick Magazine</div>

                <div class="dropdown-menu">
                    <ul id="list">
                        <li id="all">All</li>
                        <li id="design">Design</li>
                        <li id="social">Social</li>
                        <li id="illustration">Illustration</li>
                    </ul>
                </div>

            </div>
        </div>
        </h2>
        <div id="info">
            <form action="" method="post">
                <div class="line">
                    <label for="name"> Name </label>
                    <input type="text" name="name" placeholder="Name" >
                </div>
                <div class="line">
                    <label for="issue"> Issue </label>
                    <input type="text" name="issue" placeholder="Issue" >
                </div>
                <div class="line">
                    <label for="barcode"> Bar Code </label>
                    <input type="text" name="barcode" placeholder="Bar Code" >
                </div>
                <div class="line">
                    <label for="price"> Price </label>
                    <input type="text" name="price" placeholder="Price" >
                </div>
                <div class="line">
                    <label for="category"> Category </label>
                    <input type="text" name="category" placeholder="Category" >
                </div>
                <div class="line">
                    <label for="description"> Description </label>
                    <input type="text" name="description" placeholder="Description" >
                </div>
                <div class="button add-button" id="btn-add-editor">
                    <input type="submit" name="btn-submit" value="Save Magazine">
                </div>
            </form>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>


    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="js/script.js"></script>


    <script type="text/javascript" language="javascript">


        //-- PROFILE --
        var username = <?php echo json_encode($login_session); ?>;
        var email = <?php echo json_encode($login_email); ?>;


        $('#profile-name').text(username);

        $('#username').attr("placeholder", username);
        $('#email').attr("placeholder", email);


        //-- EDIT PROFILE --
        $('#button').on("click", function () {
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
        
        /*$('#cancel-button').on("click", function () {
            
            $("form input").prop('disabled', false);
        });*/


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
      if($_REQUEST['btn-submit']=="Hidden"){
            
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
      }
    }
    ?>
</body>


</html>