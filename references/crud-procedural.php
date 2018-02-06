<?php
  defined('DB_HOST') or define('DB_HOST', 'localhost');
  defined('DB_USER') or define('DB_USER', 'root');
  defined('DB_PASS') or define('DB_PASS', '');
  defined('DB_NAME') or define('DB_NAME', 'testdb');

  # MySQLi Procedural connection

  # 1. Connect to Database
  // $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  //
  // if($connection) {
  //   echo "Connected to Database: " . DB_NAME;
  // } else {
  //   die("ERROR " . mysqli_connect_error());
  // }

  # 2. Create Database
  // $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
  //
  // if($connection) {
  //   echo "Connected";
  // } else {
  //   die("ERROR " . mysqli_connect_error());
  // }
  //
  // $query = "CREATE DATABASE mydba";
  // mysqli_query($connection, $query);

  # 3. Create Table
  $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if (!$connection)
  {
    die("ERROR " . mysqli_connect_error());
  }

  $query = "
  CREATE TABLE `testarea` (
    `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `company` varchar(255) NOT NULL,
    `size` int(5) NOT NULL,
    `contact` varchar(255) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET=latin1;
  ";

  if(mysqli_query($connection, $query)){
      echo "Created Table";
  } else {
      echo "Something went wrong :(";
  }  
?>
