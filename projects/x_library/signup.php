<?php session_start();
	include 'includes/db.php';

    # check login status
    #####################

    // if session variables are set redirect user to index.php page
    if(isset($_SESSION['user']) && isset($_SESSION['password'])){
      $sel_sql = "SELECT * FROM users
            WHERE user_email = '$_SESSION[user]'
            AND user_password = '$_SESSION[password]'
            LIMIT 1";
      if($run_sql = mysqli_query($conn, $sel_sql)){
        if(mysqli_affected_rows($conn)) {
          header('Location: index.php');
        }
      }
    }


  if(isset($_POST['submit_signup'])){
		if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['conf_password']) && !empty($_POST['f_name']) && !empty($_POST['l_name'])) {
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
			$l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			$conf_password = mysqli_real_escape_string($conn, $_POST['conf_password']);
			$gender = mysqli_real_escape_string($conn, $_POST['gender']);
      $role = 'subscriber';
      $date = date("Y-m-d H:i:s");

      if($password !== $conf_password) {
        header('Location: signup.php?signup_error=password_error');
      } else {
        $sql = "INSERT INTO `users`
        ( `user_name`, `user_email`, `user_password`, `user_f_name`, `user_l_name`, `user_role`, `user_doj`, `user_gender`)
        VALUES
        ( '$name', '$email', '$password', '$f_name', '$l_name', '$role', '$date', '$gender')";
        if(mysqli_query($conn, $sql)) {
          echo "<h1>User added</h1>";
          // if some query error
        } else {
          header('Location: signup.php?signup_error=query_error');
        }
      }
	    // if any one or more fields is empty
		} else {
			header('Location: signup.php?signup_error=empty');
		}
	}

  	# check signup status
  	#####################

  	$signup_err = '';

  	if(isset($_GET['signup_error'])) {
  		if($_GET['signup_error'] == 'empty') {
  			$signup_err = 'One or more fields are <b>Empty!</b>';
  		} elseif ($_GET['signup_error'] == 'password_error') {
  			$signup_err = 'Your both password didn\'t <b>Match!</b>';
  		} elseif ($_GET['signup_error'] == 'query_error') {
  			$signup_err = 'There is some kind of <b>Database Issue!</b>';
  		}
  	}

?>

<?php include 'includes/header.php' ?>

<main>
  <form action="signup.php" method="post" class="main-form">
    <h1>Create a <b>xType</b> account</h1>

    <?php echo ($signup_err != '' ? '<p class="error">' . $signup_err . '</p>' : ''); ?>

    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="r_kumar">

    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="example@gmail.com">
    
  <!--   <label for="f_name">First Name</label>
    <input type="text" id="f_name" name="email">
    
    <label for="l_name">Last Name</label>
    <input type="text" id="l_name" name="l_name">
    
    <label for="gender">Gender</label>
    <select name="gender" id="gender">
      <option>Gender</option>
      <option value="male">Male</option>
      <option value="female">Female</option>
      <option value="other">other</option>
    </select>
   -->  
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="••••••••••">
    
    <label for="conf_password">Confirm Password</label>
    <input type="password" id="conf_password" name="conf_password" placeholder="••••••••••">
    
    <input class="transition" type="submit" name="submit_signup" value="Sign up">
    <p class="last">Already have an account? <a class="bg-link" href="login.php">Login</a></p>
  </form>  
</main>


<?php include 'includes/footer.php' ?>
