<?php
// include 'includes/init.php';

// if session variables are set redirect user to index.php page
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    $query = "SELECT *
      FROM users
      WHERE email=:EMAIL
      AND password=:PASSWORD
    ";
    $statement = $connection->prepare($query);
    $params = array('EMAIL' => $_SESSION['email'], 'PASSWORD' => $_SESSION['password']);

    if ($statement->execute($params) && $statement->rowCount() == 1) {
        redirect('index.php');
    }
}
?>

<?php include 'includes/header.php';?>

<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <!-- <h2>Login to xConnect</h2> -->
      <?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
}
unset($_SESSION['message']);
?>
      <div id="message"></div>
      <form id="submitLoginForm">
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary" name="submitLogin" id="submitLogin">Submit</button>

        <small style="margin-top: 10px;" class="form-text text-muted">Don’t have an account? <a href="signup.php">Signup</a></small>
      </form>
    </div>
  </div>
</div>

<?php include 'includes/footer.php';?>
<script src="./_assets/js/login.min.js" charset="utf-8"></script>
