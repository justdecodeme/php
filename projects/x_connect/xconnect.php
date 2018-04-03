<?php
  include 'includes/init.php';

  // if session variables are set
  $user_email = '';
  if(isset($_SESSION['email']) && isset($_SESSION['password'])){
    $query = "SELECT *
      FROM users
      WHERE email=:EMAIL
      AND password=:PASSWORD
    ";
    $statement = $connection->prepare($query);
    $params = array ('EMAIL'=>$_SESSION['email'], 'PASSWORD'=>$_SESSION['password']);

    if($statement->execute($params) && $statement->rowCount() == 1) {
      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      foreach($row as $user) {
        $user_email = $user->email;
      }
    // if login is not validated
    } else {
      header('Location: login.php');
    }
    // if session variables are not set
  } else {
      header('Location: login.php');
  }

?>

<?php include 'includes/header.php'; ?>

<div class="container">
  <h2>Dashboard</h2>
  <hr>
  <div class="row">
    <div class="col-md-3">
      <a class="card" href="batch.php">
        <img class="card-img-top" src="./_assets/images/batch.png" alt="Card image cap">
        <div class="card-body" style="padding: 1rem;">
          <h4 class="card-title text-center" style="margin: 0;">Batches</h4>
        </div>
      </a>
    </div>
    <div class="col-md-3">
      <a class="card" href="timetable.php">
        <img class="card-img-top" src="./_assets/images/timetable.jpg" alt="Card image cap">
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
    <div class="col-md-3">
      <a class="card" href="users.php">
        <img class="card-img-top" src="./_assets/images/users.jpg" alt="Card image cap">
        <div class="card-body" style="padding: 1rem;">
          <h4 class="card-title text-center" style="margin: 0;">Users</h4>
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
