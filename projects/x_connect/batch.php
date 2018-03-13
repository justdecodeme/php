<?php
  include 'includes/connect.php';
  include 'includes/header.php';
  include 'includes/template_reader.php';
  // include 'includes/login_status.php';
?>

<div class="container list" id="timetableOuter">
  <!-- <h2>Manage Batches</h2> -->
  <hr><a href="timetable.php">timetable</a>

  <!-- tables -->
  <div class="row">
    <div class="col-md-12">
      <!-- list-layout -->
      <table class="table table-bordered list-layout" style="margin-top: 10px;">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col" class="ordered-by active-ASC" data-order-by="date">Batch Code
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col" class="ordered-by" data-order-by="class_code">Batch Name
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <!-- batch start date = date of first class (from timetable table) -->
            <th scope="col" class="ordered-by" data-order-by="instructor_code">Batch Start Date
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <!-- batch end date = date of last class (from timetable table) -->
            <th scope="col" class="ordered-by" data-order-by="start_time">Batch End Date
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <!-- total students = students registered for the current course (fro users table) -->
            <th scope="col" class="ordered-by" data-order-by="room_code">Total Students
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody id="timetableResultList">
          <tr>
            <td></td>
            <td>bc180305</td>
            <td>Bootcamp</td>
            <td>05 March | Mon</td>
            <td>18 May | Tue</td>
            <td>20</td>
          </tr>
        </tbody>
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
              <button class="btn btn-outline-danger" id="addClassBtn">Submit</button>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
