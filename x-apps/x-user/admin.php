<?php
$bodyClass = "x-user";
$title = 'xUser | Admin';
$rootPath = $_SERVER['DOCUMENT_ROOT'] . '/php/x-apps/';

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
                <label for="selectedTotal">Total</label>
                <input type="text" name="search" id="selectedTotal" class="form-control" disabled style="text-align: center;" placeholder="0">
              </td>
              <td scope="col">
                <form class="form-block">
                  <label for="selectedRole">Select Role</label>
                  <select class="custom-select my-1" id="selectedRole">
                    <option value="all" selected>All</option>
                    <option value="admin">Admin</option>
                    <option value="instructor">Instructor</option>
                    <option value="student">Students</option>
                    <option value="subscriber">Subscriber</option>
                  </select>
                </form>
              </td>
              <td scope="col">
                <form class="form-block">
                  <label for="selectedGender">Select Gender</label>
                  <select class="custom-select my-1" id="selectedGender">
                    <option value="all" selected>All</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                </form>
              </td>
              <td scope="col">
                <form class="form-block">
                  <label for="selectedDOJ">Joined before</label>
                  <input type="date" class="form-control" id="selectedDOJ" value="2018-05-01">
                </form>
              </td>
              <td scope="col" colspan="2">
                <form class="form-block">
                  <label for="selectedSearch">Search User (Username or Email)</label>
                  <input type="text" name="search" id="selectedSearch" placeholder="abc@example.com" class="form-control">
                </form>
              </td>
          </tr>
          <tr>
            <th scope="col">#</th>
            <th scope="col" data-order-by="user_name" class="order-by active-ASC">Username <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="user_email" class="order-by">Email <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="user_role" class="order-by">Role <span class="down">↓</span><span class="up">↑</span></th>
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
<script src="/php/x-apps/_assets/js/users.min.js"></script>