<?php
include 'includes/init.php';
// include 'includes/login_status.php';
include 'includes/header.php';
?>

<div class="container-fluid users-page">
  <h2>Users</h2>
  <hr>
  <table class="table table-hover">
    <thead>
      <tr>
        <td class="serial-no">S.No.</td>
        <td>Username</td>
        <td>Full Name</td>
        <td>Email</td>
        <td>Image</td>
        <td>Access Type</td>
        <td>Action</td>
      </tr>
      <tr>
        <td>#</td>
        <td>
          <input type="text" class="form-control" id="addUsername">
        </td>
        <td>
          <input type="text" class="form-control" id="addFullName">
        </td>
        <td>
          <input type="email" class="form-control" id="addEmail">
        </td>
        <td>
          <input type="file" class="form-control" id="addImage">
        </td>
        <td>
          <select class="custom-select" id="selectUserType">
            <option value="admin">Admin</option>
            <option value="user" selected>User</option>
          </select>
        </td>
        <td>
          <button type="button" class="btn btn-success" id="addBtn">Add User</button>
        </td>
      </tr>
    </thead>
    <tbody id="usersListContainer"></tbody>
  </table>
</div>

<?php include 'includes/footer.php'; ?>
<script src="./_assets/js/users.min.js" charset="utf-8"></script>
