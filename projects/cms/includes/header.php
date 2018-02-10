<!DOCTYPE html>
<html>
	<head>
		<title>CMS System</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>		
	</head>
	<body>
<header class="navbar navbar-inverse navbar-static-top" >
	<div class="container">
		<a href="index.php" class="navbar-brand">CMS System</a>
		<ul class="nav navbar-nav navbar-right">
			
			<?php
				// Make navigation and add class as per active page

				// add active class if this page is index.php (home) page
				$class = $_SERVER['PHP_SELF'] == '/projects/cms/index.php' ? 'active' : '';
				echo '<li class="' . $class .'"><a href="index.php">Home</a>';
				
				// add active class to category if selected
				$sel_cat = "SELECT * FROM category";
				$run_cat = mysqli_query($conn, $sel_cat);
				while($rows = mysqli_fetch_assoc($run_cat)) {
					if(isset($_GET['cat_id'])) {
						$class = $_GET['cat_id'] == $rows['c_id'] ? 'active' : '';
					} else {
						$class='';
					}
					echo '<li class="'.$class.'"><a href="menu.php?cat_id='.$rows['c_id'].'">'.ucfirst($rows['category_name']).'</a></li>';
				}

				// add active class if this page contact or registration page
				$class = $_SERVER['PHP_SELF'] == '/projects/cms/contact.php' ? 'active' : '';
				echo '<li class="' . $class .'"><a href="contact.php">Contact Us</a>';
				$class = $_SERVER['PHP_SELF'] == '/projects/cms/registration.php' ? 'active' : '';
				echo '<li class="' . $class .'"><a href="registration.php">Registration</a>';
			?>
		</ul>
	</div>
</header>