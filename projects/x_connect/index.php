<?php
  include 'includes/connect.php';
  include 'includes/header.php';
  // include 'includes/login_status.php';
?>

<div class="container">
  <h2>Dashboard</h2>
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">WD-05</h5>
          <h6 class="card-subtitle mb-2 text-muted">10:00 AM - 12:00 PM</h6>
          <p class="card-text">Rakesh</p>
          <a href="#" class="card-link">Edit</a>
          <a href="#" class="card-link">Delete</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">GR-09</h5>
          <h6 class="card-subtitle mb-2 text-muted">02:30 PM - 04:30 PM</h6>
          <p class="card-text">Asha</p>
          <a href="#" class="card-link">Edit</a>
          <a href="#" class="card-link">Delete</a>
        </div>
      </div>
    </div>

  </div>
</div>

<?php include 'includes/footer.php'; ?>
