<?php
$bodyClass = "x-books";
$title = 'xBooks | Admin';
$rootPath = $_SERVER['DOCUMENT_ROOT'] . '/php/x-apps/';

include $rootPath . 'includes/init.php';
include $rootPath . 'includes/login-status.php';

if (isset($role) && $role !== 'admin') {
    redirect($rootPath . 'x-library/');
}
include $rootPath . 'includes/header.php';
?>

<div class="container-fluid">

  <div class="row">

    <div class="col-md-12">

      <!-- listing -->
      <table class="table table-hover common-table">
        <thead>
          <tr>
            <th scope="col" colspan="2">
              <div class="form-group">
                <input id="categoryInput" type="text" class="form-control" placeholder="Category">
              </div>
            </th>
            <th scope="col" style="width: 170px;">
              <button type="button" class="btn btn-success" id="addBtn">Add</button>
            </th>
          </tr>
          <tr>
            <th scope="col" width="100">#</th>
            <th scope="col" data-order-by="category_name" class="order-by active-ASC">Category <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="list"></tbody>
      </table>
    </div>

  </div>

</div>

<?php include $rootPath . 'includes/footer.php';?>
<script src="/php/x-apps/_assets/js/books.min.js"></script>