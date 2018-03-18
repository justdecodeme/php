<?php
  include 'includes/connect.php';
  include 'includes/header.php';
  // include 'includes/template_reader.php';
  // include 'includes/login_status.php';
?>

<div class="container-fluid list" id="usersOuter">
  <!-- <h2>Users <span class="badge badge-secondary badge-pill" style="font-size: 50%;">13</span></h2> -->
  <hr>
  <!-- filters -->
  <div class="row">
    <div class="col-md-2">
      <form class="form-block">
        <label for="selectedBatch">Select Batch</label>
        <select class="custom-select my-1" id="selectedBatch">
          <option value="all" data-template="bootcamp" selected>All</option>
          <option value="bc180305a" data-template="bootcamp">bc180305a (Bootcamp)</option>
          <option value="bc180305b" data-template="bootcamp">bc180305b (Bootcamp)</option>
          <option value="u180325" data-template="unity">u180325 (Unity)</option>
          <option value="gr180325" data-template="graphic" >gr180325 (Graphic Design)</option>
          <option value="wd180325" data-template="development" >wd180325 (Web Development)</option>
          <option value="php180325" data-template="php" >php180325 (PHP & MySQL)</option>
        </select>
      </form>
    </div>
    <div class="col-md-2">
      <form class="form-block">
        <label for="selectedBatch">Select Role</label>
        <select class="custom-select my-1" id="selectedBatch">
          <option value="all" selected>All</option>
          <option value="admin">Admin</option>
          <option value="instructor">Instructor</option>
          <option value="students">Students</option>
          <option value="subscriber">Subscriber</option>
        </select>
      </form>
    </div>
    <div class="col-md-2 list-layout">
      <form class="form-block">
        <label for="selectedBatch">Select Gender</label>
        <select class="custom-select my-1" id="selectedBatch">
          <option value="all" selected>All</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </form>
    </div>
    <div class="col-md-2">
      <form class="form-block">
        <label for="filterStartDate">Joined before</label>
        <input type="date" class="form-control" id="filterStartDate" value="2016-01-01">
      </form>
    </div>
    <div class="col-md-3">
      <form class="form-block">
        <label for="selectedLayout">Search User</label>
        <div class="input-group mb-3">
          <input type="text" name="search" placeholder="abc@example.com" class="form-control">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- tables -->
  <div class="row">
    <div class="col-md-12">
      <!-- list-layout -->
      <table class="table table-bordered list-layout" style="margin-top: 10px;">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col" class="ordered-by active-ASC" data-order-by="username">Username
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col" class="ordered-by" data-order-by="email">Email
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col" class="ordered-by" data-order-by="role">Role
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col" class="ordered-by" data-order-by="gender">Gender
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col" class="ordered-by" data-order-by="doj">DOJ
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col" class="ordered-by" data-order-by="student_code">Student Code
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody id="usersResultList"></tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="./_assets/js/users.min.js" charset="utf-8"></script>
