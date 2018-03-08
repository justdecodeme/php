<?php
  // if session variables are set
  if(isset($_SESSION['user']) && isset($_SESSION['password'])){
    $sel_sql = "SELECT * FROM users
          WHERE user_email = '$_SESSION[user]'
          AND user_password = '$_SESSION[password]'
          LIMIT 1";

    if($run_sql = mysqli_query($conn, $sel_sql)){
      if(mysqli_affected_rows($conn)) {
        $rows = mysqli_fetch_assoc($run_sql);

        $email = $rows['user_email'];
        $image = $rows['user_image'];

      // if login is not validated
      } else {
        header('Location: login.php');
      }
    }
  // if session variables are not set
  } else {
    header('Location: login.php');
  }
 ?>
