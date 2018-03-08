<?php session_start();
	include 'includes/db.php';

	# check login status
	#####################

	// if session variables are set
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$sel_sql = "SELECT * FROM users 
					WHERE user_email = '$_SESSION[user]' 
					AND user_password = '$_SESSION[password]' 
					LIMIT 1";

		if($run_sql = mysqli_query($conn, $sel_sql)){
			if(mysqli_affected_rows($conn)) {
				$rows = mysqli_fetch_assoc($run_sql);

				$email = $rows['user_email'];
				$image = $rows['user_image'];

			// if login is not validated
			} else {
				header('Location: login.php');
			}
		}
	// if session variables are not set
	} else {
		header('Location: login.php');
	}
?>

<?php include 'includes/header.php' ?>

<main class="index_page">
	<form class="main-form">
		<h1 class="heading">Already logged in as: <span><?php echo $_SESSION['user']; ?></span></h1>
		<div class="user-img flex-inline">
			<img src="<?php echo '_assets/images/'.$image; ?>" alt="<?php echo $_SESSION['user']; ?>">
		</div>
		<div class="user-options">
			<a class="bg-link" href="includes\logout.php">Logout</a>
			<a class="bg-link" href="xtype.php">Continue</a>				
		</div>
	</form>
</main>

<?php include 'includes/footer.php' ?>