<?php
  defined('DB_HOST') or define('DB_HOST', 'localhost');
  defined('DB_USER') or define('DB_USER', 'root');
  defined('DB_PASS') or define('DB_PASS', '');
  defined('DB_NAME') or define('DB_NAME', 'testdb');

  # Prepared Statements

  # 1. Insert
  ##############################
  try {
    $connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
    // Error Handling
    $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "INSERT INTO `testarea` ( `company`, `size`, `contact`) VALUES (:COMPANY,:SIZE,:CONTACT)";
    $statement = $connection->prepare($query);
    $params = array ('COMPANY'=>'NEW WORLD','SIZE'=>100,'CONTACT'=>'Whatever');
    $statement->execute($params);

    echo "New Entry added";

    $connection = null;
  } catch(PDOException $error) {
    print "Error ". $error->getMessage() ;
    die();
  }
?>
