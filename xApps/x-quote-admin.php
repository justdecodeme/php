<?php
$bodyClass = "x-quote-admin";

include 'includes/init.php';
include 'includes/login-status.php';
include 'includes/x-header.php';
?>

<div class="container-fluid">
  
  <div class="row">
    <div class="col-md-10">
      <div class="quote">
        <div class="inner">
          <h1>Quote of the Day!</h1>
          <blockquote cite="https://www.huxley.net/bnw/four.html">
            <p>Words can be like X-rays, if you use them properly – they'll go through anything. You read and you're
              pierced.</p>
          </blockquote>
          <cite>– Aldous Huxley, Brave New World</cite>
        </div>
      </div>
    </div>
    
    <div class="col-md-2">
      <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active">Admin Panel</a>
        <a href="#" class="list-group-item list-group-item-action">Quotes List</a>
        <a href="#" class="list-group-item list-group-item-action">Quotes categories</a>
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-secondary">Previous</button>
          <button type="button" class="btn btn-secondary btn-info">Next</button>
        </div>
        </a>
      </div>      
    </div>    
  </div>

  <div class="row">
    <div class="col-md-10">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Category</th>
            <th scope="col" style="width: 130px;">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Physology</td>
            <td>
              <button type="button" class="btn btn-success"><i class="far fa-edit"></i></button>
              <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>              
            </td>
          </tr>
          <tr>
            <th scope="row">1</th>
            <td><input type="text"></td>
            <td>
              <button type="button" class="btn btn-success"><i class="far fa-check-circle"></i></button>
              <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>              
            </td>
          </tr>
        </tbody>
      </table>      
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Quote</th>
            <th scope="col">Author</th>
            <th scope="col">Category</th>
            <th scope="col" style="width: 170px;">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Words can be like X-rays, if you use them properly – they'll go through anything. You read and you're pierced.</td>
            <td>Aldous Huxley, Brave New World</td>
            <td>Physology</td>
            <td>
              <button type="button" class="btn btn-success"><i class="far fa-edit"></i></button>
              <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>              
              <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Make it today's Quote"><i class="far fa-clock"></i></button>              
            </td>
          </tr>
          <tr>
            <th scope="row">1</th>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td>
              <select name="" id="">
                <option value="">Physcology</option>
                <option value="">Leadership</option>
                <option value="">Life</option>
              </select>
            </td>
            <td>
              <button type="button" class="btn btn-success"><i class="far fa-check-circle"></i></button>
              <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>              
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>

<?php include 'includes/x-footer.php';?>