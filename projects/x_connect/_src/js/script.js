console.log(batch['unity']['classes'][2]);
console.log('js is working');

var selectedBatch = document.getElementById('selectedBatch');
var addClassBtn = document.getElementById('addClassBtn');
var timetableResult = document.getElementById('timetableResult');
var statusBar = document.getElementById('statusBar');
var xhttp = new XMLHttpRequest();

// Update time table on change of batch
function updateTimeTable() {
  console.log('changed');
  var batchCode = selectedBatch.value;
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     timetableResult.innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "handler_timetable.php?action=updateTimeTable&batchId="+batchCode, true);  // open(method, url, async)
  xhttp.send();
}

// Add class on Submit btn click
function addClass() {
  console.log('clicked');
  var batchCode = document.getElementById('selectedBatch').value;
  var date = document.getElementById('selectedDate').value;
  var className = document.getElementById('selectedClass').value;
  var instructorCode = document.getElementById('selectedInstructor').value;
  var startTime = document.getElementById('selectedStartTime').value;
  var endTime = document.getElementById('selectedEndTime').value;
  var room = document.getElementById('selectedRoom').value;
  console.log(batchCode, date, className, instructorCode, startTime, endTime, room);

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     timetableResult.innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "handler_timetable.php", true);  // open(method, url, async)
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("action=addClass&batchCode="+batchCode+"&date="+date+"&className="+className+"&instructorCode="+instructorCode+"&startTime="+startTime+"&endTime="+endTime+"&room="+room);
}

selectedBatch.addEventListener('change', updateTimeTable, false);
addClassBtn.addEventListener('click', addClass, false);

updateTimeTable(selectedBatch);
