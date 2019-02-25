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

  // METHOD 1
  // Execute a prepared statement with an array of insert values (named parameters)
  // $params = array('EMAIL'=>$email);
  // if($statement->execute($params) && $statement->rowCount() == 1) {
    
  // METHOD 2
  // Execute a prepared statement with a bound variable and value
  $statement->bindParam(':EMAIL', $email);
  if($statement->execute() && $statement->rowCount() == 1) {
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
  $params = array('USERNAME'=>$username);

  if($statement->execute($params) && $statement->rowCount() == 1) {
		return true;
	} else {
		return false;
	}
}
?>
