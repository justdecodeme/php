<?php
$bodyClass = "x-library-admin";
$title = 'xConnect | Admin';
$rootPath = $_SERVER['DOCUMENT_ROOT'] . '/php/xConnect/';

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

      <!-- quote listing -->
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col" colspan="2">
              <div class="form-group">
                <input id="quoteInput" type="text" class="form-control" placeholder="Quote">
              </div>
            </th>
            <th scope="col" style="width: 250px;">
              <div class="form-group">
                <input id="authorInput" type="text" class="form-control" placeholder="Author">
              </div>
            </th>
            <th scope="col" style="width: 170px;">
              <button type="button" class="btn btn-success" id="addBtn">Add</button>
            </th>
          </tr>
          <tr>
            <th scope="col">#</th>
            <th scope="col" data-order-by="quote" class="order-by active-ASC">Quote <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="author" class="order-by">Author <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="list">
          <!--<tr>
            <th scope="row">1</th>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td>
              <button type="button" class="btn btn-success"><i class="far fa-check-circle"></i></button>
              <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
            </td>
          </tr> -->
        </tbody>
      </table>
    </div>

  </div>

</div>

<button id="statusModalBtn" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target=".status-modal">querySuccessBtn</button>
<div class="modal fade status-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div id="statusModalAlert" class="alert alert-success" role="alert">...</div>
    </div>
  </div>
</div>

<?php include $rootPath . 'includes/footer.php';?>
<script src="/php/xConnect/_assets/js/quote.min.js"></script>
<script src="/php/xConnect/_assets/js/quote-admin.min.js"></script>