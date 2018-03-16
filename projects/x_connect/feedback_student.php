<?php
  include 'includes/connect.php';
  include 'includes/header.php';
  include 'includes/template_reader.php';
  // include 'includes/login_status.php';
?>

<div class="container" id="attendanceOuter">
  <h2>Feedback Student</h2>
  <hr>

  <div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="feedback-outer text-center">
          <div class="ins-img">
            <img src="./_assets/images/feedback.jpeg" class="img-fluid">
          </div>
          <div class="detail">
            <span class="name">Rakesh</span> |
            <span class="class">WD 01</span> |
            <span class="timing">12th Mar 18 (Mon)</span>
          </div>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </div>
          <div class="comment">
            <textarea name="name" class="form-control" placeholder="comments..."></textarea>
          </div>
          <input type="submit" class="btn btn-outline-success" value="Submit">
        </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="./_assets/js/attendance.min.js" charset="utf-8"></script>
