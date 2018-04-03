<?php
  session_start();
  include 'includes/connect.php';
?>

<?php
  // register user
  if(isset($_POST['action']) && $_POST['action'] == 'submitLogin') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $message = '';

    if(empty($email) || empty($password)) {
      $message =
      '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        One or more fields are <strong>empty!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';

      echo $message;
    } else {

      $query = "SELECT * FROM users
        WHERE email=:EMAIL
        AND `password`=:PASSWORD
      ";
      $statement = $connection->prepare($query);
      $params = array ('EMAIL'=>$email, 'PASSWORD'=>$password);

      // Update timetable if query is successful
      if($statement->execute($params) && $statement->rowCount() == 1) {
        echo 1; // 1 for success
      } else {
        $message =
        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          Email and Password doesn\'t <strong>match!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';

        echo $message;
      }
    }
  }


 ?>
