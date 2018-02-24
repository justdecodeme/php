<?php
  defined('DB_HOST') or define('DB_HOST', 'localhost');
  defined('DB_USER') or define('DB_USER', 'root');
  defined('DB_PASS') or define('DB_PASS', '');
  defined('DB_NAME') or define('DB_NAME', 'testdb');

  # MySQLi Object Oriented connection

  # 1. Connect to Database
  ##############################
  // $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  //
  // if($connection->connect_error) {
  //   echo "ERROR " . $connection->connect_error;
  // } else {
  //   echo "Connected to Database: " . DB_NAME;
  // }

  # 2. Create Database
  ##############################
  // $connection = new mysqli(DB_HOST, DB_USER, DB_PASS);
  //
  // if($connection->connect_error) {
  //   die("ERROR " . $connection->connect_error);
  // }
  //
  // $query = "CREATE DATABASE mydb3";
  //
  // if($connection->query($query)) {
  //   echo "Database Created";
  // } else {
  //   echo "Something went wrong :(";
  // }

  # 3. Create Table
  ##############################
  // $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  //
  // if($connection->connect_error) {
  //   die("ERROR " . $connection->connect_error);
  // }
  //
  // $query = "
  //   CREATE TABLE `testarea3` (
  //     `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  //     `company` varchar(255) NOT NULL,
  //     `size` int(5) NOT NULL,
  //     `contact` varchar(255) NOT NULL
  //   ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  // ";
  //
  // if($connection->query($query)) {
  //   echo "Table Created";
  // } else {
  //   echo "Something went wrong :(";
  // }

  # 4. Insert
  ##############################
  // $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  //
  // if($connection->connect_error) {
  //   die("ERROR " . $connection->connect_error);
  // }
  //
  // $query = "INSERT INTO `testarea` ( `company`, `size`, `contact`) VALUES ( 'ACME', '50', 'Mike Smith')";
  // // $query = "INSERT INTO `testarea` ( `company`, `size`, `contact`) VALUES ( 'ACME', '50', 'Mike Smith')";
  //
  // $result = $connection->query($query);
  // // $result = $connection->multi_query($query);
  //
  // if($result) {
  //   echo "New Entry added: " . $result;
  // } else {
  //   echo "error " . $connection->error;
  // }

  # 5. Read
  ##############################
  // $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  //
  // if($connection->connect_error) {
  //   die("ERROR " . $connection->connect_error);
  // }
  //
  // $query = "SELECT * FROM `testarea`";
  // $result = $connection->query($query);
  // echo $result->num_rows;
  // if($result) {
  //   while($row = $result->fetch_assoc()) {
  //     echo "id:".$row["id"]." company:".$row["company"]." contact:".$row["contact"]."<br>";
  //   }
  // } else {
  //     echo "error " . $connection->error;
  // }

  # 6. Update
  ##############################
  // $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  //
  // if($connection->connect_error) {
  //   die("ERROR " . $connection->connect_error);
  // }
  //
  // $query = "UPDATE `testarea` SET `company` = 'New Company', `size` = '123', `contact` = 'John Jackson' WHERE `testarea`.`size` = 50";
  //
  // if($connection->query($query)) {
  //   echo "Updated";
  // } else {
  //   echo "error " . $connection->error;
  // }

  # 7. Delete
  ##############################
  // $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  //
  // if($connection->connect_error) {
  //   die("ERROR " . $connection->connect_error);
  // }
  //
  // $query = "DELETE FROM `testarea` WHERE id = 11";
  //
  // if($connection->query($query)) {
  //   echo "Deleted";
  // } else {
  //   echo "error " . $connection->error;
  // }
?>
