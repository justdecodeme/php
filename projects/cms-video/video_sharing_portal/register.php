<?php include '../includes/header.php' ?>

<?php include 'includes/video-nav.php' ?>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<form action="">
				<h2>Register</h2>
				<div class="form-group">
					<label for="fname">First Name</label>
					<input type="text" class="form-control" id="fname">
				</div>
				<div class="form-group">
					<label for="lname">Last Name</label>
					<input type="text" class="form-control" id="lname">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" class="form-control" id="email">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="text" class="form-control" id="password">
				</div>
				<div class="form-group">
					<label for="password_confirm">Confirm Password</label>
					<input type="text" class="form-control" id="password_confirm">
				</div>
				<div class="form-group">
					<label for="dob">Date of Birth</label>
					<input type="date" class="form-control" id="dob">
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php include '../includes/footer.php' ?>
