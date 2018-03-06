<?php
  include ('config.php');

  if($_REQUEST['action'] == "sendMessage") {

    session_start();

    $query = $connection->prepare("INSERT INTO messages SET user=?, message=?");

    $run = $query->execute([$_SESSION['username'], $_REQUEST['message']]);

    if($run) {
      echo 1;
      exit;
    }
  }
 ?>
