<?php
include("config.php");
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_REQUEST['btn-submit']=="Add"){
        
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
    }
    
?>
