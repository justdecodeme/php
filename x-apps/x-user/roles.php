<?php
$bodyClass = "x-roles";
$title = 'xRoles | Admin';
$rootPath = $_SERVER['DOCUMENT_ROOT'] . '/php/x-apps/';

include $rootPath . 'includes/init.php';
include $rootPath . 'includes/login-status.php';

if (isset($role) && $role !== '1') {
    redirect($rootPath . 'x-user/');
}
include $rootPath . 'includes/header.php';
?>

<div class="container-fluid">

  <div class="row">

    <div class="col-md-12">
      <h1>Roles</h1>

      <!-- listing -->
      <table class="table table-hover common-table">
        <thead>
          <tr>
            <th scope="col" colspan="2">
              <div class="form-group">
                <input id="roleInput" type="text" class="form-control" placeholder="Role">
              </div>
            </th>
            <th scope="col">
              <div class="form-group">
                <input id="codeInput" type="text" class="form-control" placeholder="Code">
              </div>
            </th>
            <th scope="col" style="width: 170px;">
              <button type="button" class="btn btn-success" id="addBtn">Add</button>
            </th>
          </tr>
          <tr>
            <th scope="col" width="100">#</th>
            <th scope="col" data-order-by="role_name" class="order-by active-ASC">Role <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="role_code" class="order-by">Code <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="list"></tbody>
      </table>
    </div>

  </div>

</div>

<?php include $rootPath . 'includes/footer.php';?>
<script src="/php/x-apps/_assets/js/roles.min.js"></script>