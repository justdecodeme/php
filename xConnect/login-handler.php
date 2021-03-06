<?php
include 'includes/init.php';
?>

<?php
// login user
if (isset($_POST['action']) && $_POST['action'] == 'submitLogin') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $message = '';

    if (empty($email) || empty($password)) {
        $message =
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        One or more fields are <strong>empty!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';

        echo $message;
    } else {

        $query = "SELECT u.user_email, u.user_name, u.user_password, r.role_code as user_role
          FROM users u
          LEFT JOIN roles r
          ON u.user_role_id = r.id
          WHERE `user_email`=:EMAIL
          AND `user_password`=:PASSWORD
      ";
        $statement = $connection->prepare($query);
        $params = array('EMAIL' => $email, 'PASSWORD' => $password);

        if ($statement->execute($params) && $statement->rowCount() == 1) {
            $row = $statement->fetchAll(PDO::FETCH_OBJ);
            
            // set session for user details
            foreach($row as $user) {
              $_SESSION['email'] = $user->user_email;
              $_SESSION['user_name'] = $user->user_name;
              $_SESSION['password'] = $user->user_password;
              $_SESSION['role'] = $user->user_role;
            }

            // 1 for success
            echo 1;
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
