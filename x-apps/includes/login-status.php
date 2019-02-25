<?php
$email = '';
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
    // redirect to x-appps.html if already logged in
    if(isset($isLoginPage) || isset($isSignupPage)) {
      redirect('x-apps.php');
    } else {
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
    }
  // if login is not validated
  } else {
    redirect('x-login.php');
    echo "Something goes wrong, Try after some time!";
  }
  // if session variables are not set and
} else {
  // request is not coming from login or signup page itself
  // redirect to login page
  if(!isset($isLoginPage) && !isset($isSignupPage)) {
    redirect('x-login.php');
  }
}
?>
