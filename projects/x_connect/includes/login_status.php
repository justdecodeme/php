<?php
// if session variables are set
$email = '';
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
      $image = $user->image;
      $f_name = $user->f_name;
      $l_name = $user->l_name;
      $username = $user->username;
      $email = $user->email;
      $role = $user->role;
      $doj = $user->doj;
      $batch_code = $user->batch_code;
      $student_code = $user->student_code;
      $instructor_code = $user->instructor_code;
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
