<?php
  include 'includes/connect.php';
  include 'includes/header.php';
  include 'includes/template_reader.php';
  // include 'includes/login_status.php';
?>

<div class="container list" id="timetableOuter">
  <h2>Batches</h2>
  <hr>

  <!-- tables -->
  <div class="row">
    <div class="col-md-12">
      <!-- list-layout -->
      <table class="table table-bordered list-layout" style="margin-top: 10px;">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col" class="ordered-by active-ASC" data-order-by="batch_code">Batch Code
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col" class="ordered-by" data-order-by="batch_name">Batch Name
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <!-- batch start date = date of first class (from timetable table) -->
            <th scope="col" class="ordered-by" data-order-by="batch_start_date">Batch Start Date
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <!-- batch end date = date of last class (from timetable table) -->
            <th scope="col" class="ordered-by" data-order-by="batch_end_date">Batch End Date
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <!-- total students = students registered for the current course (fro users table) -->
            <th scope="col" class="ordered-by" data-order-by="batch_students">Total Students
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody id="timetableBatchList">
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
              <input type="text" class="form-control" id="selectedBatchCode" placeholder="bc180305" required>
            </td>
            <td>
              <input type="text" class="form-control" id="selectedBatchName" placeholder="Bootcamp" required>
            </td>
            <td>
              <input type="date" class="form-control" id="selectedBatchStartDate" value="2018-03-01" required>
            </td>
            <td>
              <input type="date" class="form-control" id="selectedBatchEndDate" value="2018-04-30" required>
            </td>
            <td>
              <input type="number" class="form-control" id="selectedBatchStuents" value="0" required>
            </td>
            <td>
              <button class="btn btn-outline-danger" id="addBatchBtn">Add Batch</button>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="./_assets/js/batch.min.js" charset="utf-8"></script>
