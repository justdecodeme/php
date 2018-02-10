<?php session_start();
	include '../includes/db.php';
	if(isset($_POST['submit_login'])){
		if(!empty($_POST['user_name']) && !empty($_POST['password'])){
			$get_user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
			$get_password = mysqli_real_escape_string($conn, $_POST['password']);
			
			echo $get_user_name . '<br>';
			echo $get_password . '<br>';

			$sql = "SELECT * FROM users WHERE user_email = '$get_user_name' AND user_password = '$get_password'";

			if($result = mysqli_query($conn, $sql)) {
				if(mysqli_affected_rows($conn)) {
					$rows = mysqli_fetch_assoc($result);

					$_SESSION['user'] = $get_user_name;
					$_SESSION['password'] = $get_password;
					$_SESSION['role'] = $rows['role'];
					header('Location: ../admin/index.php');
			    // if fields doesn't match
				} else {
					header('Location: ../index.php?login_error=wrong');
				}
		    // if some query error
			} else {
				header('Location: ../index.php?login_error=query_error');
			}
	    // if both fields are empty
		} else {
				echo "7<br>";
			header('Location: ../index.php?login_error=empty');
		}
	}
?>