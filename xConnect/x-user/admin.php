<?php
$bodyClass = "x-user";
$title = 'xUser | Admin';
$rootPath = $_SERVER['DOCUMENT_ROOT'] . '/php/xConnect/';

include $rootPath . 'includes/init.php';
// include $rootPath . 'includes/login-status.php';

if (isset($role) && $role !== '1') {
    redirect($rootPath);
}
include $rootPath . 'includes/header.php';
?>

<div class="container-fluid">

  <div class="row">

    <div class="col-md-12">
      <h1>Users</h1>

      <!-- listing -->
        <table class="table table-hover common-table">
          <thead>
          <tr>
              <td scope="col" width="100">
                <label for="totalInput">Total</label>
                <input type="text" name="search" id="totalInput" class="form-control" disabled style="text-align: center;" placeholder="0">
              </td>
              <td scope="col">
                <form class="form-block">
                  <label for="roleSelect">Select Role</label>
                  <select class="custom-select my-1" id="roleSelect"></select>
                </form>
              </td>
              <td scope="col">
                <form class="form-block">
                  <label for="genderSelect">Select Gender</label>
                  <select class="custom-select my-1" id="genderSelect">
                    <option value="all" selected>All</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                </form>
              </td>
              <!-- <td scope="col">
                <form class="form-block">
                  <label for="selectedDOJ">Joined before</label>
                  <input type="date" class="form-control" id="selectedDOJ" value="2018-05-01">
                </form>
              </td> -->
              <td scope="col" colspan="3">
                <form class="form-block">
                  <label for="searchSelect">Search User (Username or Email)</label>
                  <input type="text" name="search" id="searchSelect" placeholder="abc@example.com" class="form-control">
                </form>
              </td>
          </tr>
          <tr>
            <th scope="col">#</th>
            <th scope="col" data-order-by="user_name" class="order-by">Username <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="user_email" class="order-by">Email <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="user_role_name" class="order-by">Role <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="user_gender" class="order-by">Gender <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="list"></tbody>
      </table>
    </div>

  </div>

</div>

<?php include $rootPath . 'includes/footer.php';?>
<script src="/php/xConnect/_assets/js/users.min.js"></script>