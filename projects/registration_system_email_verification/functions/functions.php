<?php 
############## helper functions ##############

function clean($string) {
	return htmlentities($string);
}

function redirect($location) {
	return header("Location: {$location}");
}

function set_message($message) {
	if(!empty($message)) {
		$_SESSION['message'] = $message;
	} else {
		$message = "";
	}
}

function display_message() {
	if(isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

function token_generator() {
	$token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));

	return $token;
}

function validation_errors($error_message) {
	$error_message = '
	<div class="alert alert-danger alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>'.
	  $error_message .'
	</div>';

	return $error_message;
}

function email_exists($email) {
	$sql = "SELECT id FROM users WHERE email = '$email'";
	$result = query($sql);

	if(row_count($result) == 1) {
		return true;
	} else {
		return false;
	}
}

function username_exists($username) {
	$sql = "SELECT id FROM users WHERE username = '$username'";
	$result = query($sql);

	if(row_count($result) == 1) {
		return true;
	} else {
		return false;
	}
}

############## validation functions ##############

function validate_user_registration() {
	$errors = [];
	$min = 3;
	$max = 20;

	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$first_name			= clean($_POST['first_name']);
		$last_name 			= clean($_POST['last_name']);
		$username 			= clean($_POST['username']);
		$email 				= clean($_POST['email']);
		$password 			= clean($_POST['password']);
		$confirm_password 	= clean($_POST['confirm_password']);

		if(strlen($first_name) < $min) {
			$errors[] = "First name cannot be less than {$min} characters.";
		}
		if(strlen($first_name) > $max) {
			$errors[] = "First name cannot be greater than {$max} characters.";
		}
		if(strlen($last_name) < $min) {
			$errors[] = "Last name cannot be less than {$min} characters.";
		}
		if(strlen($last_name) > $max) {
			$errors[] = "Last name cannot be greater than {$max} characters.";
		}
		if(strlen($username) < $min) {
			$errors[] = "Username cannot be less than {$min} characters.";
		}
		if(strlen($username) > $max) {
			$errors[] = "Username cannot be greater than {$max} characters.";
		}
		if(username_exists($username)) {
			$errors[] = "Sorry Username already exists";
		}
		if(strlen($email) < $min) {
			$errors[] = "Email cannot be less than {$min} characters.";
		}
		if(email_exists($email)) {
			$errors[] = "Sorry Email already exists";
		}
		if($password !== $confirm_password) {
			$errors[] = "Password fields do not match.";
		}

		if(!empty($errors)) {
			foreach ($errors as $error) {
				echo validation_errors($error);	
			}
		} else {
			register_usre($first_name, $last_name, $username, $email, $password);			
			echo "User Registered";
		}
	}
}

function register_usre($first_name, $last_name, $username, $email, $password) {
	$first_name			= escape($first_name);
	$last_name 			= escape($last_name);
	$username 			= escape($username);
	$email 				= escape($email);
	$password 			= escape($password);

	if(email_exists($email)) {
		return false;
	} else if(username_exists($username)) {
		return false;
	} else {
		$password = md5($password);
		$validation_code = md5($username . microtime());
		var_dump($validation_code);

		$sql = "INSERT INTO users(first_name, last_name, username, email, password, validation_code, active)";
		$sql .= " VALUES('$first_name', '$last_name', '$username', '$email', '$password', '$validation_code', 0)";
		$result = query($sql);
		confirm($result);

		return true;
	}
}

?>
