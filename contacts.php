<?php 
include('db.php'); 
session_start();

if(!empty($_SESSION['login_user']))
    $user = true;
else
    $user = false;
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
    <link rel="stylesheet" href="css/contacts.css">
</head>

<body class="index">
    <header>
        <a href="index.php"> <img src="images/logo.png" alt="spinelogo" id="logo"> </a>
        <div id="login"> <a href="login.php">Login</a> / <a href="register.php">Register</a></div>
    </header>


    <nav>
        <ul>
            <li> <a href="magazines.php"> Magazines </a></li>
            <li> <a href="about.php"> About </a></li>
            <li> <a href="contacts.php"> Contact </a></li>
        </ul>
    </nav>


    <div id="contacts">
<div class="container">
  <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">                        
      </div>
  </div>
  <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3">
          <form id="contact-form" class="form" action="send.php" method="POST" role="form">
              <div class="form-group">
                  <label class="form-label js-hide-label" for="name">Your Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Your name" tabindex="1" required>
              </div>                            
              <div class="form-group">
                  <label class="form-label js-hide-label" for="email">Your Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" tabindex="2" required>
              </div>                            
              <div class="form-group">
                  <label class="form-label js-hide-label" for="subject">Subject</label>
                  <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" tabindex="3">
              </div>                            
              <div class="form-group">
                  <label class="form-label js-hide-label" for="message">Message</label>
                  <textarea rows="5" cols="50" name="message" class="form-control" id="message" placeholder="Message..." tabindex="4" required></textarea>                                 
              </div>
              <div class="text-center">
                  <button type="submit" class="btn btn-start-order">Send Message</button>
              </div>
          </form>
      </div>
  </div>
</div>
    </div>


    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="js/script.js"></script>
</body>

</html>