<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Image Upload</title>
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data">
		Upload Image:<br>
		<input type="file" name="image"><br>
		<input type="submit" name="submit" value="Upload Image">

	</form>
	<?php 
		if(isset($_POST['submit'])) {
			$image = $_FILES['image']['name'];
			$image_tmp = $_FILES['image']['tmp_name'];

			move_uploaded_file($image_tmp, "images/$image");
			echo "<img src='images/" . $image . "' width='300'";
		}
	 ?>
</body>
</html>