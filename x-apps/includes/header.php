<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo isset($title) ? $title : "xApps | xLab" ?></title>
    <link rel="stylesheet" href="/php/x-apps/_assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/php/x-apps/_assets/css/style.min.css">
    <link rel="shortcut icon" href="/php/x-apps/_assets/img/favicon.ico">
    <script src="/php/x-apps/_assets/js/jquery-3.3.1.min.js" charset="utf-8"></script>
    <script src="/php/x-apps/_assets/js/popper.js" charset="utf-8"></script>
    <script src="/php/x-apps/_assets/js/bootstrap.min.js" charset="utf-8"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  </head>
  <?php 
  $rootPath = $_SERVER['DOCUMENT_ROOT'].'/php/x-apps/';

  if(isset($bodyClass)) {
    echo "<body class='".$bodyClass."'>";
  } else {
    echo "<body>";
  }
  ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark main-navigation">
      <div class="container-fluid">
        <a class="navbar-brand" href="/php/x-apps/">xApps</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <?php
            if(isset($email) && $email !== '') {
              echo '
              <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle username" data-toggle="dropdown">'.$username.'</a>
                  <div class="dropdown-menu">
                    <a href="/php/x-apps/logout.php" class="dropdown-item">Logout</a>
                  </div>
                </li>
              </ul>
              ';
            } else {
              echo '
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="/php/x-apps/login.php">Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/php/x-apps/signup.php">Signup</a>
                  </li>
                </ul>
              ';
            }
          ?>
        </div>
      </div>
    </nav>
