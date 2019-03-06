<?php
$bodyClass = "x-library";
$title = 'xLibrary | Admin';
$rootPath = $_SERVER['DOCUMENT_ROOT'] . '/php/x-apps/';

include $rootPath . 'includes/init.php';
include $rootPath . 'includes/login-status.php';

if (isset($role) && $role !== '1') {
    redirect($rootPath);
}
include $rootPath . 'includes/header.php';
?>

<div class="container-fluid">

  <div class="row">

    <div class="col-md-12">
      <!-- <h1>xLibrary - Admin</h1> -->

      <!-- listing -->
        <table class="table table-hover common-table">
          <thead>
          <tr>
              <td scope="col" colspan="3">
                <form class="form-block">
                  <label for="borrowerSelect">Select Borrower</label>
                  <select class="custom-select my-1" id="borrowerSelect"></select>
                </form>
              </td>
              <td scope="col">
                <form class="form-block">
                  <label for="bookCategorySelect">Select Book Category</label>
                  <select class="custom-select my-1" id="bookCategorySelect"></select>
                </form>
              </td>
              <td scope="col" colspan="2">
                <form class="form-block">
                  <label for="bookSelect">Select book</label>
                  <select class="custom-select my-1" id="bookSelect"></select>
                </form>
              </td>
              <td scope="col">
                <form class="form-block">
                  <label for="issueDateInput">Issue Date</label>
                  <input type="date" class="form-control" id="issueDateInput" value="2018-03-09">
                </form>
              </td>
              <td scope="col">
                <form class="form-block">
                  <label for="dueDateInput">Due Date</label>
                  <input type="date" class="form-control" id="dueDateInput" value="2018-03-09">
                </form>
              </td>
              <td scope="col">
                <form class="form-block">
                  <label for="approvedBySelect">Approved by</label>
                  <select class="custom-select my-1" id="approvedBySelect"></select>
                </form>
              </td>
              <!-- <td scope="col">
                <form class="form-block">
                  <label for="returnedDateInput">Return Date</label>
                  <input type="date" class="form-control" id="returnedDateInput" value="2018-03-09">
                </form>
              </td>
              <td scope="col">
                <form class="form-block">
                  <label for="ConfirmedBySelect">Confirmed By</label>
                  <select class="custom-select my-1" id="ConfirmedBySelect"></select>
                </form>
              </td> -->
              <td scope="col">
                <form class="form-block">
                  <label>.</label><br>
                  <button type="button" class="btn btn-success" id="addBtn">Add</button>
                </form>
              </td>
          </tr>
          <tr>
            <th scope="col" width="50">#</th>
            <th scope="col" data-order-by="borrowed_by" class="order-by">Borrower <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="book_title" class="order-by">Book <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="category_name" class="order-by">Book Category <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="lid" class="order-by">Issue Date <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="ldd" class="order-by">Due Date <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="approved_by" class="order-by">Approved By <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="lrd" class="order-by">Returned Date <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="confirmed_by" class="order-by">Confirmed By <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="list"></tbody>
      </table>
    </div>

  </div>

</div>

<?php include $rootPath . 'includes/footer.php';?>
<script src="/php/x-apps/_assets/js/library.min.js"></script>