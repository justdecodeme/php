<?php
  include 'includes/connect.php';
  include 'includes/header.php';
  include 'includes/template_reader.php';
  // include 'includes/login_status.php';
?>

<div class="container" id="attendanceOuter">
  <!-- <h2>Attendance</h2> -->
  <hr>

  <div class="row">
    <div class="col-md-3">
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
    <div class="col-md-3">
      <form class="form-block">
        <!-- <label for="selectedBatch">Select Students Present</label> -->
        <!-- <select class="custom-select my-1" id="selectedBatch"> -->
        <!-- <select id="selectedBatch" class="multiselect-ui form-control" multiple="multiple">
          <option value="std130308" selected>Nagraj</option>
          <option value="std130301" selected>Sachin</option>
          <option value="std130208" selected>Bhagya</option>
          <option value="std130108" selected>Amit</option>
        </select> -->

<div class="myDropdownCheckbox"></div>
      </form>
    </div>
    <div class="col-md-1">
      <label style="visibility: hidden;">.</label>
      <button class="btn btn-outline-danger">Submit</button>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

<script type="text/javascript">
var myData = [{id: 1, label: "Test" }];
$(".myDropdownCheckbox").dropdownCheckbox({
  data: myData,
  title: "Dropdown Checkbox"
});

</script>
