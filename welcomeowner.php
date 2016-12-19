<?php
include('session.php');
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
if($_REQUEST['btn-submit']=="Hidden") {
    
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
            $m1 = "Changed password.";
        else 
            $m1 = "Couldn't change password.";
    }

    $msg0 = $m0 . $m1;
    
    $_SESSION['welcomeowner-msg0'] = $msg0;
    $_SESSION['welcomeowner-msg1'] = '';
    $_SESSION['welcomeowner-msg2'] = '';

    echo"<script language='javascript'> window.location.href = 'welcomeowner.php'; </script> ";
            

} else if($_REQUEST['btn-submit']=="Add") {
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
    
    $_SESSION['welcomeowner-msg0'] = '';
    $_SESSION['welcomeowner-msg1'] = $msg;
    $_SESSION['welcomeowner-msg2'] = '';

    echo"<script language='javascript'> window.location.href = 'welcomeowner.php'; </script> ";
 }
}
    
else if($_REQUEST['btn-submit']=="Add Magazine") {
if (isset($_POST['name']) && isset($_POST['issue']) && isset($_POST['barcode']) && isset($_POST['price']) && isset($_POST['category']) && isset($_POST['quantity']) && isset($_POST['description']) && isset($_FILES['magimage'])){
    if(empty($_POST['name']) || empty($_POST['issue']) || empty($_POST['barcode']) || empty($_POST['price']) || empty($_POST['category']) || empty($_POST['quantity']) || empty($_POST['description']) || ($_FILES['magimage']['size'] == 0))
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
        
        
          $errors= array();
          $file_size = $_FILES['magimage']['size'];
          $file_tmp = $_FILES['magimage']['tmp_name'];
          $file_type = $_FILES['magimage']['type'];
          $file_ext=strtolower(end(explode('.',$_FILES['magimage']['name'])));

          $expensions= array("jpeg","jpg","png");

          if(in_array($file_ext,$expensions)=== false){
             $errors[]="Extension not allowed, please choose a JPEG or PNG file. ";
             $m01 ="Extension not allowed, please choose a JPEG or PNG file. ";
          }

          if($file_size > 2097152) {
             $errors[]='File size must be inferior to 2 MB. ';
             $m02 ='File size must be inferior to 2 MB. ';
          }

          
        if(empty($errors)==false) {
            $msg2 = 'Sorry, could not upload image. ' . $m01 . $m02;
        } else if($count3 != 0) {
            $msg2 = 'Sorry, the barcode already exists.';
        } else if($count4 != 0) {
            $msg2 = 'Sorry, the issue for this magazine already exists.';
        } else {
            $directory = $magbarcode . "." . $file_ext;
            $query = "INSERT INTO `RevistaNum` (`codBarras`, `nomeRevista`, `numRevista`, `imgRevista`, `preco`, `quantExistente`, `categoria`, `descricao`) VALUES ('$magbarcode', '$magname', '$magissue', '$directory', '$magprice', '$magquantity', '$magcategory', '$magdescription')";
            $endresult = mysqli_query($conn, $query);
            
            if($endresult){
                $msg2 = "Magazine created successfully!";
                move_uploaded_file($file_tmp,"images/mags/" . $directory);
            }else{
                $msg2 ="Sorry, magazine creation failed.";
            }
        }
    }
    
    $_SESSION['welcomeowner-msg0'] = '';
    $_SESSION['welcomeowner-msg1'] = '';
    $_SESSION['welcomeowner-msg2'] = $msg2;

    echo"<script language='javascript'> window.location.href = 'welcomeowner.php'; </script> ";
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

    <body>
        <div class="barraMenu">
            <header>
                <a href="index.php"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
            </header>


            <nav>
                <ul id="nav-menu">
                    <li> <a href="magazines.php"> Magazines </a></li>
                    <li> <a href="about.php"> About </a></li>
                    <li> <a href="contacts.php"> Contact </a></li>
                    <li> --- </li>
                <li> <a href="#profile"> Profile </a></li>
                <li> <a href="#add-editor"> Add Editor </a></li>
                <li> <a href="#add-mag"> Add Mag </a></li>
                <li> <a href="magazines-editor.php"> Edit Mag </a></li>
            </ul>
                
                <div id="login"> <a href="logout.php">Logout</a></div>
   </nav>
        </div>
        <div class="welcome" id="profile">
            <div id="main">
                <form method="post" enctype="multipart/form-data">
                    <input id="profile-pic" onclick="document.getElementById('profile-pic-button').click();" />
                </form>
                <div id="profile-main">
                    <div id="profile-name"> </div>
                    <input class="button" id="button" type="submit" name="submit" value="Edit" />
                    <!--<input class="button" id="cancel-button" type="submit" name="submit" value="Cancel" />-->
                </div>
            </div>
            <div id="info">
                <form action="" method="post" enctype="multipart/form-data">
                    <input class="changeable" id="profile-pic-button" type="file" name="image" onchange="previewFile()" disabled accept=".jpg, .jpeg, .png"/>
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
            <p class="answer" id="answer0"></p>
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
            <p class="answer" id="answer1"></p>
        </div>

        <div class="welcome" id="add-mag">
            <h2> Add Magazine </h2>
            <div id="info">
                <form action="" method="post" enctype="multipart/form-data">
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
                    <div class="line">
                        <label for="image"> Image </label>
                        <input id="mag-pic" onclick="document.getElementById('mag-pic-button').click();" placeholder="Choose Image"/>
                        <input onchange="pressed()" style="display:none;" id="mag-pic-button" type="file" name="magimage" accept=".jpg, .jpeg, .png"/>
                    </div>
                    <div class="button add-button" id="btn-add-mag">
                        <input type="submit" name="btn-submit" value="Add Magazine">
                    </div>
                </form>
            </div>
            <p class="answer" id="answer2"></p>
        </div>


        <br>
        <br>
        <br>
        <br>


        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="js/script.js"></script>


        <script type="text/javascript" language="javascript">
            //-- PROFILE --
            var pic = <?php echo json_encode($login_pic); ?>;
            var addedusername = <?php echo json_encode($myusername); ?>;
            var username = <?php echo json_encode($login_session); ?>;
            var email = <?php echo json_encode($login_email); ?>;


            //change message when data edited
            var newmsg0 = <?php echo json_encode($_SESSION['welcomeowner-msg0']); ?>;
            var newmsg1 = <?php echo json_encode($_SESSION['welcomeowner-msg1']); ?>;
            var newmsg2 = <?php echo json_encode($_SESSION['welcomeowner-msg2']); ?>;
            if (newmsg0 != null)
                $('#answer0').text(newmsg0);
            if (newmsg1 != null)
                $('#answer1').text(newmsg1);
            if (newmsg2 != null)
                $('#answer2').text(newmsg2);

            setTimeout(function () {
                $('.answer').fadeOut();
            }, 2000);



            $('#profile-name').text(username);
            $('#profile-pic').css("background-image", "url('images/users/"+pic+"')");
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


            //PROFILE PHOTO
            function previewFile() {
                var preview = document.querySelector('#profile-pic'); //selects the query named img
                var file = document.querySelector('#profile-pic-button').files[0]; //sames as here
                var reader = new FileReader();

                reader.onloadend = function () {
                    preview.style.backgroundImage = "url("+reader.result+")";
                }

                if (file) {
                    reader.readAsDataURL(file); //reads the data as a URL
                } else {
                    preview.style.backgroundImage = "url('')";
                }
            }
            
            
            
            //-- MAGAZINES --
            
            function pressed(){
                var a = document.getElementById('mag-pic-button');
                if(a.value == "")
                    $("#mag-pic").attr("placeholder", "Choose Image"); 
                else {
                    var theSplit = a.value.split('\\');
                    var theSplitofSplits = theSplit[theSplit.length-1];
                    $("#mag-pic").attr("placeholder", theSplitofSplits); 
                }
            };            
            
        </script>
    </body>


    </html>