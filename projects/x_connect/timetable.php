<?php
  include 'includes/connect.php';
  include 'includes/header.php';
  // include 'includes/login_status.php';
?>

<div class="container">
  <h2>Time Table</h2>
  <hr>
  <div class="row">
    <div class="col-md-4">
      <form class="form-inline">
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Select Batch</label>
          <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
            <option value="bc180305">bc180305 (Bootcamp)</option>
            <option value="unity180325">unity180325 (Unity)</option>
            <option value="gr180325" selected>gr180325 (Graphic Design)</option>
          </select>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <table class="table table-bordered" style="margin-top: 10px;">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Date</th>
            <th scope="col">Class</th>
            <th scope="col">Instructor</th>
            <th scope="col">Time</th>
            <th scope="col">Room</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>25 Mar 18</td>
            <td>GR01</td>
            <td>Rakesh</td>
            <td>11:30 AM - 01:30 PM</td>
            <td>A</td>
            <td><a class="text-danger" href="#">Edit</a> | <a class="text-danger" href="#">Delete</a></td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>01 Apr 18</td>
            <td>GR02</td>
            <td>Vinay</td>
            <td>09:00 AM - 11:00 AM</td>
            <td>A</td>
            <td><a class="text-danger" href="#">Edit</a> | <a class="text-danger" href="#">Delete</a></td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>01 Apr 18</td>
            <td>GR03</td>
            <td>Varsha</td>
            <td>11:30 AM - 01:30 PM</td>
            <td>A</td>
            <td><a class="text-danger" href="#">Edit</a> | <a class="text-danger" href="#">Delete</a></td>
          </tr>
          <tr>
            <th scope="row">4</th>
            <td>08 Apr 18</td>
            <td>GR01 - GR03(Practice)</td>
            <td>Vinay</td>
            <td>09:30 PM - 11:30 AM</td>
            <td>A</td>
            <td><a class="text-danger" href="#">Edit</a> | <a class="text-danger" href="#">Delete</a></td>
          </tr>
          <tr>
            <th scope="row">5</th>
            <td>08 Apr 18</td>
            <td>GR04</td>
            <td>Pallavi</td>
            <td>11:30 PM - 01:30 PM</td>
            <td>A</td>
            <td><a class="text-danger" href="#">Edit</a> | <a class="text-danger" href="#">Delete</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
