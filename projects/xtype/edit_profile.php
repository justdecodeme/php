<?php session_start();
  include 'includes/db.php';

  # check login status
  #####################

  // if session variables are set
  if(isset($_SESSION['user']) && isset($_SESSION['password'])){
    $sel_sql = "SELECT * FROM users
         		WHERE user_email = '$_SESSION[user]'
                AND user_password = '$_SESSION[password]'
                LIMIT 1";

    if($run_sql = mysqli_query($conn, $sel_sql)){
      if(mysqli_affected_rows($conn)) {
        $rows = mysqli_fetch_assoc($run_sql);

        $user_name = $rows['user_name'];
        $user_email = $rows['user_email'];
        $user_password = $rows['user_password'];
        $user_f_name = $rows['user_f_name'];
        $user_l_name = $rows['user_l_name'];
        $user_role = $rows['user_role'];
        $user_gender = $rows['user_gender'];
        $user_image = $rows['user_image'];
        $user_phone = $rows['user_phone'];
        $user_doj = $rows['user_doj'];        

      // if login is not matched
      } else {
        header('Location: login.php');
      }
    }
  // if session variables are not set
  } else {
    header('Location: login.php');
  }
?>

<?php include 'includes/header.php' ?>

<?php include 'includes/footer.php' ?>