<?php
  include 'includes/connect.php';
?>

<?php
  // register user
  if(isset($_POST['action']) && $_POST['action'] == 'submitSignup') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];
    $role = 'subscriber';
    $message = '';

    if(empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
      $message =
      '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        One or more fields are <strong>empty!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if($password !== $confirm_password) {
      $message .=
      '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Passwords do not <strong>match!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if($message == '') {
      $query = "INSERT INTO `users`
      ( `username`, `email`, `password`, `role`)
      VALUES
      (:USERNAME, :EMAIL, :PASSWORD, :ROLE)";
      $statement = $connection->prepare($query);
      $params = array ('USERNAME'=>$username, 'EMAIL'=>$email, 'PASSWORD'=>$password, 'ROLE'=>$role);

      // Update timetable if query is successful
      if($statement->execute($params) && $statement->rowCount() == 1) {
        $message =
        '<div class="alert alert-success alert-dismissible fade show" role="alert">
          Registration <strong>successful!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
      } else {
        $message =
        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          Qeury <strong>error!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
      }
    }
    echo $message;
  }


 ?>
