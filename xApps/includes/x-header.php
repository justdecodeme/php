<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>xApps by xLab</title>
    <link rel="stylesheet" href="./_assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./_assets/css/style.min.css">
    <link rel="shortcut icon" href="./_assets/images/favicon.ico">
    <script src="./_assets/js/jquery-3.3.1.min.js" charset="utf-8"></script>
    <script src="./_assets/js/bootstrap.min.js" charset="utf-8"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark main-navigation">
      <div class="container">
        <a class="navbar-brand" href="x-apps.php">xApps</a>
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
                    <a href="profile.php" class="dropdown-item">View Profile</a>
                    <a href="profile-edit.php" class="dropdown-item">Edit Profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="includes/logout.php" class="dropdown-item">Logout</a>
                  </div>
                </li>
              </ul>
              ';
            } else {
              echo '
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="x-login.php">Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="x-signup.php">Signup</a>
                  </li>
                </ul>
              ';
            }
          ?>
        </div>
      </div>
    </nav>
