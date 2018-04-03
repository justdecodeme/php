<?php
  include 'includes/init.php';
  include 'includes/header.php';

	# check login status
	#####################

  // if session variables are set
  if(isset($_SESSION['email']) && isset($_SESSION['password'])){
    $query = "SELECT *
      FROM users
      WHERE email=:EMAIL
      AND password=:PASSWORD
    ";
    $statement = $connection->prepare($query);
    $params = array ('EMAIL'=>$_SESSION['email'], 'PASSWORD'=>$_SESSION['password']);

    if($statement->execute($params) && $statement->rowCount() == 1) {
      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      foreach($row as $user) {
        echo $user->email;
      }
    // if login is not validated
    } else {
      header('Location: login.php');
    }
    // if session variables are not set
  } else {
      header('Location: login.php');
  }
?>

<main>
	<form class="text-center">
		<h1>Already logged in as: <span><?php echo $_SESSION['email']; ?></span></h1>
    <hr>
		<div class="user-options">
			<a class="bg-link" href="includes\logout.php">Logout <i class="fas fa-sign-out-alt"></i></a> |
			<a class="bg-link" href="xconnect.php">Continue <i class="fas fa-arrow-right"></i></a>
		</div>
	</form>
</main>

<?php include 'includes/footer.php' ?>
