<?php
  require_once('settings.php');
  require_once('connect.php');

  # MySQLi Object Oriented connection
  ###################################
  if(!$conn) {
    die("Connection failed" . mysqli_connect_error());
  } else {
    echo "Connected successfully.<br>";
  }

  # PDO connection
  ################
  // if($conn->connect_error) {
  //   die("Connection failed" . $conn->connect_error());
  // } else {
  //   echo "Connected successfully.<br>";
  // }

  # create database
  #################
  // $query = 'CREATE DATABASE `phpcreated`';
  // if(mysqli_query($conn, $query)) {
  //   echo 'Database created.<br>';
  // }

  # drop database
  ###############
  // $query = 'DROP DATABASE `phpcreated`';
  // if(mysqli_query($conn, $query)) {
  //   echo 'Database deleted.<br>';
  // }

  # create table
  ##############
  // $query = 'CREATE TABLE Persons (
  //   PersonID int,
  //   LastName varchar(255),
  //   FirstName varchar(255),
  //   Address varchar(255),
  //   City varchar(255)
  // )';
  // if(mysqli_query($conn, $query)) {
  //   echo 'Table created.<br>';
  // }

  # read
  ######
  $query = 'SELECT * FROM user';
  $result = $conn->query($query);
  echo $result->num_rows;
  if($result) {
    while($row = $result->fetch_assoc()) {
      echo $row["name"]."<br>";
    }
  } else {
      echo "error " . $conn->error;
  }

  # close connection
  ##################
  mysqli_close($conn);
  ?>
