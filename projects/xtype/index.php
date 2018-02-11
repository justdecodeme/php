<?php session_start();
	include 'includes/db.php';
	
	// if(isset($_SESSION['user']) && isset($_SESSION['password'])) {
	// 	echo "<p>Logedin as: " . $_SESSION['user'] . '</p>';
	// }

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
		} elseif ($_GET['login_error'] == 'force') {
			$login_err = 'You can access through <b>Login form only!</b>';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>xType | Login</title>
</head>
<body>
	<p style="color: red;"><?php echo $login_err; ?></p>
	<h1>Login to xType</h1>

	<form action="login.php" method="post">
		<input type="email"  name="user_email" placeholder="email">
		<input type="password"  name="password" placeholder="password">
		<input type="submit" name="submit_login" value="Login">
	</form>

</body>
</html>