/****************Variables****************/

var timetableOuter = document.getElementById('timetableOuter');
var selectedDateOuter = document.getElementById('selectedDateOuter');
var selectedBatchOuter = document.getElementById('selectedBatchOuter');
var orderByItems = document.querySelectorAll('[data-order-by]');
var filterStartDate = document.getElementById('filterStartDate');
var filterEndDate = document.getElementById('filterEndDate');

var selectedBatch = document.getElementById('selectedBatch');
var selectedLayout = document.getElementById('selectedLayout');

var addClassBtn = document.getElementById('addClassBtn');

var timetableResultList = document.getElementById('timetableResultList');
var timetableResultGrid_A = document.getElementById('timetableResultGrid_A');
var timetableResultGrid_B = document.getElementById('timetableResultGrid_B');

var selectedClassEl = document.getElementById('selectedClass');
var selectedInstructorEL = document.getElementById('selectedInstructor');
var selectedRoomEL = document.getElementById('selectedRoom');

var editingClassFlag = false;
var batchCode = null;
var batchTemplate = null;
var layout = 'list';
var orderBy = 'date';
var ascOrDesc = 'ASC';

/****************Functions****************/

// Update time table on change of batch
function updateTimeTableList() {
  console.log('timetable list updating...');

  editingClassFlag = false;

  // check which batch is selected in dropdown
  batchCode = selectedBatch.value;

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
  xhttp1.open("GET", "timetable_handler.php?action=updateTimeTableList&batchCode="+batchCode+"&batchTemplate="+batchTemplate+"&orderBy="+orderBy+"&ascOrDesc="+ascOrDesc, true);  // open(method, url, async)
  xhttp1.send();
}

// Update time table on change of batch
function updateTimeTableGrid() {
  console.log('timetable grid updating...');
  var filterStartDate = document.getElementById('filterStartDate').value;
  var filterEndDate = document.getElementById('filterEndDate').value;

  // load content from database
  var xhttp2a = new XMLHttpRequest();
  xhttp2a.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     timetableResultGrid_A.innerHTML = this.responseText;
     // 
     // // for(let r = 0; r < timetableResultGrid_A.querySelectorAll('tr').length; r++) {
     // for(let r = 0; r < 1; r++) {
     //   // for(let c = 1; c < timetableResultGrid_A.querySelectorAll('tr')[r].querySelectorAll('td').length; c++) {
     //   for(let c = 1; c < 2; c++) {
     //     let col = timetableResultGrid_A.querySelectorAll('tr')[0].querySelectorAll('td')[c];
     //     console.log(col);
     //   }
     // }

   } else {
     // console.log(this.readyState, this.status);
   }
  };
  xhttp2a.open("GET", "timetable_handler.php?action=updateTimeTableGrid_A&filterStartDate="+filterStartDate+"&filterEndDate="+filterEndDate, true);  // open(method, url, async)
  xhttp2a.send();

  // load content from database
  var xhttp2b = new XMLHttpRequest();
  xhttp2b.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     timetableResultGrid_B.innerHTML = this.responseText;
   } else {
     // console.log(this.readyState, this.status);
   }
  };
  xhttp2b.open("GET", "timetable_handler.php?action=updateTimeTableGrid_B&filterStartDate="+filterStartDate+"&filterEndDate="+filterEndDate, true);  // open(method, url, async)
  xhttp2b.send();
}

// Add class on Submit btn click
function addClass() {
  if(!editingClassFlag) {
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
    xhttp3.open("POST", "timetable_handler.php", true);  // open(method, url, async)
    xhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp3.send("action=addClass&batchCode="+batchCode+"&batchTemplate="+batchTemplate+"&orderBy="+orderBy+"&ascOrDesc="+ascOrDesc+"&date="+date+"&classCode="+classCode+"&instructorCode="+instructorCode+"&startTime="+startTime+"&endTime="+endTime+"&roomCode="+roomCode);
  }
}

// Edit -> Delete -> Cancel -> Submit class fuctions
function individualClassEdit(e) {
  e.stopPropagation();
  // delete class -> only if not editing any class
  if(e.target.id == 'deleteClass' && !editingClassFlag) {
    var deleteCalssId = e.target.dataset.classId;
    console.log('deleting: ' + deleteCalssId);

    var xhttp4 = new XMLHttpRequest();
    xhttp4.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       timetableResultList.innerHTML = this.responseText;
      }
    };

    var deleteConfirmation = confirm("Want to delete?");
    if (deleteConfirmation) {
        //Logic to delete the item
        xhttp4.open("POST", "timetable_handler.php", true);  // open(method, url, async)
        xhttp4.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp4.send("action=deleteClass&batchCode="+batchCode+"&batchTemplate="+batchTemplate+"&orderBy="+orderBy+"&ascOrDesc="+ascOrDesc+"&deleteId="+deleteCalssId);
    } else {
      console.log('Deletion is stopped!');
    }
  }
  // edit class -> only if not editing any class
  else if(e.target.id == 'editClass' && !editingClassFlag) {
    var editClassId = e.target.dataset.classId;
    console.log('editing: ' + editClassId);

    editingClassFlag = true;

    var elementEditing = document.getElementById('editClass_'+editClassId);
    var elementEditingDate = elementEditing.querySelector('.edit-date');
    var elementEditingClass = elementEditing.querySelector('.edit-class');
    var elementEditingInstructor = elementEditing.querySelector('.edit-instructor');
    var elementEditingTime = elementEditing.querySelector('.edit-time');
    var elementEditingRoom = elementEditing.querySelector('.edit-room');

    elementEditing.classList.add('editing-class');
    elementEditingDate.innerHTML = '<input type="date" class="form-control" id="editingDate" value="'+elementEditingDate.dataset.date+'">';
    elementEditingTime.classList.add('time-picker');
    elementEditingTime.innerHTML = '<input type="time" class="form-control" id="editingStartTime" value="'+elementEditingTime.dataset.starttime+'"><input type="time" class="form-control" id="editingEndTime" value="'+elementEditingTime.dataset.endtime+'">';

    // load classses from json, based on batch template selected
    var classesObj = batchData[batchTemplate]['classes'];
    var classesList = '';
    for (var classCode in classesObj) {
      if(classCode == elementEditingClass.dataset.class) {
        classesList += '<option value="'+classCode+'" selected>'+classesObj[classCode]+'</option>';
      } else {
        classesList += '<option value="'+classCode+'">'+classesObj[classCode]+'</option>';
      }
    }
    elementEditingClass.innerHTML = '<select class="custom-select" id="editingClass">'+classesList+'</select>';;

    // load instructors from json, based on batch template selected
    var instructorsObj = batchData[batchTemplate]['instructors'];
    var instructorsList = '';

    for (var instructorCode in instructorsObj) {
      if(instructorCode == elementEditingInstructor.dataset.instructor) {
        instructorsList += '<option value="'+instructorCode+'" selected>'+instructorsObj[instructorCode]+'</option>';
      } else {
        instructorsList += '<option value="'+instructorCode+'">'+instructorsObj[instructorCode]+'</option>';
      }
    }
    elementEditingInstructor.innerHTML = '<select class="custom-select" id="editingInstructors">'+instructorsList+'</select>';;

    // load rooms from json, based on batch template selected
    var roomsObj = batchData[batchTemplate]['rooms'];
    var roomsList = '';

    for (var roomCode in roomsObj) {
      if(roomCode == elementEditingRoom.dataset.room) {
        roomsList += '<option value="'+roomCode+'" selected>'+roomsObj[roomCode]+'</option>';
      } else {
        roomsList += '<option value="'+roomCode+'">'+roomsObj[roomCode]+'</option>';
      }
    }
    elementEditingRoom.innerHTML = '<select class="custom-select" id="editingRoom">'+roomsList+'</select>';
  }
  // cancel class -> if editing any class
  else if(e.target.id == 'cancelClass' && editingClassFlag) {
    var cancelClassId = e.target.dataset.classId;
    console.log('cancelling: ' + cancelClassId);

    updateTimeTableList();
  }
  // submit class -> if editing any class
  else if(e.target.id == 'submitClass' && editingClassFlag) {
    var submitClassId = e.target.dataset.classId;
    console.log('submitting: ' + submitClassId);

    var date = document.getElementById('editingDate').value;
    var classCode = document.getElementById('editingClass').value;
    var instructorCode = document.getElementById('editingInstructors').value;
    var startTime = document.getElementById('editingStartTime').value;
    var endTime = document.getElementById('editingEndTime').value;
    var roomCode = document.getElementById('editingRoom').value;
    // console.log(batchCode, batchTemplate, date, classCode, instructorCode, startTime, endTime, roomCode);

    var xhttp5 = new XMLHttpRequest();
    xhttp5.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        timetableResultList.innerHTML = this.responseText;
        editingClassFlag = false;
      }
    };
    xhttp5.open("POST", "timetable_handler.php", true);  // open(method, url, async)
    xhttp5.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp5.send("action=submitClass&batchCode="+batchCode+"&batchTemplate="+batchTemplate+"&orderBy="+orderBy+
    "&ascOrDesc="+ascOrDesc+"&date="+date+"&classCode="+classCode+"&instructorCode="+instructorCode+
    "&startTime="+startTime+"&endTime="+endTime+"&roomCode="+roomCode+"&submitId="+submitClassId);

    // updateTimeTableList();
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

// function to order tables on click
function orderClassBy(e) {
  var prevOrderBy = orderBy;

  // remove active class from all columns
  for(var i = 0; i < orderByItems.length; i++) {
    orderByItems[i].classList.remove('active-ASC');
    orderByItems[i].classList.remove('active-DESC');
  }

  orderBy = e.target.dataset.orderBy;

  // toggle ASC | DESC if column clicked is same as previous click
  if(prevOrderBy == orderBy) {
    if(ascOrDesc == 'DESC') {
      ascOrDesc = 'ASC';
    } else {
      ascOrDesc = 'DESC';
    }
    // make ASC if column clicked is different from previous click
  } else {
    ascOrDesc = 'ASC';
  }

  // add active class to clicked column
  e.target.classList.add('active-'+ascOrDesc);

  console.log('ordering by...' + orderBy, ascOrDesc);

  updateTimeTableList();
}

// run on page laod
function init() {
  selectedDate.value = currentDate();
  // filterStartDate.value = currentDate();
  filterStartDate.value = "2018-03-05";
  filterEndDate.value = "2018-03-25";
  updateTimeTableList(selectedBatch);
  updateTimeTableGrid();
  updateLayout(selectedLayout);
};
init();

/****************Events****************/

selectedBatch.addEventListener('change', updateTimeTableList, false);
filterStartDate.addEventListener('change', updateTimeTableGrid, false);
filterEndDate.addEventListener('change', updateTimeTableGrid, false);
selectedLayout.addEventListener('change', updateLayout, false);
addClassBtn.addEventListener('click', addClass, false);
timetableResultList.addEventListener('click', individualClassEdit, false);
for(var i = 0; i < orderByItems.length; i++) {
  orderByItems[i].addEventListener('click', orderClassBy, false);
}
