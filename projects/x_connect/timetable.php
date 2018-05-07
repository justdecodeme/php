<?php
  include 'includes/init.php';
  include 'includes/login_status.php';
  include 'includes/header.php';
  include 'includes/template_reader.php';
?>

<div class="container-fluid list" id="timetableOuter">
  <h2>Time Table</h2>
  <hr>
  <!-- options -->
  <div class="row">
    <!-- filters -->
    <div class="col-md-8">
      <div class="row">
        <!-- filter by batch -->
        <div class="col-md-5 list-layout">
          <form class="form-block">
            <label for="selectedBatch">Select Batch <small style="margin-left: 10px;"><a href="batch.php">Manage</a></small></label>
            <select class="custom-select my-1" id="selectedBatch"></select>
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
    <div class="col-md-1">
      <label style="opacity: 0;">Refresh</label>
      <button type="button" id="refreshBtn" class="btn btn-outline-secondary"><i class="fas fa-sync"></i></button>
    </div>
  </div>

  <!-- tables -->
  <div class="row">
    <div class="col-md-12">
      <!-- list-layout -->
      <table class="table table-bordered table-hover list-layout" style="margin-top: 10px;">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col" class="ordered-by active-ASC" data-order-by="class_date">Date
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
      <table class="table table-bordered table-hover grid-layout" style="margin-top: 10px;">
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
        <tbody id="timetableResultGrid_A"></tbody>
        <tfoot>
        </tfoot>
      </table>
      <!-- grid-layout | class room B -->
      <table class="table table-bordered table-hover grid-layout" style="margin-top: 10px;">
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
        <tbody id="timetableResultGrid_B"></tbody>
        <tfoot>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="./_assets/js/timetable.min.js" charset="utf-8"></script>
