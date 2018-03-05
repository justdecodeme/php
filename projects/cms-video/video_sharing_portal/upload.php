<?php include '../includes/header.php' ?>

<?php include 'includes/video-nav.php' ?>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<form action="">
				<h2>Upload video</h2>
				<div class="form-group">
					<label for="file">Select File</label>
					<input type="file" class="form-control" id="file">
				</div>
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title">
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<textarea name="description" id="description" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label for="playlist">Select Playlist</label>
					<select name="" id="playlist" class="form-control">
						<option selected>Select a Playlist</option>
						<option value="">Playlist 1</option>
						<option value="">Playlist 2</option>
					</select>
				</div>
				<div class="form-group">
					<label for="status">Status</label>
					<select name="" id="status" class="form-control">
						<option selected>Public</option>
						<option value="">Unlisted</option>
						<option value="">Private</option>
					</select>
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php include '../includes/footer.php' ?>
