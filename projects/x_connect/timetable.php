<?php
  include 'includes/connect.php';
  include 'includes/header.php';
  include 'includes/template_reader.php';
  // include 'includes/login_status.php';
?>

<div class="container list" id="timetableOuter">
  <h2>Time Table</h2>
  <hr>
  <!-- options -->
  <div class="row">
    <div class="col-md-9">
      <div class="row">
        <div class="col-md-5 list-layout">
          <form class="form-block">
            <label for="selectedBatch">Select Batch <small style="margin-left: 10px;"><a href="batch.php">Add New</a></small></label>
            <select class="custom-select my-1" id="selectedBatch">
              <option value="bc180305" data-template="bootcamp">bc180305 (Bootcamp)</option>
              <option value="u180325" data-template="unity">u180325 (Unity)</option>
              <option value="gr180325" data-template="graphic" selected>gr180325 (Graphic Design)</option>
            </select>
          </form>
        </div>
        <div class="col-md-7 grid-layout">
          <div class="row">
            <div class="col-md-6">
              <form class="form-block">
                <label for="selectedDate">Start Date</label>
                <input type="date" class="form-control" id="selectedDate" value="2018-03-09">
              </form>
            </div>
            <div class="col-md-6">
              <form class="form-block">
                <label for="selectedDate">End Date</label>
                <input type="date" class="form-control" id="selectedDate" value="2018-03-09">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <form class="form-block">
          <label for="selectedLayout">Select Layout</label>
          <select class="custom-select" id="selectedLayout">
            <option value="list">List View</option>
            <option value="grid">Grid View</option>
          </select>
      </form>
    </div>
  </div>

  <!-- tables -->
  <div class="row">
    <div class="col-md-12">
      <table class="table table-bordered list-layout" style="margin-top: 10px;">
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
      <table class="table table-bordered grid-layout" style="margin-top: 10px;">
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
            <td>
              <p>Time</p>
              <p>09:00 AM</p>
              <p>11:30 AM</p>
              <p>02:00 AM</p>
              <p>04:30 AM</p>
            </td>
            <td>
              <p>05-Mar</p>
              <p>-</p>
              <p>-</p>
              <p>BC33 - Aishwarya</p>
              <p>BC34 - Rakesh</p>
            </td>
            <td>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
            </td>
            <td>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
            </td>
            <td>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
            </td>
            <td>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
            </td>
            <td>
              <p>Time</p>
              <p>09:00 AM</p>
              <p>11:30 AM</p>
              <p>02:00 AM</p>
              <p>04:30 AM</p>
            </td>
            <td>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
            </td>
          </tr>
          <tr>
            <td>
              <p>Time</p>
              <p>09:00 AM</p>
              <p>11:30 AM</p>
              <p>02:00 AM</p>
              <p>04:30 AM</p>
            </td>
            <td>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
            </td>
            <td>
              <p>05-Mar</p>
              <p>-</p>
              <p>-</p>
              <p>BC33 - Aishwarya</p>
              <p>BC34 - Rakesh</p>
            </td>
            <td>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
            </td>
            <td>
              <p>05-Mar</p>
              <p>-</p>
              <p>-</p>
              <p>BC33 - Aishwarya</p>
              <p>BC34 - Rakesh</p>
            </td>
            <td>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
            </td>
            <td>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
            </td>
            <td>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
            </td>
          </tr>
          <tr>
            <td>
              <p>Time</p>
              <p>09:00 AM</p>
              <p>11:30 AM</p>
              <p>02:00 AM</p>
              <p>04:30 AM</p>
            </td>
            <td>
              <p>05-Mar</p>
              <p>-</p>
              <p>-</p>
              <p>BC33 - Aishwarya</p>
              <p>BC34 - Rakesh</p>
            </td>
            <td>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
            </td>
            <td>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
            </td>
            <td>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
            </td>
            <td>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
            </td>
            <td>
              <p>Time</p>
              <p>09:00 AM</p>
              <p>11:30 AM</p>
              <p>02:00 AM</p>
              <p>04:30 AM</p>
            </td>
            <td>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p>-</p>
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
