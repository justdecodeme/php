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
  } else if($_REQUEST['action'] == "getMessage") {
    $query = $connection->prepare("SELECT * FROM messages");
    $run = $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    $chat = '';
    foreach($result as $message) {
      $chat .= '<p><b>'.$message->user. ' </b><span>'.$message->message . ' </span> | <span>'.date('m-d-Y h:i a', strtotime($message->date)).'</span></p>';
    }
    echo $chat;
  }
 ?>
