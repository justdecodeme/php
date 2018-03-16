<?php
  include 'includes/connect.php';
  include 'includes/header.php';
  include 'includes/template_reader.php';
  // include 'includes/login_status.php';
?>

<div class="container" id="attendanceOuter">
  <h2>Attendance</h2>
  <hr>

  <div class="row">
    <div class="col-md-3">
      <form class="form-block">
        <label for="selectedBatch">Select Batch</label>
        <select class="custom-select my-1" id="currentBatch">
          <option value="bc180305" data-template="bootcamp" selected>bc180305 (Bootcamp)</option>
          <option value="u180325" data-template="unity">u180325 (Unity)</option>
          <option value="gr180325" data-template="graphic" >gr180325 (Graphic Design)</option>
          <option value="php180325" data-template="php" >php180325 (PHP & MySQL)</option>
        </select>
      </form>
    </div>
    <div class="col-md-2">
      <form class="form-block">
        <label for="selectedBatch">Select Class</label>
        <select class="custom-select my-1" id="currentClass">
          <option value="bc1">BC 1</option>
          <option value="bc2">BC 2</option>
          <option value="bc3">BC 3</option>
          <option value="bc4">BC 4</option>
        </select>
      </form>
    </div>
    <div class="col-md-3">
      <label for="selectedBatch">Timing</label>
      <form class="form-block" style="display: flex;">
        <input type="time" disabled class="form-control" id="startClassTime" value="11:00" style="margin-right: 10px;">
        <input type="time" disabled class="form-control" id="endClassTime" value="13:00">
      </form>
    </div>
    <div class="col-md-3">
      <form class="form-block">
        <!-- <label for="selectedBatch">Select Students Present</label> -->
        <!-- <select class="custom-select my-1" id="selectedBatch"> -->
        <!-- <select id="selectedBatch" class="multiselect-ui form-control" multiple="multiple">
          <option value="std130308" selected>Nagraj</option>
          <option value="std130301" selected>Sachin</option>
          <option value="std130208" selected>Bhagya</option>
          <option value="std130108" selected>Amit</option>
        </select> -->
      </form>

    <div class="button-group">
      <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> <span class="caret"></span></button>
      <ul class="dropdown-menu">
       <li><a href="#" class="small" data-value="option1" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 1</a></li>
       <li><a href="#" class="small" data-value="option2" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 2</a></li>
       <li><a href="#" class="small" data-value="option3" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 3</a></li>
       <li><a href="#" class="small" data-value="option4" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 4</a></li>
       <li><a href="#" class="small" data-value="option5" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 5</a></li>
       <li><a href="#" class="small" data-value="option6" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 6</a></li>
      </ul>
     </div>


    </div>
    <div class="col-md-1">
      <label style="visibility: hidden;">.</label>
      <button class="btn btn-outline-danger">Submit</button>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

<script type="text/javascript">
var options = [];

$( '.dropdown-menu a' ).on( 'click', function( event ) {

   var $target = $( event.currentTarget ),
       val = $target.attr( 'data-value' ),
       $inp = $target.find( 'input' ),
       idx;

   if ( ( idx = options.indexOf( val ) ) > -1 ) {
      options.splice( idx, 1 );
      setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
   } else {
      options.push( val );
      setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
   }

   $( event.target ).blur();

   console.log( options );
   return false;
});

</script>
