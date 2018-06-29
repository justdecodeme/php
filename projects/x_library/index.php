<?php
  include 'includes/init.php';
  // include 'includes/login_status.php';
  include 'includes/header.php';
?>

<div class="container-fluid dashboard-page" id="dashboard">
  <h2>xLibrary</h2>
  <hr>
  <table class="table table-hover">
    <thead>
      <tr>
      <td>Select Borrower</td>
      <td>Select Book</td>
      <td>Issue Date</td>
      <td>Due Date</td>
      <td>Approved By</td>
      <td>Return Date</td>
      <td>Checked By</td>
      <td>Action</td>
    </tr>
      <tr>
      <td>
        <select class="custom-select" id="selectedBatch">
          <option value="rakesh">Rakesh Kumar</option>
          <option value="vinay">Vinay</option>
          <option value="vinay">Vinay</option>
          <option value="priya">Priya</option>
          <option value="anita">Anita</option>
          <option value="shankar">Shankar</option>
          <option value="aditya">Aditya</option>
        </select>
      </td>
      <td>
        <select class="custom-select" id="selectedBatch">
          <option value="nudge">Nudge</option>
          <option value="missbehaving">Missbehaving</option>
          <option value="winning">Winning</option>
          <option value="world">The World is Flat</option>
          <option value="build">Build To Last</option>
        </select>
      </td>
      <td>
        <input type="date" class="form-control" id="issueDate" value="2018-03-09">
      </td>
      <td>
        <input type="date" class="form-control" id="dueDate" value="2018-03-16">
      </td>
      <td>
        <select class="custom-select" id="approvedBy">
          <option value="eric">Eric</option>
          <option value="hiroki">Hiroki</option>
        </select>
      </td>
      <td>
        <input type="date" class="form-control" id="returnDate" value="2018-03-16" disabled>
      </td>
      <td>
        <select class="custom-select" id="checkedBy" disabled>
          <option value="eric">Eric</option>
          <option value="hiroki">Hiroki</option>
        </select>
      </td>
      <td>
        <button type="button" class="btn btn-success btn-block" id="approveBookBtn">Approve Book</button>
      </td>
    </tr>
    </thead>
    <tbody>
      <tr>
      <td>Rakesh</td>
      <td>Nudge</td>
      <td>09-March-2018</td>
      <td>16-March-2018</td>
      <td>Eric</td>
      <td>
        <input type="date" class="form-control" id="returnDate" value="2018-03-16">
      </td>
      <td>
        <select class="custom-select" id="selectedBatch">
          <option value="eric">Eric</option>
          <option value="hiroki">Hiroki</option>
        </select>
      </td>
      <td>
        <button type="button" class="btn btn-success btn-block" id="confirmReturn">Confirm Return</button>
      </td>
    </tr>
    </tbody>
    <tfoot>
      <tr>
        <td>Rakesh</td>
        <td>Nudge</td>
        <td>09-March-2018</td>
        <td>16-March-2018</td>
        <td>Eric</td>
        <td>16-March-2018</td>
        <td>Hiroki</td>
        <td>
          <button type="button" class="btn btn-success btn-block" disabled>Returned</button>
        </td>
      </tr>
      <tr>
        <td>Rakesh</td>
        <td>Nudge</td>
        <td>09-March-2018</td>
        <td>16-March-2018</td>
        <td>Eric</td>
        <td>16-March-2018</td>
        <td>Hiroki</td>
        <td>
          <button type="button" class="btn btn-primary btn-block" disabled>Returned</button>
        </td>
      </tr>
      <tr>
        <td>Rakesh</td>
        <td>Nudge</td>
        <td>09-March-2018</td>
        <td>16-March-2018</td>
        <td>Eric</td>
        <td>16-March-2018</td>
        <td>Hiroki</td>
        <td>
          <button type="button" class="btn btn-danger btn-block" disabled>Returned</button>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

<?php include 'includes/footer.php'; ?>
<script src="./_assets/js/timetable.min.js" charset="utf-8"></script>
