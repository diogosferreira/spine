<?php
include('session.php');
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_REQUEST['btn-submit']=="Add") {
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
        $owner = 1;

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
            $query = "INSERT INTO `Utilizador` (`userName`, `userEmail`, `userPassword`, `dono`) VALUES ('$myusername',  '$myemail', '$mypassword', '$owner')";
            $endresult = mysqli_query($conn, $query);
            if($endresult){
                $msg = "User created successfully!";
                $querytext = "INSERT INTO `Utilizador_Msg` (`userName`, `message`, `date`) VALUES ('$myusername', 'Congratulations! You have now created your account, be free to shop as much as you want.', CURRENT_DATE())"; 
                $textresult = mysqli_query($conn, $querytext);

            }else{
                $msg ="Sorry, user Registration Failed.";
            }
        }
    }
 }
}
    
       else if($_REQUEST['btn-submit']=="Add Magazine") {
if (isset($_POST['name']) && isset($_POST['issue']) && isset($_POST['barcode']) && isset($_POST['price']) && isset($_POST['category']) && isset($_POST['quantity']) && isset($_POST['description'])){
    if(empty($_POST['name']) || empty($_POST['issue']) || empty($_POST['barcode']) || empty($_POST['price']) || empty($_POST['category']) || empty($_POST['quantity']) || empty($_POST['description']))
        $msg2 ="Insert all values please.";
    else {

        $magname = mysqli_real_escape_string($conn,$_POST['name']);
        $magissue = mysqli_real_escape_string($conn,$_POST['issue']);
        $magbarcode = mysqli_real_escape_string($conn,$_POST['barcode']);
        $magprice = mysqli_real_escape_string($conn,$_POST['price']);
        $magcategory = mysqli_real_escape_string($conn,$_POST['category']);
        $magquantity = mysqli_real_escape_string($conn,$_POST['quantity']);
        $magdescription = mysqli_real_escape_string($conn,$_POST['description']);


        //check if the barcode already exists
        $sql3 = "SELECT codBarras FROM RevistaNum WHERE codBarras = '$magbarcode'";
        $result3 = mysqli_query($conn,$sql3);
        $count3 = mysqli_num_rows($result3);

        //check if the mag name and issue already exists
        $sql4 = "SELECT * FROM RevistaNum WHERE (nomeRevista = '$magname' and numRevista = '$magissue')";
        $result4 = mysqli_query($conn,$sql4);
        $count4 = mysqli_num_rows($result4);
              
              
              
        if($count3 != 0) {
            $msg2 = 'Sorry, the barcode already exists.';
        } else if($count4 != 0) {
            $msg2 = 'Sorry, the issue for this magazine already exists.';
        } else {
            $query = "INSERT INTO `RevistaNum` (`codBarras`, `nomeRevista`, `numRevista`, `preco`, `quantExistente`, `categoria`, `descricao`) VALUES ('$magbarcode', '$magname', '$magissue', '$magprice', '$magquantity', '$magcategory', '$magdescription')";
            $endresult = mysqli_query($conn, $query);
            if($endresult){
                $msg2 = "Magazine created successfully!";
            }else{
                $msg2 ="Sorry, magazine creation failed.";
            }
        }
    }
 }
}
}

?>
    <script type="text/javascript" language="javascript">
        var type = <?php echo json_encode($login_type); ?>;
        console.log("type: " + type);
        if (type == 0)
            location.href = "welcome.php";
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
            <a href="#"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
            <div id="login"> <a href="logout.php"> Logout </a> </div>
        </header>


        <nav>
            <ul>
                <li> <a href="#profile"> Profile </a></li>
                <li> <a href="#add-editor"> Add Editor </a></li>
                <li> <a href="#add-mag"> Add Mag </a></li>
                <li> <a href="magazines-editor.php"> Edit Mag </a></li>
            </ul>
        </nav>

        <div class="welcome" id="profile">
            <div id="main">
                <form method="post" enctype="multipart/form-data">
                    <input id="profile-pic-button" type="file" name="file" accept="image/*" />
                    <input id="profile-pic" onclick="document.getElementById('profile-pic-button').click();" />
                </form>
                <div id="profile-main">
                    <div id="profile-name"> </div>
                    <input class="button" id="button" type="submit" name="submit" value="Edit" />
                    <!--<input class="button" id="cancel-button" type="submit" name="submit" value="Cancel" />-->
                </div>
            </div>
            <div id="info">
                <form action="register-editor.php" method="post">
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
                        <input type="text" id="addusername" name="username" placeholder="Username">
                    </div>
                    <div class="line">
                        <label for="email"> Email </label>
                        <input type="text" id="addemail" name="email" placeholder="Email">
                    </div>
                    <div class="line">
                        <label for="password"> Password </label>
                        <input type="password" id="addpassword" name="password" placeholder="Password">
                    </div>
                    <div class="button add-button" id="btn-add-editor">
                        <input type="submit" name="btn-submit" value="Add">
                    </div>
                </form>
            </div>
            <p class="answer">
                <?php echo $msg; ?>
            </p>
        </div>

        <div class="welcome" id="add-mag">
            <h2> Add Magazine </h2>
            <div id="info">
                <form action="" method="post">
                    <div class="line">
                        <label for="name"> Name </label>
                        <input type="text" name="name" placeholder="Name">
                    </div>
                    <div class="line">
                        <label for="issue"> Issue </label>
                        <input type="text" name="issue" placeholder="Issue">
                    </div>
                    <div class="line">
                        <label for="barcode"> Bar Code </label>
                        <input type="text" name="barcode" placeholder="Bar Code">
                    </div>
                    <div class="line">
                        <label for="price"> Price </label>
                        <input type="text" name="price" placeholder="Price">
                    </div>
                    <div class="line extra-line">
                        <label for="category"> Category </label>
                        <input id="category-chosen" type="text" name="category" style="display:none;">

                        <div id="dropdown-list">
                            <div class="dropdown closed">
                                <div class="title">Pick Category</div>

                                <div class="dropdown-menu">
                                    <ul id="list">
                                        <li id="design">Design</li>
                                        <li id="social">Social</li>
                                        <li id="illustration">Illustration</li>
                                        <li id="architecture">Architecture</li>
                                        <li id="technology">Technology</li>
                                        <li id="other">Other</li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="line">
                        <label for="quantity"> Quantity </label>
                        <input type="text" name="quantity" placeholder="Quantity">
                    </div>
                    <div class="line">
                        <label for="description"> Description </label>
                        <textarea type="text" name="description" placeholder="Description"></textarea>
                    </div>
                    <div class="button add-button" id="btn-add-mag">
                        <input type="submit" name="btn-submit" value="Add Magazine">
                    </div>
                </form>
            </div>
            <p class="answer">
                <?php echo $msg2; ?>
            </p>
        </div>


        <br>
        <br>
        <br>
        <br>


        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="js/script.js"></script>


        <script type="text/javascript" language="javascript">
            //-- PROFILE --
            var addedusername = <?php echo json_encode($myusername); ?>;
            var username = <?php echo json_encode($login_session); ?>;
            var email = <?php echo json_encode($login_email); ?>;

            /*$(document).ready(function () {
                console.log(addedusername);
                if (addedusername !== null) {
                    window.location.href = window.location;
                }
            });*/


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
    </body>


    </html>