<?php session_start();
	include 'includes/db.php';
	
	// if session variables are set
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$sel_sql = "SELECT * FROM users WHERE user_email = '$_SESSION[user]' AND user_password = '$_SESSION[password]' LIMIT 1";

		if($run_sql = mysqli_query($conn, $sel_sql)){
			if(mysqli_affected_rows($conn)) {
				$rows = mysqli_fetch_assoc($run_sql);

				// if role is not admin 
				if($rows['role'] != 'admin') {
					header('Location:../index.php');
				}
			// if login is not matched
			} else {
				header('Location:../index.php');
			}
		}
	// if session variables are not set
	} else {
		header('Location:../index.php');
	}	

	$error = '';
	if(isset($_POST['submit_post'])){
		$title = strip_tags($_POST['title']);
		$date = date('Y-m-d h:i:s');
		// if image name is not empty (if some image is selected)
		if($_FILES['image']['name'] != ''){
			$image_name = $_FILES['image']['name'];
			$image_tmp = $_FILES['image']['tmp_name'];
			$image_size = $_FILES['image']['size'];
			$image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
			$image_path = '../images/'.$image_name;
			$image_db_path = 'images/'.$image_name;
			
			if($image_size < 1000000){
				if($image_ext == 'jpg' || $image_ext == 'png' || $image_ext == 'gif'){
					if(move_uploaded_file($image_tmp,$image_path)){
						$ins_sql = "INSERT INTO posts (title, description, image, category, status, date, author) VALUES ('$title', '$_POST[description]', '$image_db_path', '$_POST[category]', '$_POST[status]', '$date', '$_SESSION[user]')";
						if(mysqli_query($conn,$ins_sql)){
							header('Location: post_list.php');
						}else {
							$error = '<div class="alert alert-danger">The Query Was not Working!</div>';
						}
					}else{
						$error = '<div class="alert alert-danger">Sorry, Unfortunately Image hos not been uploaded!</div>';
					}
					
				} else {
					$error = '<div class="alert alert-danger">Image Format was not Correct!</div>';
				}
				
			} else {
				$error = '<div class="alert alert-danger">Image File Size is much bigger then Expect!</div>';
			}
		// if no image is selected
		} else {
			$ins_sql = "INSERT INTO posts (title, description, category, status, date, author) VALUES ('$title', '$_POST[description]', '$_POST[category]', '$_POST[status]', '$date', '$_SESSION[user]')";
			if(mysqli_query($conn,$ins_sql)){
				header('Location: post_list.php');
			}else {
				$error = '<div class="alert alert-danger">The Query Was not Working!</div>';
			}
		}
	}
?>

<?php include 'includes/header.php';?>


<div class="container-fluid">
		
	<?php echo $error; include 'includes/sidebar.php';?>
	
	<div class="col-lg-10">
		<div class="page-header"><h1>New Post</h1></div>

		<form class="form-horizontal" action="new_post.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="image">Upload an Image</label>
				<input id="image" type="file" name="image" class="btn btn-primary">
			</div>
			<div class="form-group">
				<label for="title">Title</label>
				<input id="title" type="text" name="title" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="category">Category</label>
				<select id="category" name="category" class="form-control" required>
					<option value="">Select Any Category</option>
					<?php
						$sel_sql = "SELECT * FROM category";
						$run_sql = mysqli_query($conn,$sel_sql);
						while($rows = mysqli_fetch_assoc($run_sql)){
							if($rows['category_name'] == 'home'){
								continue;
							}
							echo '<option value="'.$rows['c_id'].'">'.ucfirst($rows['category_name']).'</option>';
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea id="description" name="description"></textarea>
			</div>
			<div class="form-group">
				<label for="status">Status</label>
				<select id="status" name="status" class="form-control">
					<option value="draft">Draft</option>
					<option value="publish">Publish</option>
				</select>
			</div>
			<div class="form-group">
				<input type="submit" name="submit_post" class="btn btn-danger btn-block">
			</div>
		</form>
	</div>
	
</div>
<?php include 'includes/footer.php';?>