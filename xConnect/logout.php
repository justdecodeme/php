<?php
  session_start();

  unset($_SESSION['email']);
  unset($_SESSION['user_name']);
  unset($_SESSION['password']);
  unset($_SESSION['role']);

  $_SESSION['message'] =
  '<div class="alert alert-success alert-dismissible fade show" role="alert" id="sessonMessage">
    Successfully <strong>Logout!</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';

	header('Location: login.php');
?>
