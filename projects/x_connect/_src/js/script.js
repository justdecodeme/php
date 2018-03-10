var xhttp = new XMLHttpRequest();

var selectedBatch = document.getElementById('selectedBatch');
var addClassBtn = document.getElementById('addClassBtn');
var deleteClassBtn = document.getElementById('deleteClass');
var timetableResult = document.getElementById('timetableResult');

var batchCode = null;
var batchTemplate = null;
var selectedClassEl = document.getElementById('selectedClass');
var selectedInstructorEL = document.getElementById('selectedInstructor');
var selectedRoomEL = document.getElementById('selectedRoom');

// Update time table on change of batch
function updateTimeTable(e) {
  if(e.target) {
    batchCode = e.target.value;
  } else {
    batchCode = selectedBatch.value;
  }
  // check which batch template needs to be used
  batchTemplate = document.querySelector("[value='"+batchCode+"']").dataset.template;

  // load classses from json, based on batch template selected
  var classesObj = batchData[batchTemplate]['classes'];
  var classesList = '';

  for (var classCode in classesObj) {
    classesList += '<option value="'+classCode+'">'+classesObj[classCode]+'</option>';
  }
  selectedClassEl.innerHTML = classesList;

  // load instructors from json, based on batch template selected
  var instructorsObj = batchData[batchTemplate]['instructors'];
  var instructorsList = '';

  for (var instructorCode in instructorsObj) {
    instructorsList += '<option value="'+instructorCode+'">'+instructorsObj[instructorCode]+'</option>';
  }
  selectedInstructorEL.innerHTML = instructorsList;

  // load rooms from json, based on batch template selected
  var roomsObj = batchData[batchTemplate]['rooms'];
  var roomsList = '';

  for (var roomCode in roomsObj) {
    roomsList += '<option value="'+roomCode+'">'+roomsObj[roomCode]+'</option>';
  }
  selectedRoomEL.innerHTML = roomsList;

  // load content from database
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     timetableResult.innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "handler_timetable.php?action=updateTimeTable&batchCode="+batchCode+"&batchTemplate="+batchTemplate, true);  // open(method, url, async)
  xhttp.send();
}

// Add class on Submit btn click
function addClass() {
  console.log('adding');
  var date = document.getElementById('selectedDate').value;
  var classCode = document.getElementById('selectedClass').value;
  var instructorCode = document.getElementById('selectedInstructor').value;
  var startTime = document.getElementById('selectedStartTime').value;
  var endTime = document.getElementById('selectedEndTime').value;
  var roomCode = document.getElementById('selectedRoom').value;
  // console.log(batchCode, batchTemplate, date, classCode, instructorCode, startTime, endTime, roomCode);

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     timetableResult.innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "handler_timetable.php", true);  // open(method, url, async)
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("action=addClass&batchCode="+batchCode+"&batchTemplate="+batchTemplate+"&date="+date+"&classCode="+classCode+"&instructorCode="+instructorCode+"&startTime="+startTime+"&endTime="+endTime+"&roomCode="+roomCode);
}

// Delete class on Submit btn click
function deleteClass(e) {
  e.stopPropagation();
  if(e.target.id == 'deleteClass') {
    var deleteId = e.target.dataset.classId;
    console.log('deleting: ' + deleteId);
    // console.log(deleteId);

    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       timetableResult.innerHTML = this.responseText;
      }
    };

    var deleteConfirmation = confirm("Want to delete?");
    if (deleteConfirmation) {
        //Logic to delete the item
        xhttp.open("POST", "handler_timetable.php", true);  // open(method, url, async)
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("action=deleteClass&batchCode="+batchCode+"&batchTemplate="+batchTemplate+"&deleteId="+deleteId);
    } else {
      console.log('Deletion is stopped!');
    }

  } else if(e.target.id = 'editClass') {
    console.log('editing: ' + e.target.dataset.classId);
  }
}


selectedBatch.addEventListener('change', updateTimeTable, false);
addClassBtn.addEventListener('click', addClass, false);
timetableResult.addEventListener('click', deleteClass, false);

// run on page laod
updateTimeTable(selectedBatch);
