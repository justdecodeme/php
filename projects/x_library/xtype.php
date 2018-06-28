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
<div id="loaderOuter">
  <div class="loader">
    <svg width="100" height="100" viewBox="0 0 600 600">
        <path class="a" d="M410 140 L180 340" id="a"/>
        <path class="b" d="M140 340c-64.06-12.7-96.45-46.03-97.17-100-.73-53.97 31.66-87.3 97.17-100" id="b"/>
        <path class="c" d="M180 142 L410 340" id="c"/>
        <path class="d" d="M462.39 340c65.94-11.97 98.48-45.31 97.61-100-.87-54.69-35.94-88.03-105.22-100" id="d"/>
    </svg>
  </div>  
</div>
<div class="grid_container" id="contents">
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
    <br>
    <table style="text-align: left; border-collapse: collapse; width: 100%;" border="1">
      <thead>
        <tr>
          <th>User Name</th>
          <th>Highest WPM</th>
        </tr>
      </thead>
      <tbody id="leaderboard">
        <?php
          $query = "SELECT * FROM `users` ORDER BY `user_highest_wpm` DESC";

          if($result = mysqli_query($conn, $query)) {
            while($row = mysqli_fetch_assoc($result)) {
              echo "<tr><td>$row[user_name]</td><td>$row[user_highest_wpm]</td></tr>";
            }
          };
         ?>
      </tbody>
    </table>
  </div>

  <!-- Header -->
  <div class="grid_item">
    <h1>
      Welcome to xType:
      <span style="color: green;"><?php echo $_SESSION['user']; ?></span>
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

  <!-- Profile -->
  <div class="grid_item">
    <h3>Profile </h3>
    <h4>
      <a href="edit_profile.php">Edit</a> |
      <a href="includes\logout.php">Logout</a>
    </h4>

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
