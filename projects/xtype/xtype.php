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
				header('Location: index.php');
			}
		}
	// if session variables are not set
	} else {
		header('Location: index.php?login_error=force');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>xType | Login</title>
</head>
<body>
	<!-- echo $email; can also be used -->
	<h2><a href="logout.php">Logout</a></h2>
	<h1>Welcome to xType: <span style="color: green;"><?php echo $_SESSION['user']; ?></span></h1> 

</body>
</html>