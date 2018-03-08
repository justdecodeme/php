<?php
  include 'includes/connect.php';
  include 'includes/header.php';
?>

<div class="container">
  <div class="row col-md-6 offset-md-3">
    <h2>Login to xConnect</h2>
    <form>
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-primary" name="submit_login">Submit</button>

      <small style="margin-top: 10px;" class="form-text text-muted">Don’t have an account? <a href="signup.php">Signup</a></small>
    </form>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
