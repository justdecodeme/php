<?php
  include 'includes/init.php';

  // if session variables are set redirect user to index.php page
  if(isset($_SESSION['email']) && isset($_SESSION['password'])){
    $query = "SELECT *
      FROM users
      WHERE email=:EMAIL
      AND password=:PASSWORD
    ";
    $statement = $connection->prepare($query);
    $params = array ('EMAIL'=>$_SESSION['email'], 'PASSWORD'=>$_SESSION['password']);

    if($statement->execute($params) && $statement->rowCount() == 1) {
      redirect('index.php');
    }
  }
?>

<?php include 'includes/header.php'; ?>

<div class="container login-page">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h2>Login to xLibrary</h2>
      <br>
      <?php
        if(isset($_SESSION['message'])) {
          echo $_SESSION['message'];
        }
        unset($_SESSION['message']);
      ?>
      <div id="message"></div>
      <form id="submitLoginForm">
        <div class="form-group">
          <label for="email">Username</label>
          <input type="email" class="form-control" id="email">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password">
        </div>
        <button type="submit" class="btn btn-primary" name="submitLogin" id="submitLogin">Submit</button>
      </form>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="./_assets/js/login.min.js" charset="utf-8"></script>
