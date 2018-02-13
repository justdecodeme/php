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

        $email = $rows['user_email'];

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

<h1>
  Welcome to xType: 
  <span style="color: green;"><?php echo $_SESSION['user']; ?></span>
  <a href="includes\logout.php">Logout</a>
</h1> 

<a id="toggleTypingBtn">Start Typing</a>

<div id="timerArea">
  <h1 class="display__time-left"></h1>
</div>

<div id="progressBar">
  <div id="seekBar"></div>
</div>

<!-- container for letters -->
<div id="typingArea"></div> <!-- {1} -->

<script src="_assets/script.min.js" charset="utf-8"></script>

<?php include 'includes/footer.php' ?>