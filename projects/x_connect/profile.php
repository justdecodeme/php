<?php
  include 'includes/init.php';
  include 'includes/login_status.php';
  include 'includes/header.php';
?>

<div class="container profile-page">
  <h2>Bootcamp course</h2>
  <hr>

  <div class="row">
    <div class="col-md-12 text-center">
      <img src="./_assets/images/users.jpg" alt="User" width="100">
      <input type="text" class="form-control" id="firstName" placeholder="First Name" required>
      <input type="text" class="form-control" id="lastName" placeholder="Last Name" required>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
