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


<div class="grid_container">
  <!-- Leaderboard -->
  <div class="grid_item">
    <h3>Scoreboard</h3>
    <table style="text-align: left; border-collapse: collapse; width: 100%;" border="1">
      <tr>
        <th>Errors: </th>
        <td id="totalErrors" width="30"></td>
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
    <h3>Profile <a href="edit_profile.php">Edit</a></h3>

    <table style="text-align: left; border-collapse: collapse; width: 100%;" border="1">
      <tr>
        <th width="50%">Image</th>
        <td width="50%"><img src="_assets/images/<?php echo $user_image; ?>" alt="<?php echo $user_image; ?>" width="100"></td>
      </tr>
      <tr>
        <th>First Name</th>
        <td><?php echo $user_f_name; ?></td>
      </tr>
      <tr>
        <th>Last Name</th>
        <td><?php echo $user_l_name; ?></td>
      </tr>
      <tr>
        <th>username</th>
        <td><?php echo $user_name; ?></td>
      </tr>
      <tr>
        <th>email</th>
        <td><?php echo $user_email; ?></td>
      </tr>
      <tr>
        <th>password</th>
        <td><?php echo $user_password; ?></td>
      </tr>
      <tr>
        <th>Phone</th>
        <td><?php echo $user_phone; ?></td>
      </tr>
      <tr>
        <th>Role</th>
        <td><?php echo $user_role; ?></td>
      </tr>
      <tr>
        <th>Date of Joining</th>
        <td><?php echo $user_doj; ?></td>
      </tr>
      <tr>
        <th>Gender</th>
        <td><?php echo $user_gender; ?></td>
      </tr>
    </table>
  </div>
</div>

<script src="_assets/script.min.js" charset="utf-8"></script>

<?php include 'includes/footer.php' ?>
