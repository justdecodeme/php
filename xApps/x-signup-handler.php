<?php
include 'includes/init.php';
?>

<?php
// register user
if (isset($_POST['action']) && $_POST['action'] == 'submitSignup') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];
    $role = 'subscriber'; // default role
    $message = '';

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $message =
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        One or more fields are <strong>empty!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if (email_exists($email)) {
        $message .=
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Email already <strong>exists!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if (username_exists($username)) {
        $message .=
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Username already <strong>exists!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if ($password !== $confirm_password) {
        $message .=
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Passwords do not <strong>match!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if ($message == '') {
      // prepare sql and bind parameters
        $query = "INSERT INTO `users`
      ( `username`, `email`, `password`, `role`)
      VALUES
      (:USERNAME, :EMAIL, :PASSWORD, :ROLE)";
        $statement = $connection->prepare($query);
        $params = array('USERNAME' => $username, 'EMAIL' => $email, 'PASSWORD' => $password, 'ROLE' => $role);

        // Update timetable if query is successful
        if ($statement->execute($params) && $statement->rowCount() == 1) {
            $_SESSION['message'] =
                '<div class="alert alert-success alert-dismissible fade show" role="alert" id="sessonMessage">
          Registration <strong>successful!</strong> You can login now.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';

            echo 1; // 1 for success
        } else {
            $message =
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          Qeury <strong>error!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';

        echo $message;
        }
    } else {
        echo $message;
    }
}

?>
