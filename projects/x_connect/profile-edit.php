<?php
  include 'includes/init.php';
  include 'includes/login_status.php';
  include 'includes/header.php';
?>

<div class="container profile-page">
  <h2> Profile</h2>
  <hr>

  <div class="row">
    <div class="col-md-6 offset-md-3">
      <form id="submitProfileForm">
        <div class="form-group">
          <div class="pic text-center">
            <img src="<?php echo $image; ?>" alt="User" width="100">
          </div>
        </div>
        <div class="form-group">
          <label for="firstName">First Name</label>
          <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" value="<?php echo $f_name; ?>">
        </div>
        <div class="form-group">
          <label for="lastName">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" value="<?php echo $l_name; ?>">
        </div>
        <div class="form-group">
          <label for="userName">Username</label>
          <input type="text" class="form-control" id="userName" name="userName" placeholder="User Name" value="<?php echo $username; ?>">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
        </div>
          <button type="submit" class="btn btn-primary" name="submitProfile" id="submitProfile">Submit</button>
      </form>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
