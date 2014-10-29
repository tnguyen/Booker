<?php
  /**
    lib/core.php - common code to be included in every page.
    This library connects to the database and starts the session.
  **/


//Display PHP Errors (Used for Debugging and Development)
  ini_set('display_errors',1);
  ini_set('display_startup_errors',1);
  error_reporting(-1);

//Directory Variable used to handle difficulty in directory linking on localhost
  $directory = $_SERVER['DOCUMENT_ROOT'] . "/booker/real_system/"; 


// Expiry Time for Cookies.
  $expiry = time() + (60*60*24);

// ReCaptcha Properties
  $publickey = "6Lf_ufwSAAAAAHI2NOzKjIBZsEiMhIhG4q6B-_Re";
  $privatekey = "6Lf_ufwSAAAAALj2xh6s2SxMFu_16xG1MEkojGLL";
  # the response from reCAPTCHA
  $resp = null;
  # the error code from reCAPTCHA, if any
  $error = null;

  // A function to enable HTTPS if it isn't on
  function forceHTTPS()
  {
    $httpsURL = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if(!isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] !== 'on')
    {
      header("Location: $httpsURL");
      die();
    }
  }

  // A function to disable HTTPS if it is on
  function forceHTTP()
  {
    $httpURL = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if(isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'on')
    {
      header("Location: $httpURL");
      die();
    }
  }

  // Make sure the timezone is GMT for the date() function
  date_default_timezone_set("GMT");

  // Include Error Handler
  include($directory . "functions/errors.php");


  // Create a new DB class and run the init routine
  include($directory . "classes/database.php");

  $db = new database;
  $db->initiate();

?>