<?php include 'includes/db.php' ?>
<?php include '../includes/header.php' ?>	

<div class="jumbotron text-center">
  <h1>CMS Blog</h1>
  <p>The simple blog which makes our life easier</p>
</div>

<div class="container">
	<?php include 'includes/blog-nav.php' ?>

	<div class="row">
		<div class="col-md-8">
			<?php 
				if(isset($_GET['post_id'])) {
					$stmt = $pdo->prepare("SELECT * FROM blog_data WHERE blog_id=:postId");
					// $stmt->bindValue(":postId", $_GET['post_id']); // both are correct
					$stmt->bindParam(":postId", $_GET['post_id']);					
					if ($stmt->execute()) {
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							$blog_title = ucwords($row['blog_title']);
							$blog_category = strtoupper($row['blog_category']);
							$blog_author = ucwords($row['blog_author']);
						?>
						<div class="post">
							<h3><?php echo $blog_title; ?></h3>
							<p>
								<a href="post.php"><?php echo $row['blog_date'] ?></a> | 
								<a href="post.php"><?php echo $blog_category ?></a> | 
								<a href="post.php"><?php echo $blog_author ?></a></p>
							<p>
							<img src="../images/blog.jpg" class="img-fluid">
							<p>
								<?php echo $row['blog_description']; ?>
							</p>
							<p>
								<a href="#" class="btn btn-light btn-sm">What is Technology?</a>
								<a href="#" class="btn btn-light btn-sm">How technology works?</a>
								<a href="#" class="btn btn-light btn-sm">Intro to Technology?</a>
							</p>
						</div>
						<?php
						}
					}
				} else {
					header('Location: index.php');
				}
			 ?>
		</div>
		
		<?php include 'includes/blog-sidebar.php' ?>
	</div>
</div>

<?php include '../includes/footer.php' ?>