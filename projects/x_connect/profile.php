<?php
  include 'includes/init.php';
  include 'includes/login_status.php';
  include 'includes/header.php';
?>

<div class="container profile-page">
  <h2>Profile</h2>
  <hr>

  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="form-group">
        <div class="pic text-center">
          <img src="<?php echo $image; ?>" alt="User" width="100">
        </div>
      </div>
      <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" value="<?php echo $f_name; ?>" disabled>
      </div>
      <div class="form-group">
        <label for="lastName">Last Name</label>
        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" value="<?php echo $l_name; ?>" disabled>
      </div>
      <div class="form-group">
        <label for="userName">Username</label>
        <input type="text" class="form-control" id="userName" name="userName" placeholder="User Name" value="<?php echo $username; ?>" disabled>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>" disabled>
      </div>
      <div class="form-group">
        <label for="role">Role</label>
        <input type="text" class="form-control" id="role" name="role" placeholder="Role" value="<?php echo $role; ?>" disabled>
      </div>
      <div class="form-group">
        <label for="doj">Date of Joining</label>
        <input type="text" class="form-control" id="doj" name="doj" placeholder="Date of Joining" value="<?php echo $doj; ?>" disabled>
      </div>
      <div class="form-group">
        <label for="batchCode">Batch Code</label>
        <input type="text" class="form-control" id="batchCode" name="batchCode" placeholder="Batch Code" value="<?php echo $batch_code; ?>" disabled>
      </div>
      <div class="form-group">
        <label for="studentCode">Student Code</label>
        <input type="text" class="form-control" id="studentCode" name="studentCode" placeholder="Student Code" value="<?php echo $student_code; ?>" disabled>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
