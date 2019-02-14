<?php
$bodyClass = "x-quote-admin";

include 'includes/init.php';
include 'includes/login-status.php';
include 'includes/x-header.php';
?>

<div class="container-fluid">

  <div class="row">

    <div class="col-md-10">
      <!-- quote of the day -->
      <div class="quote d-none" id="todaysQuoteSection">
        <div class="inner">
          <h1>Quote of the Day!</h1>
          <blockquote cite="https://www.huxley.net/bnw/four.html">
            <p>Words can be like X-rays, if you use them properly – they'll go through anything. You read and you're
              pierced.</p>
          </blockquote>
          <cite>– Aldous Huxley, Brave New World</cite>
        </div>
      </div>    
    
      <!-- quote listing -->
      <table class="table">
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

    <!-- admin panel -->
    <div class="col-md-2">
      <div class="list-group admin-panel">
        <button class="list-group-item list-group-item-action active">Admin Panel</button>
        <button id="toggleTodaysQuoteBtn" class="list-group-item list-group-item-action">Toggle Today's Quote</button>
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-secondary">Previous</button>
          <button type="button" class="btn btn-secondary btn-info">Next</button>
        </div>
        </a>
      </div>      
    </div>    

  </div>

</div>

<button id="querySuccessBtn" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target=".query-success">querySuccessBtn</button>
<button id="alreadyExistModalBtn" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target=".already-exist">alreadyExistModalBtn</button>
<button id="queryErrorBtn" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target=".query-error">queryErrorBtn</button>

<div class="modal fade query-success" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="alert alert-success" role="alert">Added and List updated!</div>
    </div>
  </div>
</div>
<div class="modal fade already-exist" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="alert alert-warning" role="alert">Already exist!</div>
    </div>
  </div>
</div>
<div class="modal fade query-error" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="alert alert-danger" role="alert">Query Error!</div>
    </div>
  </div>
</div>

<?php include 'includes/x-footer.php';?>
<script src="./_assets/js/x-quote.min.js"></script>