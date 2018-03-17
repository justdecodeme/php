<?php
  include 'includes/connect.php';
  include 'includes/header.php';
  // include 'includes/login_status.php';
?>

<div class="container">
  <h2>Dashboard</h2>
  <hr>
  <div class="row">
    <div class="col-md-3">
      <a class="card" href="timetable.php">
        <img class="card-img-top" src="./_assets/images/time-table.jpg" alt="Card image cap">
        <div class="card-body" style="padding: 1rem;">
          <h4 class="card-title text-center" style="margin: 0;">Time Table</h4>
        </div>
      </a>
    </div>
    <div class="col-md-3">
      <a class="card" href="attendance.php">
        <img class="card-img-top" src="./_assets/images/attendance.jpg" alt="Card image cap">
        <div class="card-body" style="padding: 1rem;">
          <h4 class="card-title text-center" style="margin: 0;">Attendance</h4>
        </div>
      </a>
    </div>
    <div class="col-md-3">
      <a class="card" href="feedback.php">
        <img class="card-img-top" src="./_assets/images/feedback.jpeg" alt="Card image cap">
        <div class="card-body" style="padding: 1rem;">
          <h4 class="card-title text-center" style="margin: 0;">Feedback</h4>
        </div>
      </a>
    </div>
    <!-- <div class="col-md-3">
      <a class="card" href="#">
        <img class="card-img-top" src="./_assets/images/quizzes.jpg" alt="Card image cap">
        <div class="card-body" style="padding: 1rem;">
          <h4 class="card-title text-center" style="margin: 0;">Quizzes</h4>
        </div>
      </a>
    </div>
    <div class="col-md-3">
      <a class="card" href="#">
        <img class="card-img-top" src="./_assets/images/badges.jpg" alt="Card image cap">
        <div class="card-body" style="padding: 1rem;">
          <h4 class="card-title text-center" style="margin: 0;">Badges</h4>
        </div>
      </a>
    </div>
    <div class="col-md-3">
      <a class="card" href="#">
        <img class="card-img-top" src="./_assets/images/ranking.jpeg" alt="Card image cap">
        <div class="card-body" style="padding: 1rem;">
          <h4 class="card-title text-center" style="margin: 0;">xType Ranking</h4>
        </div>
      </a>
    </div>
    <div class="col-md-3">
      <a class="card" href="#">
        <img class="card-img-top" src="./_assets/images/events.jpg" alt="Card image cap">
        <div class="card-body" style="padding: 1rem;">
          <h4 class="card-title text-center" style="margin: 0;">Events</h4>
        </div>
      </a>
    </div>
    <div class="col-md-3">
      <a class="card" href="#">
        <img class="card-img-top" src="./_assets/images/downloads.jpg" alt="Card image cap">
        <div class="card-body" style="padding: 1rem;">
          <h4 class="card-title text-center" style="margin: 0;">Download</h4>
        </div>
      </a>
    </div> -->


  </div>
</div>

<?php include 'includes/footer.php'; ?>
