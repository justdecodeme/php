<div class="col-md-4">
	<div class="latest-post">
		<h2>5 Latest Post</h2>
		<div class="list-group">
			<?php 
				$stmt = $pdo->prepare("SELECT * FROM blog_data ORDER BY blog_id DESC LIMIT 5");			
				if ($stmt->execute()) {
				    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				    	$side_blog_title = ucwords($row['blog_title']);
				    	$side_blog_date = ucwords($row['blog_date']);
				    	$side_blog_category = strtoupper($row['blog_category']);
				    	$side_blog_author = ucwords($row['blog_author']);
					?>
					  <a href="post.php?post_id=<?php echo $row['blog_id'] ?>" class="list-group-item list-group-item-action" style="font-size: 14px;">
					  	<b><?php echo $side_blog_title; ?></b><br>
					  	<span>
					  		<?php echo $side_blog_date ?> | 
					  		<?php echo $side_blog_category ?> | 
					  		<?php echo $side_blog_author ?>
				  		</span>
					  </a>
					  
					<?php 
				    }
				}
			 ?>
		</div>
	</div>

	<div class="post-of-the-day">
		<h2>Post of the Day</h2>
		<div class="outer">
			<h4>The Second Post</h4>
			<p><a href="post.php">date</a> | <a href="post.php">Technology</a> | <a href="post.php">Rakko</a></p>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis repellat fuga, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, repudiandae praesentiu... <a href="post.php">Read More</a>
			</p>
			<p class="categories">
				<a href="#" class="btn btn-light btn-sm">What is Technology?</a>
				<a href="#" class="btn btn-light btn-sm">How technology works?</a>
				<a href="#" class="btn btn-light btn-sm">Intro to Technology?</a>
			</p>
		</div>
	</div>

	<div class="about">
		<h2>About Rakko</h2>
		<div class="row">
			<div class="col-md-4">
				<img src="../images/rakko.jpg" class="img-fluid img-thumbnail">
			</div>
			<div class="col-md-8">
				<a href="profile.php"><i class="fas fa-user"></i> Profile Page</a><br>
				<a href="http://www.justdecode.me" target="_blank"><i class="fas fa-globe"></i> Website</a><br>
				<a href="hashrakeshkumar@gmail.com"><i class="fas fa-envelope"></i> Email</a>
			</div>
		</div>
	</div>
</div>