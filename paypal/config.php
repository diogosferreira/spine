<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "spine";
$contador = 0;

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    //die("Connection failed: " . $conn->connect_error);
    $failed = true;
} else
    $failed = false;


  //start session in all pages
  if (session_status() == PHP_SESSION_NONE) { session_start(); } //PHP >= 5.4.0
  //if(session_id() == '') { session_start(); } //uncomment this line if PHP < 5.4.0 and comment out line above

	// sandbox or live
	define('PPL_MODE', 'sandbox');

	if(PPL_MODE=='sandbox'){
		
		define('PPL_API_USER', 'bz4lacerda-facilitator_api1.gmail.com');
		define('PPL_API_PASSWORD', '3Z29GK6YT2X6NRQ6');
		define('PPL_API_SIGNATURE', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AM2IOl55qk06M5ScFuNJFoZwpGls');
	}
	else{
		
		define('PPL_API_USER', 'bz4lacerda-facilitator_api1.gmail.com');
		define('PPL_API_PASSWORD', '3Z29GK6YT2X6NRQ6');
		define('PPL_API_SIGNATURE', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AM2IOl55qk06M5ScFuNJFoZwpGls');
	}
	
	define('PPL_LANG', 'EN');
	
	define('PPL_LOGO_IMG', 'https://www.paypalobjects.com/webstatic/mktg/Logo/pp-logo-200px.png');
	
	define('PPL_RETURN_URL', $_SERVER["HTTP_REFERER"]);
	define('PPL_CANCEL_URL', $_SERVER["HTTP_REFERER"]);

	define('PPL_CURRENCY_CODE', 'EUR');

?>