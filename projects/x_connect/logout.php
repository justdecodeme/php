<?php
  session_start();
	if(session_destroy()){
    echo 'Successfully logged out!';
		// header('Location: ../index.php');
	}
?>
