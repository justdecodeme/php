<?php
  include 'includes/connect.php';
  include 'includes/header.php';
?>

<div class="container">
  <div class="row col-md-6 offset-md-3">
    <h2>Signup to xConnect</h2>
    <form>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="r_kumar">
      </div>
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="example@gmail.com">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="••••••••••">
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" class="form-control" id="confirm_password" placeholder="••••••••••">
      </div>
      <button type="submit" class="btn btn-primary" name="submit_login">Submit</button>

      <small style="margin-top: 10px;" class="form-text text-muted">Already have an account? <a class="bg-link" href="login.php">Login</a></small>
    </form>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
