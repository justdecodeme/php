<?php
$bodyClass = "x-quote";

include 'includes/init.php';
include 'includes/login-status.php';
include 'includes/x-header.php';
?>

<div class="container-fluid">
  <div class="row">
    
    <div class="col-md-12">
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

  </div>
</div>

<?php include 'includes/x-footer.php';?>
<script src="./_assets/js/x-quote.min.js"></script>