<?php 
  defined('DB_HOST') or define('DB_HOST', 'localhost');
  defined('DB_USER') or define('DB_USER', 'root');
  defined('DB_PASS') or define('DB_PASS', '');
  defined('DB_NAME') or define('DB_NAME', 'php_bootcamp');

  # PDO connection

  # 1. Connect to Database
  ##############################
  try {
    // $attrs is optional, this demonstrates using persistent connections,
    // the equivalent of mysql_pconnect
    $attrs = array(PDO::ATTR_PERSISTENT => true);

    $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS, $attrs);

    // the following tells PDO we want it to throw Exceptions for every error.
    // this is far more useful than the default mode of throwing php errors
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    // echo "Connected to Database: " . DB_NAME;
  } catch(PDOException $error) {
    print "Error ". $error->getMessage() ;
    die();
  }
 ?>