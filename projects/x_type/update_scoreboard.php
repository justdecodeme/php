<?php session_start();
	include 'includes/db.php';

	# check login status
	#####################

	// if session variables are set and also scoreboard variables
	if(isset($_SESSION['user']) && isset($_SESSION['password'])) {
			$name = $_SESSION['user'];
	    $errors = $_GET['te'];
	    $char_typed = $_GET['tty'];
	    $gwpm = $_GET['gwpm'];
	    $nwpm = $_GET['nwpm'];
	    $accuracy = $_GET['a'];
	    $test_time = $_GET['ttm'];

	    $date_time = date('Y-m-d h:i:s');

	    $query = "INSERT INTO `scoreboard`
	    (`sb_name`, `sb_test_time`, `sb_errors`, `sb_char_typed`, `sb_gwpm`, `sb_nwpm`, `sb_accuracy`)
			VALUES
	    ('$name', '$test_time', '$errors', '$char_typed', '$gwpm', '$nwpm', '$accuracy')";

			if(mysqli_query($conn, $query)) {
		      echo "scoreboard updated! <br>";
			} else {
		      echo "Something went wrong :( " . mysqli_error($conn);
			}

			$query = "SELECT `sb_char_typed` FROM `scoreboard` WHERE sb_name = '$name'";
			$total_char_typed = 0;

			if($result = mysqli_query($conn, $query)) {
		    while($row = mysqli_fetch_assoc($result)) {
					$total_char_typed += $row['sb_char_typed'];
		    }
		  };

			$query = "SELECT * FROM `users` WHERE user_email = '$name'";

		  if($result = mysqli_query($conn, $query)) {
		    while($row = mysqli_fetch_assoc($result)) {

						$query = "UPDATE `users` SET `user_total_char_typed` = '$total_char_typed' WHERE `user_email` = '$name'";

					  if(mysqli_query($conn, $query)){
							echo "Users score updated (total character typed)!<br>";
						} else {
							echo "Something went wrong :( " . mysqli_error($conn);
						}

		      if($row['user_highest_wpm'] < $nwpm) {

						$query = "UPDATE `users` SET `user_highest_wpm` = '$nwpm' WHERE `user_email` = '$name'";

					  if(mysqli_query($conn, $query)){
							echo "Users score updated (highest wpm)!<br>";
						} else {
							echo "Something went wrong :( " . mysqli_error($conn);
						}

					}
		    }
		  };

		// if session variables are not set
	} else {
		header('Location: login.php');
	}
?>
