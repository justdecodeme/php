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
  $connection = new mysqli(DB_HOST, DB_USER, DB_PASS);

  if($connection->connect_error) {
    die("ERROR " . $connection->connect_error);
  }

  $query = "CREATE DATABASE mydb2";
  echo $connection->query($query);

  # 3. Create Table
  ##############################
  // $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  //
  // if(!$connection) {
  //   die("ERROR " . mysqli_connect_error());
  // }
  //
  // $query = "
  //   CREATE TABLE `testarea1` (
  //     `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  //     `company` varchar(255) NOT NULL,
  //     `size` int(5) NOT NULL,
  //     `contact` varchar(255) NOT NULL
  //   ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  // ";
  //
  // if(mysqli_query($connection, $query)) {
  //   echo "Table Created";
  // } else {
  //   echo "Something went wrong :(";
  // }

  # 4. Insert
  ##############################
  // $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  //
  // if(!$connection) {
  //   die("ERROR " . mysqli_connect_error());
  // }
  //
  // $query = "INSERT INTO `testarea` ( `company`, `size`, `contact`) VALUES ( 'ACME', '50', 'Mike Smith')";
  //
  // if(mysqli_query($connection, $query)) {
  //   echo "New Entry added";
  // } else {
  //   echo "Something went wrong :(";
  // }
  //
  // mysqli_close($connection);

  # 5. Read
  ##############################
  // $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  //
  // if(!$connection) {
  //   die("ERROR " . mysqli_connect_error());
  // }
  //
  // $query = "SELECT * FROM `testarea`";
  //
  // if($result = mysqli_query($connection, $query)) {
  //   while($row = mysqli_fetch_assoc($result)) {
  //     echo "id:".$row["id"]." company:".$row["company"]."<br>";
  //   }
  // };
  //
  // mysqli_close($connection);

  # 6. Update
  ##############################
  // $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  //
  // if(!$connection) {
  //   die("ERROR " . mysqli_connect_error());
  // }
  //
  // $query = "UPDATE `testarea` SET `company` = 'New Company', `size` = '123', `contact` = 'John Jackson' WHERE `testarea`.`size` = 50";
  //
  // if(mysqli_query($connection, $query)){
  //     echo "was updated";
  // }
  //
  // mysqli_close($connection);

  # 7. Delete
  ##############################
  // $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  //
  // if(!$connection) {
  //   die("ERROR " . mysqli_connect_error());
  // }
  //
  // $query = "DELETE FROM `testarea` WHERE `company` = 'New Company' LIMIT 2";
  //
  // if(mysqli_query($connection, $query)){
  //     echo "Rows affected: " . mysqli_affected_rows($connection);
  // }
  //
  // mysqli_close($connection);
  # 2. Create Table
  // $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  //
  // if ($connection->connect_error) {
  //   die("ERROR " . $connection->connect_error);
  // }
  //
  // $query = "
  // CREATE TABLE `testareb` (
  //   `id` int(12) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  //   `company` varchar(255) NOT NULL,
  //   `size` int(5) NOT NULL,
  //   `contact` varchar(255) NOT NULL
  // ) ENGINE = InnoDB DEFAULT CHARSET=latin1;
  // ";
  //
  // if($connection->connect_error) {
  //   echo "Created Table";
  // } else {
  //   echo "Something went wrong :(" . $connection->error;
  // }
?>
