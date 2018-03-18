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
          <option value="all" selected>All</option>
          <option value="bc180305a" >bc180305a</option>
          <option value="bc180305b" >bc180305b</option>
          <option value="u180325">u180325</option>
          <option value="gr180325">gr180325</option>
          <option value="wd180325" >wd180325</option>
          <option value="php180325">php180325</option>
        </select>
      </form>
    </div>
    <div class="col-md-2">
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
    </div>
    <div class="col-md-2 list-layout">
      <form class="form-block">
        <label for="selectedGender">Select Gender</label>
        <select class="custom-select my-1" id="selectedGender">
          <option value="all" selected>All</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </form>
    </div>
    <div class="col-md-2">
      <form class="form-block">
        <label for="selectedDOJ">Joined before</label>
        <input type="date" class="form-control" id="selectedDOJ" value="2018-05-01">
      </form>
    </div>
    <div class="col-md-4">
      <form class="form-block">
        <label for="selectedSearch">Search User</label>
          <input type="text" name="search" id="selectedSearch" placeholder="abc@example.com" class="form-control">
      </form>
    </div>
  </div>

  <!-- table -->
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
            <th scope="col" class="ordered-by" data-order-by="student_code">Student Code
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col" class="ordered-by" data-order-by="batch_code">Batch Code
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col" class="ordered-by" data-order-by="instructor_code">Instructor Code
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col" class="ordered-by" data-order-by="gender">Gender
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col" class="ordered-by" data-order-by="doj">Joining Date
              <span class="down"><i class="fa fa-chevron-down"></i></span>
              <span class="up"><i class="fa fa-chevron-up"></i></span>
            </th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody id="usersResultList"></tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="./_assets/js/users.min.js" charset="utf-8"></script>
