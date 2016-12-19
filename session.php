<?php
   include('config.php');
    session_start();

    //-- SELECT USER CARACTERISTICS --

   $user_check = $_SESSION['login_user'];
   
    if(empty($user_check))
        header('login.php');

    
   $ses_sql = $conn->query("select * from Utilizador where userName = '$user_check' or userEmail = '$user_check'");
   
   $ses_row = $ses_sql->fetch_assoc();
   
   $login_pic = $ses_row['userImage'];
   $login_session = $ses_row['userName'];
   $login_email = $ses_row['userEmail'];
   $login_password = $ses_row['userPassword'];
   $login_nif = $ses_row['nif'];
   $login_address = $ses_row['morada'];
   $login_type = $ses_row['dono'];


    $_SESSION['login_username'] = $login_session;
    $_SESSION['login_usertype'] = $login_type;

    //-- SELECT USER MESSAGES --

   $result = $conn->query("select * from Utilizador_Msg where userName = '$login_session' ORDER BY `date` ASC ");

    $contador=0;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $didi[$contador] = array("message"=>$row["message"], "date"=>$row["date"]);

            $contador++;
        }
    } else {
        //echo "0 results";
    }





?>