<?php
  require_once('settings.php');
  require_once('connect.php');

  # object oriented
  // if(!$conn) {
  //   die("Connection failed" . mysqli_connect_error());
  // } else {
  //   echo "Connected successfully";
  // }

  # pdo
  if($conn->connect_error) {
    die("Connection failed" . $conn->connect_error());
  } else {
    echo "Connected successfully.<br>";
  }

  # create database
  #################
  // $query = 'CREATE DATABASE `phpcreated`';
  // if(mysqli_query($conn, $query)) {
  //   echo 'Database created<br>';
  // }

  # drop database
  #################
  // $query = 'DROP DATABASE `phpcreated`';
  // if(mysqli_query($conn, $query)) {
  //   echo 'Database deleted<br>';
  // }
  ?>
