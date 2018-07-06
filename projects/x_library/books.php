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
        <td class="serial-no">S.No.</td>
        <td>Title</td>
        <td>Author</td>
        <td class="w150">Stock</td>
        <td>Category <a href="categories.php" class="edit-categories"><i class="fas fa-edit"></i></a></td>
        <td>Action</td>
      </tr>
      <tr>
        <td>#</td>
        <td>
          <input type="text" class="form-control" name="title" id="addTitle">
        </td>
        <td>
          <input type="text" class="form-control" name="author" id="addAuthor">
        </td>
        <td>
          <input type="number" class="form-control" min="0" max="100" id="addStock" value="1">
        </td>
        <td>
          <select class="custom-select" id="selectCategory"></select>
        </td>
        <td>
          <button type="button" class="btn btn-success" id="addBtn">Add Book</button>
        </td>
      </tr>
    </thead>
    <tbody id="booksListContainer"></tbody>
  </table>
</div>

<?php include 'includes/footer.php'; ?>
<script src="./_assets/js/books.min.js" charset="utf-8"></script>
