<?php
  include 'includes/init.php';
  include 'includes/header.php';
?>

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

        <small style="margin-top: 10px;" class="form-text text-muted">Already have an account? <a class="bg-link" href="login.php">Login</a></small>
      </form>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="./_assets/js/signup.min.js" charset="utf-8"></script>
