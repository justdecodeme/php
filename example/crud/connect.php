<?php
  # Initializes a database connection
  ###################################

  # object oriented
  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
  mysqli_select_db($conn, DB_NAME);

  # pdo
  // $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
 ?>
