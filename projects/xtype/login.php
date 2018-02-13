<?php session_start();
	include 'includes/db.php';

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

<p style="color: red;"><?php echo $login_err; ?></p>
<h1>Login to xType</h1>

<form action="login.php" method="post">
	<input type="email"  name="user_email" placeholder="email">
	<input type="password"  name="password" placeholder="password">
	<input type="submit" name="submit_login" value="Login">
</form>

<?php include 'includes/footer.php' ?>