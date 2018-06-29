<?php
  include 'includes/init.php';
  // include 'includes/login_status.php';
  include 'includes/header.php';
?>

<div class="container-fluid dashboard-page" id="dashboard">
  <h2>xLibrary</h2>
  <hr>
  <table class="table">
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
        <button type="button" class="btn btn-success btn-block" id="confirmReturnBtn">Confirm Return</button>
      </td>
    </tr>
    <tr>
      <td>Rakesh</td>
      <td>Nudge</td>
      <td>09-March-2018</td>
      <td>16-March-2018</td>
      <td>Eric</td>
      <td>
        <input type="date" class="form-control" id="returnDate" value="2018-03-09">
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
  </table>
  <div class="row">
      <div class="col-md-2">
        <form class="form-block">
          <label for="selectedBatch">Select Borrower</label>
          <select class="custom-select" id="selectedBatch">
            <option value="rakesh">Rakesh Kumar</option>
            <option value="vinay">Vinay</option>
            <option value="vinay">Vinay</option>
            <option value="priya">Priya</option>
            <option value="anita">Anita</option>
            <option value="shankar">Shankar</option>
            <option value="aditya">Aditya</option>
          </select>
        </form>
      </div>
      <div class="col-md-2">
        <form class="form-block">
          <label for="selectedBook">Select Book</label>
          <select class="custom-select" id="selectedBatch">
            <option value="nudge">Nudge</option>
            <option value="missbehaving">Missbehaving</option>
            <option value="winning">Winning</option>
            <option value="world">The World is Flat</option>
            <option value="build">Build To Last</option>
          </select>
        </form>
      </div>
      <div class="col-md-2">
        <form class="form-block">
          <label for="issueDate">Issue Date</label>
          <input type="date" class="form-control" id="issueDate" value="2018-03-09">
        </form>
      </div>
      <div class="col-md-2">
        <form class="form-block">
          <label for="dueDate">Due Date</label>
          <input type="date" class="form-control" id="dueDate" value="2018-03-09">
        </form>
      </div>
      <div class="col-md-2">
        <form class="form-block">
          <label for="selectedBook">Approved By</label>
          <select class="custom-select" id="selectedBatch">
            <option value="eric">Eric</option>
            <option value="hiroki">Hiroki</option>
          </select>
        </form>
      </div>
      <!-- <div class="col-md-2">
        <form class="form-block">
          <label for="returnDate">Return Date</label>
          <input type="date" class="form-control" id="returnDate" value="2018-03-09">
        </form>
      </div> -->
      <div class="col-md-2">
        <form class="form-block">
          <label class="hidden">.</label><br>
          <button type="button" class="btn btn-success btn-block" id="approveBook">Approve Book</button>
        </form>
      </div>
  </div>
  <div class="row">
      <div class="col-md-1">
        <p class="borrower">Rakesh</p>
      </div>
      <div class="col-md-2">
        <p class="book">Nudge</p>
      </div>
      <div class="col-md-2">
        <p class="issue-date">09-March-2018</p>
      </div>
      <div class="col-md-2">
        <p class="due-date">15-March-2018</p>
      </div>
      <div class="col-md-2">
        <form class="form-block">
          <label for="selectedBook">Checked By</label>
          <select class="custom-select" id="selectedBatch">
            <option value="eric">Eric</option>
            <option value="hiroki">Hiroki</option>
          </select>
        </form>
      </div>
      <!-- <div class="col-md-2">
        <form class="form-block">
          <label for="returnDate">Return Date</label>
          <input type="date" class="form-control" id="returnDate" value="2018-03-09">
        </form>
      </div> -->
      <div class="col-md-2">
        <form class="form-block">
          <label class="hidden">.</label><br>
          <button type="button" class="btn btn-success btn-block" id="confirmReturn">Confirm Return</button>
        </form>
      </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="./_assets/js/timetable.min.js" charset="utf-8"></script>
