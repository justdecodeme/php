<?php include '../includes/header.php' ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 10px;">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Upload <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fa fa-sign-in-alt"></i> Singin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fa fa-user-plus"></i> Join</a>
      </li>
    </ul>
    </form>
  </div>
</nav>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-2 left-sidebar">
			<div class="categories">
				<h4>Categories</h4>
				<div class="nav flex-column nav-pills" aria-orientation="vertical">
				  <a class="nav-link active" href="#"><i class="fab fa-html5"></i> HTML</a>
				  <a class="nav-link" href="#"><i class="fab fa-css3-alt"></i> css</a>
				  <a class="nav-link" href="#"><i class="fab fa-js"></i> JS</a>
				  <a class="nav-link" href="#"><i class="fab fa-php"></i> PHP</a>
				</div>
			</div>
			<div class="my-activity" style="margin-top: 20px;">
				<h4>My Account</h4>
				<div class="nav flex-column nav-pills" aria-orientation="vertical">
				  <a class="nav-link active" href="#"><i class="fa fa-video"></i>  Channel</a>
				  <a class="nav-link" href="#"><i class="fa fa-list-ul"></i>  Playlist</a>
				  <a class="nav-link" href="#"><i class="fa fa-heart"></i>  Liked Videos</a>
				  <a class="nav-link" href="#"><i class="fa fa-plus-square"></i>  Subscribed Channels</a>
				</div>
			</div>
		</div>
		<div class="col-md-10">
			<div class="jumbotron"></div>
		</div>
	</div>
</div>

<?php include '../includes/footer.php' ?>
