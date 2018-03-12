/********************/
/*    Variables     */
/********************/

var timetableOuter = document.getElementById('timetableOuter');
var selectedDateOuter = document.getElementById('selectedDateOuter');
var selectedBatchOuter = document.getElementById('selectedBatchOuter');

var filterStartDate = document.getElementById('filterStartDate');
var filterEndDate = document.getElementById('filterEndDate');

var selectedBatch = document.getElementById('selectedBatch');
var selectedLayout = document.getElementById('selectedLayout');

var addClassBtn = document.getElementById('addClassBtn');
var deleteClassBtn = document.getElementById('deleteClass');

var timetableResultList = document.getElementById('timetableResultList');
var timetableResultGrid = document.getElementById('timetableResultGrid');

var selectedClassEl = document.getElementById('selectedClass');
var selectedInstructorEL = document.getElementById('selectedInstructor');
var selectedRoomEL = document.getElementById('selectedRoom');

var batchCode = null;
var layout = 'list';

/********************/
/*    Functions     */
/********************/

// find current date
function currentDate() {
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();

  dd = (dd<10 ? "0" : "") + dd;
  mm = (mm<10 ? "0" : "") + mm;
  var today = yyyy+'-'+mm+'-'+dd;

  return today;
}

// Update time table on change of batch
function updateTimeTableList(e) {
  console.log('list updating...');
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
  var xhttp1 = new XMLHttpRequest();
  xhttp1.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     timetableResultList.innerHTML = this.responseText;
   } else {
     // console.log(this.readyState, this.status);
   }
  };
  xhttp1.open("GET", "handler_timetable.php?action=updateTimeTableList&batchCode="+batchCode+"&batchTemplate="+batchTemplate, true);  // open(method, url, async)
  xhttp1.send();
}

// Update time table on change of batch
function updateTimeTableGrid() {
  console.log('grid updating...');
  var filterStartDate = document.getElementById('filterStartDate').value;
  var filterEndDate = document.getElementById('filterEndDate').value;

  // load content from database
  var xhttp2 = new XMLHttpRequest();
  xhttp2.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     timetableResultGrid.innerHTML = this.responseText;
   } else {
     // console.log(this.readyState, this.status);
   }
  };
  xhttp2.open("GET", "handler_timetable.php?action=updateTimeTableGrid&filterStartDate="+filterStartDate+"&filterEndDate="+filterEndDate, true);  // open(method, url, async)
  xhttp2.send();
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

  var xhttp3 = new XMLHttpRequest();
  xhttp3.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     timetableResultList.innerHTML = this.responseText;
    }
  };
  xhttp3.open("POST", "handler_timetable.php", true);  // open(method, url, async)
  xhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp3.send("action=addClass&batchCode="+batchCode+"&batchTemplate="+batchTemplate+"&date="+date+"&classCode="+classCode+"&instructorCode="+instructorCode+"&startTime="+startTime+"&endTime="+endTime+"&roomCode="+roomCode);
}

// Delete class on Submit btn click
function deleteClass(e) {
  e.stopPropagation();
  if(e.target.id == 'deleteClass') {
    var deleteId = e.target.dataset.classId;
    console.log('deleting: ' + deleteId);
    // console.log(deleteId);

    var xhttp4 = new XMLHttpRequest();
    xhttp4.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       timetableResultList.innerHTML = this.responseText;
      }
    };

    var deleteConfirmation = confirm("Want to delete?");
    if (deleteConfirmation) {
        //Logic to delete the item
        xhttp4.open("POST", "handler_timetable.php", true);  // open(method, url, async)
        xhttp4.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp4.send("action=deleteClass&batchCode="+batchCode+"&batchTemplate="+batchTemplate+"&deleteId="+deleteId);
    } else {
      console.log('Deletion is stopped!');
    }

  } else if(e.target.id = 'editClass') {
    console.log('editing: ' + e.target.dataset.classId);
  }
}

// Update layout on change of list or grid
function updateLayout(e) {
  if(e.target) {
    layout = e.target.value;
  } else {
    layout = selectedLayout.value;
  }
  if(layout == 'list') {
    timetableOuter.classList.add('list');
    timetableOuter.classList.remove('grid');
  } else {
    timetableOuter.classList.add('grid');
    timetableOuter.classList.remove('list');
  }
}

// run on page laod
function init() {
  selectedDate.value = currentDate();
  // filterStartDate.value = currentDate();
  filterStartDate.value = "2018-03-02";
  filterEndDate.value = "2018-03-25";
  updateTimeTableList(selectedBatch);
  updateTimeTableGrid();
  updateLayout(selectedLayout);
};
init();

/********************/
/*    Events     */
/********************/
selectedBatch.addEventListener('change', updateTimeTableList, false);
filterStartDate.addEventListener('change', updateTimeTableGrid, false);
filterEndDate.addEventListener('change', updateTimeTableGrid, false);
selectedLayout.addEventListener('change', updateLayout, false);
addClassBtn.addEventListener('click', addClass, false);
timetableResultList.addEventListener('click', deleteClass, false);
