<?php
  defined('DB_HOST') or define('DB_HOST', 'localhost');
  defined('DB_USER') or define('DB_USER', 'root');
  defined('DB_PASS') or define('DB_PASS', '');
  defined('DB_NAME') or define('DB_NAME', 'x_apps');

  # 1. Connect to Database
  ##############################
  try {
    $connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);

    // Error Handling (set the PDO error mode to exception)
    $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Connected to Database: " . DB_NAME;
    
    // $connection = null;
  } catch(PDOException $exception) {
    print "Exception ". $exception->getMessage() ;
    die();
  }
 ?>
