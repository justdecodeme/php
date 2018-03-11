<?php
  include 'includes/connect.php';
  include 'includes/header.php';
  include 'includes/template_reader.php';
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
            <option value="u180325" data-template="unity">u180325 (Unity)</option>
            <option value="gr180325" data-template="graphic" selected>gr180325 (Graphic Design)</option>
          </select>
      </form>
    </div>
    <div class="col-md-8 text-right">
      <div class="layout-btns">
        <a href="#" class="list"><i class="fa fa-bars"></i></a>
        <a href="#" class="grid"><i class="fa fa-th"></i></a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <table class="table table-bordered layou-list" style="margin-top: 10px;">
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
              </select>
            </td>
            <td>
              <select class="custom-select" id="selectedInstructor">
              </select>
            </td>
            <td class="time-picker">
              <input type="time" id="selectedStartTime" class="form-control" value="09:30">
              <input type="time" id="selectedEndTime" class="form-control" value="13:30">
            </td>
            <td>
              <select class="custom-select" id="selectedRoom">
              </select>
            </td>
            <td>
              <button class="btn btn-outline-danger" id="addClassBtn">Submit</button>
            </td>
          </tr>
        </tfoot>
      </table>
      <table class="table table-bordered layou-grid" style="margin-top: 10px;">
        <thead>
          <tr>
            <th></th>
            <th>Room - A</th>
            <th>New Batch</th>
            <th>Debut</th>
            <th></th>
            <th></th>
            <th>March 2018</th>
            <th>Version 2.0</th>
          </tr>
          <tr>
            <th></th>
            <th>Mon</th>
            <th>Tue</th>
            <th>Wed</th>
            <th>Thu</th>
            <th>Fri</th>
            <th>Sat</th>
            <th>Sun</th>
          </tr>
        </thead>
        <tbody id="timetableResultGrid">
          <tr>
            <td></td>
            <td>
              <p>05-Mar</p>
              <p>BC48 - Vinay</p>
              <p>BC49 - Pallavi</p>
              <p>BC33 - Aishwarya</p>
              <p>BC34 - Rakesh</p>
            </td>
          </tr>
        </tbody>
        <tfoot>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
