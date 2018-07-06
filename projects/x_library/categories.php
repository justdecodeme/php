<?php
include 'includes/init.php';
// include 'includes/login_status.php';
include 'includes/header.php';
?>

<div class="container-fluid dashboard-page" id="dashboard">
  <h2>Categories</h2>
  <hr>
  <table class="table table-hover">
    <thead>
      <tr>
        <td class="serial-no">S.No.</td>
        <td>Code</td>
        <td>Name</td>
        <td>Action</td>
      </tr>
      <tr>
        <td>#</td>
        <td>
          <input type="text" class="form-control" name="code">
        </td>
        <td>
          <input type="text" class="form-control" name="name">
        </td>
        <td>
          <button type="button" class="btn btn-success" id="submitBtn">Submit</button>
        </td>
      </tr>
    </thead>
    <tbody id="categoriesListContainer"></tbody>
  </table>
</div>

<?php include 'includes/footer.php'; ?>
<script src="./_assets/js/categories.min.js" charset="utf-8"></script>
