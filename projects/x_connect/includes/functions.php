<?php
function redirect($location) {
	return header("Location: {$location}");
}

function email_exists($email) {
  global $connection;

  $query = "SELECT id
    FROM users
    WHERE email=:EMAIL
  ";
  $statement = $connection->prepare($query);
  $params = array ('EMAIL'=>$email);

  if($statement->execute($params) && $statement->rowCount() == 1) {
		return true;
	} else {
		return false;
	}
}

function username_exists($username) {
  global $connection;

  $query = "SELECT id
    FROM users
    WHERE username=:USERNAME
  ";
  $statement = $connection->prepare($query);
  $params = array ('USERNAME'=>$username);

  if($statement->execute($params) && $statement->rowCount() == 1) {
		return true;
	} else {
		return false;
	}
}
 ?>
