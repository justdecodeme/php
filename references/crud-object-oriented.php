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
?>
