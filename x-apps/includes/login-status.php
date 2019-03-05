<?php
$rootPath = $_SERVER['DOCUMENT_ROOT'] . '/php/x-apps/';

$email = '';
// if session variables are set
if(isset($_SESSION['email']) && isset($_SESSION['password'])){
  $query = "SELECT *
    FROM `users`
    WHERE `user_email`=:EMAIL
    AND `user_password`=:PASSWORD
  ";
  $statement = $connection->prepare($query);
  $params = array ('EMAIL'=>$_SESSION['email'], 'PASSWORD'=>$_SESSION['password']);

  if($statement->execute($params) && $statement->rowCount() == 1) {
    // redirect to x-apps.html if already logged in
    if(isset($isLoginPage) || isset($isSignupPage)) {
      redirect($rootPath.'x-apps/');
    } else {
      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      foreach($row as $user) {
        $image = $user->user_image;
        $f_name = $user->user_f_name;
        $l_name = $user->user_l_name;
        $username = $user->user_name;
        $email = $user->user_email;
        $role = $user->user_role_id;
        $doj = $user->user_doj;
        $batch_code = $user->user_batch_code;
        $student_code = $user->user_student_code;
        $instructor_code = $user->user_instructor_code;
      }
    }
  // if login is not validated
  } else {
    redirect('/php/x-apps/login.php');
    echo "Something goes wrong, Try after some time!";
  }
  // if session variables are not set and
} else {
  // request is not coming from login or signup page itself
  // redirect to login page
  if(!isset($isLoginPage) && !isset($isSignupPage)) {
    redirect('/php/x-apps/login.php');
  }
}
?>
