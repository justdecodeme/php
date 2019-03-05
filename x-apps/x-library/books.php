<?php
$bodyClass = "x-books";
$title = 'xBooks | Admin';
$rootPath = $_SERVER['DOCUMENT_ROOT'] . '/php/x-apps/';

include $rootPath . 'includes/init.php';
// include $rootPath . 'includes/login-status.php';

if (isset($role) && $role !== 'admin') {
    redirect($rootPath . 'x-library/');
}
include $rootPath . 'includes/header.php';
?>

<div class="container-fluid">

  <div class="row">

    <div class="col-md-12">
      <h1>Books</h1>

      <!-- listing -->
      <table class="table common-table">
        <tr>
            <th scope="col" colspan="2">
              <div class="form-group">
                <input id="titleInput" type="text" class="form-control" placeholder="Title">
              </div>
            </th>
            <th scope="col" colspan="2">
              <div class="form-group">
                <input id="authorInput" type="text" class="form-control" placeholder="Author">
              </div>
            </th>
            <th scope="col" colspan="2">
              <div class="form-group">
                <input id="stockInput" type="number" class="form-control" placeholder="Stock">
              </div>
            </th>
            <th scope="col" colspan="2">
              <div class="form-group">
                <select class="custom-select" id="categoryInput"></select>
              </div>
            </th>
            <th scope="col">
              <button type="button" class="btn btn-success" id="addBtn">Add</button>
            </th>
        </tr>
      </table>
      <table class="table table-hover common-table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col" data-order-by="book_title" class="order-by active-ASC">Title <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="book_author" class="order-by">Author <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="book_stock" class="order-by">Stock <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="category_id" class="order-by">Category <span class="down">↓</span><span class="up">↑</span></th>
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