<?php
  include 'includes/connect.php';
?>

<?php
  // register user
  if(isset($_POST['submit_signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'subscriber';
    // $doj = now();
    $errors = '';

    if(empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
      $errors = 'One or more fields are empty!<br>';
    }
    if($password !== $confirm_password) {
      $errors .= 'Passwords do not match!';
    }
    if($errors == '') {
      $query = "INSERT INTO `users`
      ( `username`, `email`, `password`, `role`)
      VALUES
      (:USERNAME, :EMAIL, :PASSWORD, :ROLE)";
      $statement = $connection->prepare($query);
      $params = array ('USERNAME'=>$username, 'EMAIL'=>$email, 'PASSWORD'=>$password, 'ROLE'=>$role);

      // Update timetable if query is successful
      if($statement->execute($params)) {
        echo 'rows affected: ' . $statement->rowCount();
      }
    }
    echo 'errors: '. $errors;
  }


 ?>
