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
?>
