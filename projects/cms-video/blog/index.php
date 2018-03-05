<?php include 'includes/db.php' ?>
<?php include '../includes/header.php' ?>

<div class="jumbotron text-center blog-main">
  <h1>CMS Blog</h1>
  <p>The simple blog which makes our life easier</p>
</div>

<div class="container">
	<?php include 'includes/blog-nav.php' ?>

	<div class="row">
		<div class="col-md-8">

			<?php 
				// prepare the statement. the place holders allow PDO to handle substituting
				// the values, which also prevents SQL injection
				// $stmt = $pdo->prepare("SELECT * FROM product WHERE productTypeId=:productTypeId AND brand=:brand");
				$stmt = $pdo->prepare("SELECT * FROM blog_data ORDER BY blog_id DESC LIMIT 3");			

				// // bind the parameters
				// $stmt->bindValue(":productTypeId", 6);
				// $stmt->bindValue(":brand", "Slurm");				

				// initialise an array for the results 
				// $blog_post = array();
				if ($stmt->execute()) {
				    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				        // $blog_post[] = $row;
					    $blog_title = ucwords($row['blog_title']);
					    $blog_description = substr($row['blog_description'], 0, 350);
					    $blog_category = strtoupper($row['blog_category']);
					    $blog_author = ucwords($row['blog_author']);
					?>
					<div class="post">
						<h3><?php echo $blog_title; ?></h3>
						<p><a href="post.php"><?php echo $row['blog_date'] ?></a> | 
							<a href="post.php"><?php echo $blog_category ?></a> | 
							<a href="post.php"><?php echo $blog_author ?></a></p>
						<p><?php echo $blog_description; ?>...
							<a href="post.php">Read More</a>
						</p>
						<p>
							<a href="label.php" class="btn btn-light btn-sm">What is Technology?</a>
							<a href="label.php" class="btn btn-light btn-sm">How technology works?</a>
							<a href="label.php" class="btn btn-light btn-sm">Intro to Technology?</a>
						</p>
					</div>
					<?php 
				    }
				}

				// set PDO to null in order to close the connection
				// $pdo = null;
			 ?>

		</div>

		<?php include 'includes/blog-sidebar.php' ?>
	</div>
</div>

<?php include '../includes/footer.php' ?>