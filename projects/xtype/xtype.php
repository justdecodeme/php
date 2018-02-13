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


<div class="grid_container">
  <!-- Leaderboard -->
  <div class="grid_item">
    <h3>Scoreboard</h3>
    <table style="text-align: left;">
      <tr>
        <th>Errors: </th>
        <td id="totalErrors"></td>
      </tr>
      <tr>
        <th>Characters Typed: </th>
        <td id="totalTyped"></td>
      </tr>
      <tr>
        <th>Gross WPM: </th>
        <td id="grossWPM"></td>
      </tr>
      <tr>
        <th>Net WPM: </th>
        <td id="netWPM"></td>
      </tr>
      <tr>
        <th>Accuracy: </th>
        <td id="accuracy"></td>
      </tr>
    </table>
  </div>

  <!-- Header -->
  <div class="grid_item">
    <h1>
      Welcome to xType:
      <span style="color: green;"><?php echo $_SESSION['user']; ?></span>
      <a href="includes\logout.php">Logout</a>
    </h1>
  </div>

  <!-- Typing area -->
  <div class="grid_item">
    <a id="toggleTypingBtn">Start Typing</a>

    <div id="timerArea">
      <h1 class="display__time-left"></h1>
    </div>

    <div id="progressBar">
      <div id="seekBar"></div>
    </div>

    <div id="typingArea"></div>
  </div>

  <div class="grid_item">
    <h3>Profile</h3>
  </div>
</div>

<script src="_assets/script.min.js" charset="utf-8"></script>

<?php include 'includes/footer.php' ?>
