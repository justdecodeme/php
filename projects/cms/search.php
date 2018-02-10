<?php include 'includes/db.php';?>
<?php include 'includes/header.php';?>
<div class="container">
	<article class="row">
		<section class="col-lg-8">
			
			<?php
				if(isset($_GET['search_submit'])){
					echo '
					<div class="panel panel-default">
						<div class="panel-body">
							<h4>You Searched for "'.$_GET['search'].'"</h4>
						</div>
					</div>
					';
					$sel_sql = "SELECT * FROM posts WHERE title LIKE '%$_GET[search]%' OR description LIKE '%$_GET[search]%'";
					$run_sql = mysqli_query($conn,$sel_sql);
					while($rows = mysqli_fetch_assoc($run_sql)){
						echo '
						<div class="panel panel-success">
							<div class="panel-heading">
								<h4>' . $rows['title'] . '</h4>
							</div>
							<div class="panel-body">
								<div class="col-lg-4">
									<img src="'.$rows['image'].'" height="100px">
								</div>
								<div class="col-lg-8">
									<p>'.substr($rows['description'], 0, 200).'........</p>
								</div>
								<a href="post.php?post_id='.$rows['id'].'" class="btn btn-primary">Read More</a>
							</div>
						</div>
						';
					}
				}	
			?>
			
		</section>
		<?php include 'includes/sidebar.php';?>
	</article>
</div>
<?php include 'includes/footer.php';?>
