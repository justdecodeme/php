<?php
  include 'includes/init.php';
  include 'includes/login-status.php';
  include 'includes/x-header.php';
?>

<div class="container">
  <div class="row">

    <div class="col-md-3">
      <a class="card" href="x-quotes.php">
        <img class="card-img-top" src="./_assets/img/quotes.jpg" alt="Card image cap">
        <div class="card-body" style="padding: 1rem;">
          <h4 class="card-title text-center" style="margin: 0;">xQuotes</h4>
        </div>
      </a>
    </div>

    <div class="col-md-3">
      <a class="card" href="x-library.php">
        <img class="card-img-top" src="./_assets/img/library.jpg" alt="Card image cap">
        <div class="card-body" style="padding: 1rem;">
          <h4 class="card-title text-center" style="margin: 0;">xLibrary</h4>
        </div>
      </a>
    </div>

  </div>
</div>

<?php include 'includes/x-footer.php';?>