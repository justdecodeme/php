<?php session_start();
	include 'db.php';

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

					header('Location: ../xtype.php');
			    // if fields doesn't match
				} else {
					// echo $get_password;
					header('Location: ../index.php?login_error=wrong');
				}
		    // if some query error
			} else {
				header('Location: ../index.php?login_error=query_error');
			}
	    // if both fields are empty
		} else {
			header('Location: ../index.php?login_error=empty');
		}
	}
?>