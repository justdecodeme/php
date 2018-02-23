<?php session_start();
	include 'includes/db.php';

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
        // if logged in then go to index page otherwise show signup form
        header('Location: index.php');
			}
		}
	}
?>

<?php include 'includes/header.php' ?>

<p style="color: red;"><?php echo $signup_err; ?></p>

<h1>Signup to xType | <a href="login.php">Login</a></h1>

<form action="signup.php" method="post">
	<input type="text" name="name" placeholder="username"><br>
	<input type="email" name="email" placeholder="email"><br>
	<input type="text" name="f_name" placeholder="first name"><br>
	<input type="text" name="l_name" placeholder="last name"><br>
	<input type="password" name="password" placeholder="password"><br>
	<input type="password" name="conf_password" placeholder="conform password"><br>
  <select name="gender">
    <option>Gender</option>
    <option value="male">Male</option>
    <option value="female">Female</option>
    <option value="other">other</option>
  </select><br>
	<input type="submit" name="submit_signup" value="Sign up">
</form>

<?php include 'includes/footer.php' ?>
