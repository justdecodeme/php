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
				$stmt = $pdo->prepare("SELECT * FROM blog_data");			

				// // bind the parameters
				// $stmt->bindValue(":productTypeId", 6);
				// $stmt->bindValue(":brand", "Slurm");				

				// initialise an array for the results 
				// $blog_post = array();
				if ($stmt->execute()) {
				    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				        // $blog_post[] = $row;
					    echo "id:".$row["blog_id"]." category:".$row["blog_category"]."<br>";
				    }
				}

				// set PDO to null in order to close the connection
				$pdo = null;
			 ?>

			<div class="post">
				<h1>The First Post</h1>
				<p><a href="post.php">date</a> | <a href="post.php">Technology</a> | <a href="post.php">Rakko</a></p>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis repellat fuga, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, repudiandae praesentiu... <a href="post.php">Read More</a>
				</p>
				<p>
					<a href="label.php" class="btn btn-light btn-sm">What is Technology?</a>
					<a href="label.php" class="btn btn-light btn-sm">How technology works?</a>
					<a href="label.php" class="btn btn-light btn-sm">Intro to Technology?</a>
				</p>
			</div>

		</div>

		<?php include 'includes/blog-sidebar.php' ?>
	</div>
</div>

<?php include '../includes/footer.php' ?>