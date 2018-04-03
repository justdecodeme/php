<?php
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
      // redirect('index.php');
      // header('Location: index.php');
    // if login is not validated
    } else {
      header('Location: login.php');
    }
    // if session variables are not set
  } else {
      header('Location: login.php');
  }
 ?>
