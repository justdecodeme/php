<?php
$bodyClass = "x-quote";
$rootPath = $_SERVER['DOCUMENT_ROOT'].'/php/x-apps/';

include $rootPath.'includes/init.php';
include $rootPath.'includes/login-status.php';
include $rootPath.'includes/x-header.php';
?>

<!-- quote of the day -->
<div class="todays-quote" id="todaysQuoteSection">
  <h1>Quote of the Day!</h1>  
  <div class="content">
    <!-- <blockquote>
      <p>Words can be like X-rays, if you use them properly – they'll go through anything. You read and you're
        pierced.</p>
    </blockquote>
    <cite>– Aldous Huxley, Brave New World</cite> -->
  </div>
</div>  

<?php include $rootPath.'includes/x-footer.php';?>
<script src="/php/x-apps/_assets/js/x-quote.min.js"></script>
<script>
  setInterval(() => { getTodaysQuote(); }, 15000)
</script>