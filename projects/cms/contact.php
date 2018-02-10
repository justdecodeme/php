<?php include 'includes/db.php';
	$msg = '';

	if(isset($_POST['submit_contact'])){
		$date = date('Y-m-d h:i:s');
		$ins_sql = "INSERT INTO comments (name, email, subject, comment, date) VALUES ('$_POST[name]', '$_POST[email]', '$_POST[subject]', '$_POST[comment]', '$date')";
		$run_sql = mysqli_query($conn,$ins_sql);

		if(mysqli_affected_rows($conn)) {
			$msg = '<div class="alert alert-success alert-dismissable"">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Thank you very much for your valuable feedback!</div>';
		}
	}
?>

<?php include 'includes/header.php';?>
<div class="container">
	<article class="row">
		<section class="col-lg-8">
			<?php echo $msg; ?>
			<div class="page-header">
				<h2>Contact Us Form</h2>
			</div>
			<form class="form-horizontal" action="contact.php" method="post" role="form">
				<div class="form-group">
					<label for="name" class="col-sm-3 control-label">Name *</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="name" placeholder="Insert your Name" id="name" required>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="col-sm-3 control-label">Email Address *</label>
					<div class="col-sm-8">
						<input type="email" class="form-control" name="email" placeholder="Email Address" id="email" required>
					</div>
				</div>
				<div class="form-group">
					<label for="subject" class="col-sm-3 control-label">Subject *</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="subject" placeholder="Subject" id="subject" required>
					</div>
				</div>
				<div class="form-group">
					<label for="comments" class="col-sm-3 control-label">Comment *</label>
					<div class="col-sm-8">
						<textarea class="form-control" rows="10" name="comment" style="resize:none;" required></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-sm-8">
						<input type="submit" value="Submit your Form" name="submit_contact" class="btn btn-block btn-danger">
					</div>
				</div>
			</form>
			
		</section>
		<?php include 'includes/sidebar.php';?>
	</article>
</div>
<?php include 'includes/footer.php';?>