<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CRUD</title>
	<style>
		h1 {
			text-align: center;
		}
	</style>
</head>
<body>
	<h1>CRUD</h1>

	<form action="" method="post">
		<input type="text" name="name" placeholder="name"><br>
		<input type="email" name="email" placeholder="email"><br>
		<input type="password" name="password" placeholder="password"><br>
		<input type="submit" name="submit" value="Submit">
	</form>
	<h3><a href="crud.php?view">View Users</a></h3>

	<?php 
		defined('DB_HOST') or define('DB_HOST', 'localhost');
		defined('DB_USER') or define('DB_USER', 'root');
		defined('DB_PASS') or define('DB_PASS', '');
		defined('DB_NAME') or define('DB_NAME', 'mytest');

		# 1. Connect to Database
		##############################
		$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		if($connection) {
		  echo "Connected to Database: " . DB_NAME . "<br>";
		} else {
		  die("ERROR " . mysqli_connect_error());
		}	

		# 2. Read
		#############################
		if(isset($_GET['view'])) {
			$query = "SELECT * FROM `users`";
			
		  	echo "
			  	<table border='1' cellpadding='10'>
			  		<tr>
			  			<th>id</th>
			  			<th>name</th>
			  			<th>email</th>
			  			<th>password</th>
			  		</tr>
		  	";

			if($result = mysqli_query($connection, $query)) {
			  while($row = mysqli_fetch_assoc($result)) {
			  	$id = $row['id'];
			  	$name = $row['name'];
			  	$email = $row['email'];
			  	$password = $row['password'];

			  	echo "
			  		<tr>
			  			<td>$id</td>
			  			<td>$name</td>
			  			<td>$email</td>
			  			<td>$password</td>
			  			<td><a href='crud.php?del=$id'>Delete</a></td>
			  			<td><a href='crud.php?edit=$id'>Edit</a></td>
			  		</tr>
			  	";
			  }
			};
		  	echo "
			  	</table>
		  	";
		}
		
		# 3. Insert
		##############################
		if(isset($_POST['submit'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];

			$query = "INSERT INTO `users` 
			( `name`, `email`, `password`) VALUES 
			( '$name', '$email', '$password')";
	
			if(mysqli_query($connection, $query)) {
			  echo "<script>alert('User added')</script>";
			  echo "<script>window.open('crud.php?view', '_self')</script>";
			} else {
			  echo "Something went wrong :(";
			}
		}

		# 4. Delete
		##############################
		if(isset($_GET['del'])) {
			$del_id = $_GET['del'];

			$query = "DELETE FROM `users` WHERE `id` = '$del_id' LIMIT 1";
	
			if(mysqli_query($connection, $query)) {
			  echo "<script>alert('User deleted')</script>";
			  echo "<script>window.open('crud.php?view', '_self')</script>";
			} else {
			  echo "Something went wrong :(";
			}
		}

		# 5. Edit
		##############################
		if(isset($_GET['edit'])) {
			$edit_id = $_GET['edit'];

			$query = "SELECT * FROM `users` WHERE id = '$edit_id'";
	
			if($result = mysqli_query($connection, $query)) {
				while($row = mysqli_fetch_assoc($result)) {
					$id = $row['id'];
					$name = $row['name'];
					$email = $row['email'];
					$password = $row['password'];			

					echo "
						<form action='' method='post'>
							<input type='text' name='name' value='$name'><br>
							<input type='email' name='email' value='$email'><br>
							<input type='password' name='password' value='$password'><br>
							<input type='submit' name='update' value='Update'>
						</form>
					";  
				}
			};	
  		}

		# 6. Update
		##############################
		if(isset($_POST['update'])) {
			$update_id = $_GET['edit'];

			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];

			$query = "UPDATE `users` 
			SET 
			`name` = '$name', 
			`email` = '$email', 
			`password` = '$password' 
			WHERE 
			`users`.`id` = '$update_id'";
	
			if(mysqli_query($connection, $query)) {
			  echo "<script>alert('User updated')</script>";
			  echo "<script>window.open('crud.php?view', '_self')</script>";
			} else {
			  echo "Something went wrong :(";
			}
		}


	 ?>
</body>
</html>