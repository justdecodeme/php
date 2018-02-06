<?php
  defined('DB_HOST') or define('DB_HOST', 'localhost');
  defined('DB_USER') or define('DB_USER', 'root');
  defined('DB_PASS') or define('DB_PASS', '');
  defined('DB_NAME') or define('DB_NAME', 'testdb');

  # MySQLi Object Oriented connection

  # 1. Connect to Database
  // $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  //
  // if($connection->connect_error) {
  //   echo "ERROR " . $connection->connect_error;
  // } else {
  //   echo "Connected to Database: " . DB_NAME;
  // }

  # 2. Create Database
  // $connection = new mysqli(DB_HOST, DB_USER, DB_PASS);
  //
  // if($connection->connect_error) {
  //   echo "ERROR " . $connection->connect_error;
  // } else {
  //   echo "Connected";
  // }
  //
  // $query = "CREATE DATABASE mydbc";
  // echo $connection->query($query);

  # 2. Create Table
  $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if ($connection->connect_error) {
    die("ERROR " . $connection->connect_error);
  }
   
  $query = "
  CREATE TABLE `testareb` (
    `id` int(12) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `company` varchar(255) NOT NULL,
    `size` int(5) NOT NULL,
    `contact` varchar(255) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET=latin1;
  ";

  if($connection->connect_error) {
    echo "Created Table";
  } else {
    echo "Something went wrong :(" . $connection->error;
  }  
?>
