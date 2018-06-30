<?php
include 'includes/init.php';
// include 'includes/login_status.php';
include 'includes/header.php';
?>

<div class="container-fluid dashboard-page" id="dashboard">
  <h2>Books</h2>
  <hr>
  <table class="table table-hover">
    <thead>
      <tr>
        <td>Title</td>
        <td>Author</td>
        <td>Stock</td>
        <td>Category <a href="category.php" class="edit-categories"><i class="fas fa-edit"></i></a></td>
        <td>Action</td>
      </tr>
      <tr>
        <td>
          <input type="text" class="form-control" name="title">
        </td>
        <td>
          <input type="text" class="form-control" name="author">
        </td>
        <td>
          <input type="number" class="form-control" id="dueDate" min="0" max="100" value="1">
        </td>
        <td>
          <select class="custom-select" id="selectedBatch">
            <option value="-">-</option>
            <option value="business">business</option>
            <option value="marketing">marketing</option>
            <option value="technical">technical</option>
            <option value="selfhelp">self-help</option>
            <option value="autobiography">autobiography</option>
          </select>
        </td>
        <td>
          <button type="button" class="btn btn-success" id="submitBtn">Submit Book</button>
        </td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Nudge</td>
        <td>Rechard H. Thaler</td>
        <td>4</td>
        <td>business</td>
        <td>
          <button type="button" class="btn btn-primary" id="editBtn"><i class="fas fa-edit"></i></button>
          <button type="button" class="btn btn-danger" id="deleteBtn"><i class="fas fa-trash-alt"></i></button>

        </td>
      </tr>
      <tr>
        <td>The leader who has no title</td>
        <td>Robin Sharma</td>
        <td>2</td>
        <td>self-help</td>
        <td>
          <button type="button" class="btn btn-primary" id="editBtn"><i class="fas fa-edit"></i></button>
          <button type="button" class="btn btn-danger" id="deleteBtn"><i class="fas fa-trash-alt"></i></button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<?php include 'includes/footer.php'; ?>
<script src="./_assets/js/timetable.min.js" charset="utf-8"></script>
