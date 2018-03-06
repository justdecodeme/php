<?php include 'config.php' ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Real Time Chat System</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  </head>
  <body>
    <div class="wrapper">
      <div class="chat_wrapper">
        <div id="chat"></div>
        <form class="" action="index.php" method="post">
          <textarea name="message" rows="8" cols="80"></textarea>
        </form>
      </div>
    </div>

    <script src="script.js"></script>
  </body>
</html>
