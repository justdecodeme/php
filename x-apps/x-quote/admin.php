<?php
$bodyClass = "x-quote-admin";
$title = 'xQuote | Admin';
$rootPath = $_SERVER['DOCUMENT_ROOT'] . '/php/x-apps/';


include $rootPath.'includes/init.php';
include $rootPath.'includes/login-status.php';

if(isset($role) && $role !== '1') {
  redirect($rootPath.'x-quote/');
}
include $rootPath.'includes/header.php';
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
    
      <!-- quote listing -->
      <table class="table table-hover common-table">
        <thead>
          <tr>
            <th scope="col" colspan="2">
              <div class="form-group">
                <input id="quoteInput" type="text" class="form-control" placeholder="Quote">
              </div>
            </th>
            <th scope="col" style="width: 250px;">
              <div class="form-group">
                <input id="authorInput" type="text" class="form-control" placeholder="Author">
              </div>
            </th>
            <th scope="col" style="width: 170px;">
              <button type="button" class="btn btn-success" id="addBtn">Add</button>
            </th>
          </tr>
          <tr>
            <th scope="col">#</th>
            <th scope="col" data-order-by="quote" class="order-by active-ASC">Quote <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col" data-order-by="author" class="order-by">Author <span class="down">↓</span><span class="up">↑</span></th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="list">
          <!--<tr>
            <th scope="row">1</th>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td>
              <button type="button" class="btn btn-success"><i class="far fa-check-circle"></i></button>
              <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>              
            </td>
          </tr> -->
        </tbody>
      </table>
    </div>

  </div>

</div>

<?php include $rootPath.'includes/footer.php';?>
<script src="/php/x-apps/_assets/js/quote.min.js"></script>
<script src="/php/x-apps/_assets/js/quote-admin.min.js"></script>