<?php
include 'includes/init.php';

// if session variables are set redirect user to x-apps.php page
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    $query = "SELECT *
      FROM users
      WHERE email=:EMAIL
      AND password=:PASSWORD
    ";
    $statement = $connection->prepare($query);
    $params = array('EMAIL' => $_SESSION['email'], 'PASSWORD' => $_SESSION['password']);

    if ($statement->execute($params) && $statement->rowCount() == 1) {
        redirect('x-apps.php');
    }
}

?>

<?php include 'includes/x-header.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <!-- <h2>Signup to xConnect</h2> -->
      <div id="message"></div>
      <form id="submitForm">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" name="username" id="username" placeholder="r_kumar">
        </div>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="••••••••••">
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password</label>
          <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="••••••••••">
        </div>
        <button type="submit" class="btn btn-primary" name="submitSignup" id="submitSignup">Submit</button>

        <small style="margin-top: 10px;" class="form-text text-muted">Already have an account? <a class="bg-link" href="x-login.php">Login</a></small>
      </form>
    </div>
  </div>
</div>

<?php include 'includes/x-footer.php';?>
<script src="./_assets/js/x-signup.min.js" charset="utf-8"></script>
