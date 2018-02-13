<?php session_start();
	include 'includes/db.php';

	# check login status
	#####################

	// if session variables are set and also scoreboard variables
	if(isset($_SESSION['user']) && isset($_SESSION['password'])) {
		// if(isset($_GET['te']) && isset($_GET['tty']) && isset($_GET['gwpm']) && isset($_GET['nwpm']) && isset($_GET['a'] && isset($_GET['ttm'])) {
		// if(isset($_GET['te'])) {
		    // $user_name = $_SESSION['user'];

		    // $errors = $_GET['te'];
		    // $char_typed = $_GET['tty'];
		    // $gwpm = $_GET['gwpm'];
		    // $nwpm = $_GET['nwpm'];
		    // $accuracy = $_GET['a'];
		    // $test_time = $_GET['ttm'];

		    var_dump($_GET);

		    // $date_time = date('Y-m-d h:i:s');

		    // $query = "INSERT INTO `scoreboard` 
		    // (`sb_user_name`, `sb_test_time`, `sb_errors`, `sb_char_typed`, `sb_gwpm`, `sb_nwpm`, `sb_accuracy`) VALUES 
		    // ('$user_name', '$test_time', '$errors', '$char_typed', '$gwpm', '$nwpm', '$accuracy')";
		    
			// $sql = "INSERT INTO `scoreboard` (`sb_user_name`) VALUES ($user_name)";

			$query = "INSERT INTO `scoreboard` 
			( `sb_user_name`) VALUES 
			( 'rakesh')";
	
			if(mysqli_query($conn, $query)) {
		      echo "scoreboard updated!";
			} else {
		      echo "Something went wrong :( " . mysqli_error();
			}
		    var_dump($_GET);
		// }
	// if session variables are not set
	} else {
	// header('Location: xtype.php');
	}
?>