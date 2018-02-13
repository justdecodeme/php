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

	    $user_id = $rows['user_id'];
	    $user_name = $rows['user_name'];
	    $user_email = $rows['user_email'];
	    $user_password = $rows['user_password'];
	    $user_f_name = $rows['user_f_name'];
	    $user_l_name = $rows['user_l_name'];
	    $user_role = $rows['user_role'];
	    $user_gender = $rows['user_gender'];
	    $user_image = $rows['user_image'];
	    $user_phone = $rows['user_phone'];
	    $user_doj = $rows['user_doj'];        

	  // if login is not matched
	  } else {
	    header('Location: login.php');
	  }
	}
	// if session variables are not set
	} else {
	header('Location: login.php');
	}

	$msg = '';
	if(isset($_POST['update_profile'])){
	    $user_id = $_POST['user_id'];
	    $user_name = $_POST['user_name'];
	    $user_email = $_POST['user_email'];
	    $user_f_name = $_POST['user_f_name'];
	    $user_l_name = $_POST['user_l_name'];
	    $user_phone = $_POST['user_phone'];

		if($_FILES['user_image']['name'] != ''){
			$image_name = $_FILES['user_image']['name'];
			$image_tmp = $_FILES['user_image']['tmp_name'];
			$image_size = $_FILES['user_image']['size'];
			$image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
			$image_path = '_assets/images/'.$image_name;
			$image_db_path = $image_name;
			if($image_size < 1000000) {
				if($image_ext == 'jpg' || $image_ext == 'png' || $image_ext == 'gif') {
					if(move_uploaded_file($image_tmp,$image_path)) {
						$up_sql = "UPDATE `users` 
							SET 
							`user_image` = '$image_db_path',
							`user_name` = '$user_name',
							`user_email` = '$user_email',
							`user_f_name` = '$user_f_name',
							`user_l_name` = '$user_l_name',
							`user_phone` = '$user_phone'
							WHERE `user_id` = '$user_id'";

						if(mysqli_query($conn, $up_sql)) {
							//header('Location: edit_post.php?edit_id='.$_POST['id']);
							$msg = 'You&apos;ve Edited the post no. ' . $_POST['user_id'];
						}else {
							$msg = 'The Query Was not Working!';
						}
					}else{
						$msg = 'Sorry, Unfortunately Image hos not been uploaded!';
					}
				} else {
					$msg = 'Image Format was not Correct!';
				}
			} else {
				$msg = 'Image File Size is much bigger then Expect!';
			}
		} else {
			$up_sql = "UPDATE `users` 
				SET 
				`user_name` = '$user_name',
				`user_email` = '$user_email',
				`user_f_name` = '$user_f_name',
				`user_l_name` = '$user_l_name',
				`user_phone` = '$user_phone'
				WHERE `user_id` = '$user_id'";		
			if(mysqli_query($conn, $up_sql)){
				// update session with new details
				$_SESSION['user'] = $_POST['user_email'];
				// header('Location: edit_profile.php');
				$msg = 'Your profile is updated now!';
			}else {
				$msg = 'The Query is not Working!';
			}
		}
	}
?>

<?php include 'includes/header.php' ?>

<h1 style="color: red;"><?php echo $msg; ?></h1>

<h3>Edit <?php echo $user_name; ?> | <a href="xtype.php">Back</a></h3>

<form action="edit_profile.php" method="post" enctype="multipart/form-data">
	<table style="text-align: left; border-collapse: collapse; width: 100%;" border="1">
	  <tr>
	    <th width="50%">Image</th>
	    <td width="50%">
	    	<img src="_assets/images/<?php echo $user_image; ?>" alt="<?php echo $user_image; ?>" width="100">
	    	<input type="file" name="user_image">
	    </td>
	  </tr>
	  <tr>
	    <th>username</th>
	    <td><input type="text" name="user_name" value="<?php echo $user_name; ?>"></td>
	  </tr>
	  <tr>
	    <th>email</th>
	    <td><input type="text" name="user_email" value="<?php echo $user_email; ?>"></td>
	  </tr>
	  <tr>
	    <th>First Name</th>
	    <td><input type="text" name="user_f_name" value="<?php echo $user_f_name; ?>"></td>
	  </tr>
	  <tr>
	    <th>Last Name</th>
	    <td><input type="text" name="user_l_name" value="<?php echo $user_l_name; ?>"></td>
	  </tr>
	  <tr>
	    <th>Phone</th>
	    <td><input type="text" name="user_phone" value="<?php echo $user_phone; ?>"></td>
	  </tr>
	  <tr>
	  	<th><input type="hidden" name="user_id" value="<?php echo $user_id; ?>"></th>
	  	<td><input type="submit" name="update_profile" value="Update Profile"></td>
	  </tr>
	</table>
</form>

<?php include 'includes/footer.php' ?>