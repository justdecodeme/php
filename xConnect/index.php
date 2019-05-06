<?php
$bodyClass = "xConnect";
$title = "xConnect";
// $rootPath = $_SERVER['DOCUMENT_ROOT'].'/php/xConnect/';
$rootPath = '';

include $rootPath.'includes/init.php';
// include $rootPath.'includes/login-status.php';
include $rootPath.'includes/header.php';
?>

<div class="container">
  <div class="row">

    <div class="col-md-3">
      <div class="card">
        <img class="card-img-top" src="./_assets/img/quotes.jpg" alt="Card image cap">
        <div class="card-body">
          <a href="x-quote/" class="btn btn-success">xQuotes</a>
        <?php
          if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
              echo '<a href="x-quote/admin.php" class="btn btn-danger"><i class="far fa-edit"></i></a>';
          }
          ?>        
        </div>
        </div>
    </div>

<!-- 
    <div class="col-md-3">
      <a class="card" href="x-library/index.php">
        <img class="card-img-top" src="./_assets/img/library.jpg" alt="Card image cap">
        <div class="card-body" style="padding: 1rem;">
          <h4 class="card-title text-center" style="margin: 0;">xLibrary</h4>
        </div>
      </a>
    </div> -->

    <?php
    // if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    //     echo '
    //     <div class="col-md-3">
    //       <a class="card" href="x-library/admin.php">
    //         <img class="card-img-top" src="./_assets/img/library.jpg" alt="Card image cap">
    //         <div class="card-body" style="padding: 1rem;">
    //           <h4 class="card-title text-center" style="margin: 0;">xLibrary Admin</h4>
    //         </div>
    //       </a>
    //     </div>
    //     <div class="col-md-3">
    //       <a class="card" href="x-library/categories.php">
    //         <img class="card-img-top" src="./_assets/img/library.jpg" alt="Card image cap">
    //         <div class="card-body" style="padding: 1rem;">
    //           <h4 class="card-title text-center" style="margin: 0;">Categories Admin</h4>
    //         </div>
    //       </a>
    //     </div>
    //     <div class="col-md-3">
    //       <a class="card" href="x-library/books.php">
    //         <img class="card-img-top" src="./_assets/img/library.jpg" alt="Card image cap">
    //         <div class="card-body" style="padding: 1rem;">
    //           <h4 class="card-title text-center" style="margin: 0;">Books Admin</h4>
    //         </div>
    //       </a>
    //     </div>
    //       ';
    // }
    ?>

    <?php
    // if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    //     echo '
    //     <div class="col-md-3">
    //       <a class="card" href="x-user/admin.php">
    //         <img class="card-img-top" src="./_assets/img/users.jpg" alt="Card image cap">
    //         <div class="card-body" style="padding: 1rem;">
    //           <h4 class="card-title text-center" style="margin: 0;">Users Admin</h4>
    //         </div>
    //       </a>
    //     </div>
    //     <div class="col-md-3">
    //       <a class="card" href="x-user/roles.php">
    //         <img class="card-img-top" src="./_assets/img/users.jpg" alt="Card image cap">
    //         <div class="card-body" style="padding: 1rem;">
    //           <h4 class="card-title text-center" style="margin: 0;">Roles Admin</h4>
    //         </div>
    //       </a>
    //     </div>
    //       ';
    // }
    ?>

  </div>
</div>

<?php include $rootPath.'includes/footer.php';?>