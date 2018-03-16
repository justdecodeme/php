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
    <!-- filters -->
    <div class="col-md-9">
      <div class="row">
        <!-- filter by batch -->
        <div class="col-md-5 list-layout">
          <form class="form-block">
            <label for="selectedBatch">Select Batch <small style="margin-left: 10px;"><a href="batch.php">Manage</a></small></label>
            <select class="custom-select my-1" id="selectedBatch">
              <option value="bc180305" data-template="bootcamp" selected>bc180305 (Bootcamp)</option>
              <option value="u180325" data-template="unity">u180325 (Unity)</option>
              <option value="gr180325" data-template="graphic" >gr180325 (Graphic Design)</option>
              <option value="php180325" data-template="php" >php180325 (PHP & MySQL)</option>
            </select>
          </form>
        </div>
        <!-- filter by date -->
        <div class="col-md-7 grid-layout">
          <div class="row">
            <div class="col-md-6">
              <form class="form-block">
                <label for="filterStartDate">Start Date</label>
                <input type="date" class="form-control" id="filterStartDate" value="2018-03-09">
              </form>
            </div>
            <div class="col-md-6">
              <form class="form-block">
                <label for="filterEndDate">End Date</label>
                <input type="date" class="form-control" id="filterEndDate" value="2018-03-09">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- select layout -->
    <div class="col-md-3">
      <form class="form-block">
          <label for="selectedLayout">Select Layout</label>
          <select class="custom-select" id="selectedLayout">
            <option value="list" selected>List View</option>
            <option value="grid" >Grid View</option>
          </select>
      </form>
    </div>
  </div>

  <!-- tables -->
  <div class="row">
    <div class="col-md-12">
      <!-- list-layout -->
      <table class="table table-bordered list-layout" style="margin-top: 10px;">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col" class="ordered-by active-ASC" data-order-by="date">Date
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col" class="ordered-by" data-order-by="class_code">Class
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col" class="ordered-by" data-order-by="instructor_code">Instructor
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col" class="ordered-by" data-order-by="start_time">Time
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col" class="ordered-by" data-order-by="room_code">Room
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody id="timetableResultList"></tbody>
        <tfoot>
          <tr>
            <td></td>
            <td>
              <input type="date" class="form-control" id="selectedDate" value="2018-03-09">
            </td>
            <td>
              <select class="custom-select" id="selectedClass"></select>
            </td>
            <td>
              <select class="custom-select" id="selectedInstructor"></select>
            </td>
            <td class="time-picker">
              <input type="time" id="selectedStartTime" class="form-control" value="09:00">
              <input type="time" id="selectedEndTime" class="form-control" value="11:00">
            </td>
            <td>
              <select class="custom-select" id="selectedRoom"></select>
            </td>
            <td>
              <button class="btn btn-outline-danger btn-sm" id="addClassBtn">Add Class</button>
            </td>
          </tr>
        </tfoot>
      </table>
      <!-- grid-layout | class room A -->
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
        <tbody id="timetableResultGrid"></tbody>
        <tfoot>
        </tfoot>
      </table>
      <!-- grid-layout | class room B -->
      <table class="table table-bordered grid-layout d-none" style="margin-top: 10px;">
        <thead>
          <tr>
            <th></th>
            <th>Room - B</th>
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
<script src="./_assets/js/timetable.min.js" charset="utf-8"></script>
