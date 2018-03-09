<?php
  include 'includes/connect.php';
  include 'includes/header.php';
  // include 'includes/login_status.php';
?>

<div class="container">
  <h2>Time Table</h2>
  <hr>
  <div class="row">
    <div class="col-md-4">
      <form class="form-inline">
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Select Batch</label>
          <select class="custom-select my-1 mr-sm-2" id="selectBatch">
            <option value="bc180305">bc180305 (Bootcamp)</option>
            <option value="unity180325" selected>unity180325 (Unity)</option>
            <option value="gr180325" >gr180325 (Graphic Design)</option>
          </select>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <table class="table table-bordered" style="margin-top: 10px;">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Date</th>
            <th scope="col">Class</th>
            <th scope="col">Instructor</th>
            <th scope="col">Time</th>
            <th scope="col">Room</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody id="timetableResult">
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
