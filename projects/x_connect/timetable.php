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
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Select Batch <small style="margin-left: 10px;"><a href="batch.php">Add New</a></small></label>
          <select class="custom-select my-1 mr-sm-2" id="selectedBatch">
            <option value="bc180305" data-template="bootcamp">bc180305 (Bootcamp)</option>
            <option value="u180325" data-template="unity" selected>u180325 (Unity)</option>
            <option value="gr180325" data-template="graphic">gr180325 (Graphic Design)</option>
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
        <tfoot>
          <tr>
            <td></td>
            <td>
              <input type="date" class="form-control" id="selectedDate" value="2018-03-09">
            </td>
            <td>
              <select class="custom-select" id="selectedClass">
                <!-- <option value="u1" selected>Unity 1</option>
                <option value="u2">Unity 2</option>
                <option value="u3">Unity 3</option>
                <option value="u4">Unity 4</option> -->
              </select>
            </td>
            <td>
              <select class="custom-select" id="selectedInstructor">
                <!-- <option value="ins_rakesh" selected>Rakesh</option>
                <option value="ins_asha">Asha</option>
                <option value="ins_varsha">Varsha</option>
                <option value="ins_Pallavi">Pallavi</option> -->
              </select>
            </td>
            <td class="time-picker">
              <input type="time" id="selectedStartTime" class="form-control" value="09:30">
              <input type="time" id="selectedEndTime" class="form-control" value="13:30">
            </td>
            <td>
              <select class="custom-select" id="selectedRoom">
                <!-- <option value="a" selected>A</option>
                <option value="b">B</option> -->
              </select>
            </td>
            <td>
              <button class="btn btn-outline-danger" id="addClassBtn">Submit</button>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
