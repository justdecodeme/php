<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Filters</title>
</head>
<body>
	<form action="" method="post">
		<input type="text" placeholder="email" name="email">
		<br>
		<input type="text" placeholder="url" name="url">
		<br>
		<input type="submit" name="submit" value="Submit">
	</form>

	<?php 
		if(isset($_POST['submit'])) {
			$email = $_POST['email'];
			$url = $_POST['url'];

			if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo '<h2>Email is valid</h2>';
			} else {
				echo '<h2>Email is not valid</h2>';
			}

			if(filter_var($url, FILTER_VALIDATE_URL)) {
				echo '<h2>URL is valid</h2>';
			} else {
				echo '<h2>URL is not valid</h2>';
			}
		}

	 ?>
</body>
</html>