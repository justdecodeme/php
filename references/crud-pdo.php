<?php
  defined('DB_HOST') or define('DB_HOST', 'localhost');
  defined('DB_USER') or define('DB_USER', 'root');
  defined('DB_PASS') or define('DB_PASS', '');
  defined('DB_NAME') or define('DB_NAME', 'testdb');

  # PDO connection

  # 1. Connect to Database
  ##############################
  // try {
  //   $connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
  //   // Error Handling
  //   $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //
  //   echo "Connected to Database: " . DB_NAME;
  //   $connection = null;
  // } catch(PDOException $error) {
  //   print "Error ". $error->getMessage() ;
  //   die();
  // }

  # 2. Create Database
  ##############################
  // try {
  //   $connection = new PDO('mysql:host='.DB_HOST.';', DB_USER, DB_PASS);
  //   // Error Handling
  //   $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //
  //   $query = "CREATE DATABASE mydb5";
  //
  //   $connection->exec($query);
  //   echo "Database Created";
  //
  //   $connection = null;
  // } catch(PDOException $error) {
  //   print "Error ". $error->getMessage() ;
  //   die();
  // }

  # 3. Create Table
  ##############################
  // try {
  //   $connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
  //   // Error Handling
  //   $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //
  //   $query = "
  //     CREATE TABLE `a` (
  //       `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  //       `company` varchar(255) NOT NULL,
  //       `size` int(5) NOT NULL,
  //       `contact` varchar(255) NOT NULL
  //     ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  //   ";
  //
  //   $connection->exec($query);
  //   echo "Table Created";
  //
  //   $connection = null;
  // } catch(PDOException $error) {
  //   print "Error ". $error->getMessage() ;
  //   die();
  // }

  # 4. Insert
  ##############################
  // try {
  //   $connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
  //   // Error Handling
  //   $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //
  //   $connection->beginTransaction();
  //
  //   $querya = "INSERT INTO `testarea` ( `company`, `size`, `contact`) VALUES ( 'My Biz', '99999', 'Mr A')";
  //   $connection->exec($querya);
  //
  //   $queryb = "INSERT INTO `testarea` ( `company`, `size`, `contact`) VALUES ( 'My Biz', '99999', 'Mr B')";
  //   $connection->exec($queryb);
  //
  //   // $connection->rollBack();
  //
  //   $queryc = "INSERT INTO `testarea` ( `company`, `size`, `contact`) VALUES ( 'My Biz', '99999', 'Mr C')";
  //   $connection->exec($queryc);
  //
  //   $connection->commit();
  //
  //   echo "New Entry added";
  //
  //   $connection = null;
  // } catch(PDOException $error) {
  //   print "Error ". $error->getMessage() ;
  //   die();
  // }

  # 5. Read
  ##############################
  // try {
  //   $connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
  //   // Error Handling
  //   $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //
  //   $query = "SELECT * FROM `testarea`";
  //
  //   foreach($connection->query($query) as $row){
  //     echo "id:".$row["id"]." company:".$row["company"]."<br>";
  //   }
  //
  //   $connection = null;
  // } catch(PDOException $error) {
  //   print "Error ". $error->getMessage() ;
  //   die();
  // }

  # 6. Update
  ##############################
  // try {
  //   $connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
  //   // Error Handling
  //   $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //
  //   $query = "UPDATE `testarea` SET `company` ='qwerty', `contact` = 'John Nameless' WHERE size=123";
  //   $result = $connection->exec($query);
  //
  //   if($result) {
  //     echo "Updated: " . $result;
  //   } else {
  //     echo "Nothing Updated";
  //   }
  //
  //   $connection = null;
  // } catch(PDOException $error) {
  //   print "Error ". $error->getMessage() ;
  //   die();
  // }

  # 7. Delete
  ##############################
  // try {
  //   $connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
  //   // Error Handling
  //   $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //
  //   $query = "DELETE FROM `testarea` WHERE `size` = '243' LIMIT 2";
  //   $result = $connection->exec($query);
  //
  //   if($result) {
  //     echo "Deleted: " . $result;
  //   } else {
  //     echo "Nothing Deleted";
  //   }
  //
  //   $connection = null;
  // } catch(PDOException $error) {
  //   print "Error ". $error->getMessage() ;
  //   die();
  // }
?>
