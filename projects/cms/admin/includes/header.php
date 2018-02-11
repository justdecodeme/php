<!DOCTYPE html>
<html>
	<head>
		<title>Admin | CMS System</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery-3.3.1.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>	
		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>		
		<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
		<script>tinymce.init({selector:'textarea#description'});</script>
		<style>
			body {
				padding: 60px 0;
			}
		</style>
	</head>
	<body>

<header class="navbar navbar-default navbar-fixed-top" >
	<div class="container">
		<a href="index.php" class="navbar-brand">CMS System</a>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="index.php">Home</a></li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['user'] ?>
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="profile.php"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
				  <li><a href="../accounts/logout.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
				</ul>
			</li>			
			
		</ul>
	</div>
</header>
