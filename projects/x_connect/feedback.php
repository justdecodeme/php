<?php
  include 'includes/connect.php';
  include 'includes/header.php';
  include 'includes/template_reader.php';
  // include 'includes/login_status.php';
?>

<div class="container" id="attendanceOuter">
  <h2>Attendance</h2>
  <hr>

  <div class="row">
    <div class="col-md-4">
      <form class="form-block">
        <label for="selectedBatch">Select Batch</label>
        <select class="custom-select my-1" id="currentBatch">
          <option value="bc180305" data-template="bootcamp" selected>bc180305 (Bootcamp)</option>
          <option value="u180325" data-template="unity">u180325 (Unity)</option>
          <option value="gr180325" data-template="graphic" >gr180325 (Graphic Design)</option>
          <option value="php180325" data-template="php" >php180325 (PHP & MySQL)</option>
        </select>
      </form>
    </div>
    <div class="col-md-2">
      <form class="form-block">
        <label for="selectedBatch">Select Class</label>
        <select class="custom-select my-1" id="currentClass">
          <option value="bc1">BC 1</option>
          <option value="bc2">BC 2</option>
          <option value="bc3">BC 3</option>
          <option value="bc4">BC 4</option>
        </select>
      </form>
    </div>
    <div class="col-md-3">
      <label for="selectedBatch">Timing</label>
      <form class="form-block" style="display: flex;">
        <input type="time" disabled class="form-control" id="startClassTime" value="11:00" style="margin-right: 10px;">
        <input type="time" disabled class="form-control" id="endClassTime" value="13:00">
      </form>
    </div>
    <div class="col-md-2">
      <div class="button-group selectStudentsDropdown">
        <label for="">Select Students</label>
        <button type="button" class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown">0</button>
        <ul class="dropdown-menu">
         <li><a href="#" data-value="std130308" tabIndex="-1"><input type="checkbox"/>&nbsp;Nagraj</a></li>
         <li><a href="#" data-value="std130301" tabIndex="-1"><input type="checkbox"/>&nbsp;Sachin</a></li>
         <li><a href="#" data-value="std130208" tabIndex="-1"><input type="checkbox"/>&nbsp;Bhagya</a></li>
         <li><a href="#" data-value="std130108" tabIndex="-1"><input type="checkbox"/>&nbsp;Amit</a></li>
        </ul>
       </div>
    </div>
    <div class="col-md-1">
      <label style="visibility: hidden;">.</label>
      <button class="btn btn-outline-danger">Submit</button>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="./_assets/js/attendance.min.js" charset="utf-8"></script>
