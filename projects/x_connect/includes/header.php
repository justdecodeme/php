<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>xConnect by xLab</title>
    <link rel="stylesheet" href="./_assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./_assets/css/style.min.css">
    <script src="./_assets/js/jquery-3.3.1.min.js" charset="utf-8"></script>
    <script src="./_assets/js/popper.js" charset="utf-8"></script>
    <script src="./_assets/js/bootstrap.min.js" charset="utf-8"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <!-- <a class="navbar-brand" href="index.php">xConnect</a> -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php
          if(!isset($user_email)) {
            echo '
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="signup.php">Signup</a>
                </li>
              </ul>
            ';
          } else if(isset($user_email) && $user_email !== '') {
            echo '
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="profile.php">Profile (' . $user_email . ')</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="includes/logout.php">Logout</a>
              </li>
            </ul>
            ';
          }
        ?>
      </div>
    </nav>
