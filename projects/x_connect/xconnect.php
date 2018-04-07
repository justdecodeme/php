<?php
  include 'includes/init.php';
  include 'includes/login_status.php';
  include 'includes/header.php';
?>

<main>
	<form class="text-center">
		<h1>Already logged in as: <span><?php echo $_SESSION['email']; ?></span></h1>
    <hr>
		<div class="user-options">
			<a class="bg-link" href="includes\logout.php">Logout <i class="fas fa-sign-out-alt"></i></a> |
			<a class="bg-link" href="index.php">Continue <i class="fas fa-arrow-right"></i></a>
		</div>
	</form>
</main>

<?php include 'includes/footer.php' ?>
