<?php
$bodyClass = "x-apps";
$title = "xApps";
$rootPath = $_SERVER['DOCUMENT_ROOT'].'/php/x-apps/';

include $rootPath.'includes/init.php';
include $rootPath.'includes/login-status.php';
include $rootPath.'includes/header.php';
?>

<div class="container">
  <div class="row">

    <div class="col-md-3">
      <a class="card" href="x-quote/">
        <img class="card-img-top" src="./_assets/img/quotes.jpg" alt="Card image cap">
        <div class="card-body" style="padding: 1rem;">
          <h4 class="card-title text-center" style="margin: 0;">xQuotes</h4>
        </div>
      </a>
    </div>

    <?php 
    if(isset($role) && $role == 'admin') {
      echo '
      <div class="col-md-3">
        <a class="card" href="x-quote/admin.php">
          <img class="card-img-top" src="./_assets/img/quotes.jpg" alt="Card image cap">
          <div class="card-body" style="padding: 1rem;">
            <h4 class="card-title text-center" style="margin: 0;">xQuotes Admin</h4>
          </div>
        </a>
      </div>
      ';
    }
    ?>

    <div class="col-md-3">
      <a class="card" href="x-library/index.php">
        <img class="card-img-top" src="./_assets/img/library.jpg" alt="Card image cap">
        <div class="card-body" style="padding: 1rem;">
          <h4 class="card-title text-center" style="margin: 0;">xLibrary</h4>
        </div>
      </a>
    </div>

    <?php
    if (isset($role) && $role == 'admin') {
        echo '
        <div class="col-md-3">
          <a class="card" href="x-library/admin.php">
            <img class="card-img-top" src="./_assets/img/library.jpg" alt="Card image cap">
            <div class="card-body" style="padding: 1rem;">
              <h4 class="card-title text-center" style="margin: 0;">xLibrary Admin</h4>
            </div>
          </a>
        </div>
          ';
    }
    ?>


  </div>
</div>

<?php include $rootPath.'includes/footer.php';?>