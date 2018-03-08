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

	if(isset($_POST['submit_login'])){
		if(!empty($_POST['user_email']) && !empty($_POST['password'])){
			$get_user_name = mysqli_real_escape_string($conn, $_POST['user_email']);
			$get_password = mysqli_real_escape_string($conn, $_POST['password']);

			// echo $get_user_name;

			$sql = "SELECT * FROM users
					WHERE user_email = '$get_user_name'
					AND user_password = '$get_password'
					LIMIT 1";

			if($result = mysqli_query($conn, $sql)) {
				if(mysqli_affected_rows($conn)) {
					$rows = mysqli_fetch_assoc($result);

					$_SESSION['user'] = $get_user_name;
					$_SESSION['password'] = $get_password;

					header('Location: xtype.php');
			    // if fields doesn't match
				} else {
					// echo $get_password;
					header('Location: login.php?login_error=wrong');
				}
		    // if some query error
			} else {
				header('Location: login.php?login_error=query_error');
			}
	    // if both fields are empty
		} else {
			header('Location: login.php?login_error=empty');
		}
	}

	# check login status
	#####################

	$login_err = '';

	if(isset($_GET['login_error'])) {
		if($_GET['login_error'] == 'empty') {
			$login_err = 'User name or Password was <b>Empty!</b>';
		} elseif ($_GET['login_error'] == 'wrong') {
			$login_err = 'User name or Password was <b>Wrong!</b>';
		} elseif ($_GET['login_error'] == 'query_error') {
			$login_err = 'There is some kind of <b>Database Issue!</b>';
		}
	}
?>

<?php include 'includes/header.php' ?>

<main>
	<form action="login.php" method='post' class="main-form">
		<h1>Log in to <b>xType</b></h1>

		<?php echo ($login_err != '' ? '<p class="error">' . $login_err . '</p>' : ''); ?>

		<label for="email">Email</label>
		<input type="text" id="email" name="user_email" placeholder="example@gmail.com">
		
		<label for="password">Password</label>
		<input type="password" id="password" name="password" placeholder="••••••••••"> <br>
		
		<!-- <input type="checkbox" id="remember" name="remember" value="yes"> -->
		<!-- <label for="remember">Remember Me</label> -->

		<input class="transition" type="submit" name="submit_login" value="Login">
		<p class="last">Don’t have an account? <a class="bg-link" href="signup.php">Signup</a></p>
	</form>
</main>

<?php include 'includes/footer.php' ?>
