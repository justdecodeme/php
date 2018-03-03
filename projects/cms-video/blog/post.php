<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>CMS VIDEO</title>

	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">

	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
<body>
	<?php include '../includes/header.php' ?>	

    <div class="jumbotron text-center">
      <h1>CMS Blog</h1>
      <p>The simple blog which makes our life easier</p>
    </div>

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="post">
					<h1>The First Post</h1>
					<p><a href="post.php">date</a> | <a href="post.php">Technology</a> | <a href="post.php">Rakko</a></p>
					<img src="../images/blog.jpg" class="img-fluid">
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis repellat fuga, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, repudiandae eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, repudiandae eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, repudiandae eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, repudiandae eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, repudiandae eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, repudiandae eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, repudiandae praesentiu.
					</p>
					<p>
						<a href="#" class="btn btn-light btn-sm">What is Technology?</a>
						<a href="#" class="btn btn-light btn-sm">How technology works?</a>
						<a href="#" class="btn btn-light btn-sm">Intro to Technology?</a>
					</p>
				</div>
			</div>
			<?php include 'includes/blog-sidebar.php' ?>
		</div>
	</div>

	<?php include '../includes/footer.php' ?>

	<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>