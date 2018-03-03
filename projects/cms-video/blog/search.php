<?php include '../includes/header.php' ?>

<div class="jumbotron text-center">
  <h1>CMS Blog</h1>
  <p>The simple blog which makes our life easier</p>
</div>

<div class="container">
	<?php include 'includes/blog-nav.php' ?>

	<div class="row">
		<div class="col-md-8">

			<div class="alert alert-success " role="alert">
			  You <b>searched</b> for: <span id="text"><b>css</b></span>
			</div>

			<div class="post">
				<h1>The First Post</h1>
				<p><a href="post.php">date</a> | <a href="post.php">Technology</a> | <a href="post.php">Rakko</a></p>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis repellat fuga, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, repudiandae praesentiu... <a href="post.php">Read More</a>
				</p>
				<p>
					<a href="#" class="btn btn-light btn-sm">What is Technology?</a>
					<a href="#" class="btn btn-light btn-sm">How technology works?</a>
					<a href="#" class="btn btn-light btn-sm">Intro to Technology?</a>
				</p>
			</div>
			<div class="post">
				<h1>The Second Post</h1>
				<p><a href="post.php">date</a> | <a href="post.php">Technology</a> | <a href="post.php">Rakko</a></p>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis repellat fuga, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, repudiandae praesentiu... <a href="post.php">Read More</a>
				</p>
				<p>
					<a href="#" class="btn btn-light btn-sm">What is Technology?</a>
					<a href="#" class="btn btn-light btn-sm">How technology works?</a>
					<a href="#" class="btn btn-light btn-sm">Intro to Technology?</a>
				</p>
			</div>
			<div class="post">
				<h1>The Third Post</h1>
				<p><a href="post.php">date</a> | <a href="post.php">Technology</a> | <a href="post.php">Rakko</a></p>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis repellat fuga, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, eveniet quo inventore quibusdam, saepe ratione placeat nemo consequuntur, repudiandae praesentiu... <a href="post.php">Read More</a>
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