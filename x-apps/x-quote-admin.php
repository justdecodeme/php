<?php
$bodyClass = "x-quote-admin";

include 'includes/init.php';
include 'includes/login-status.php';
if(isset($role) && $role !== 'admin') {
  redirect('x-quote.php');
}
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
    
      <!-- quote listing -->
      <table class="table table-hover">
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
            <th scope="col">Quote</th>
            <th scope="col">Author</th>
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

<button id="statusModalBtn" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target=".status-modal">querySuccessBtn</button>
<div class="modal fade status-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div id="statusModalAlert" class="alert alert-success" role="alert">...</div>
    </div>
  </div>
</div>

<?php include 'includes/x-footer.php';?>
<script src="./_assets/js/x-quote.min.js"></script>
<script src="./_assets/js/x-quote-admin.min.js"></script>