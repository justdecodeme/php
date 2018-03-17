/****************Variables****************/

var selectedDateOuter = document.getElementById('selectedDateOuter');
var orderByItems = document.querySelectorAll('[data-order-by]');

var addBatchBtn = document.getElementById('addBatchBtn');

var timetableBatchList = document.getElementById('timetableBatchList');

var selectedClassEl = document.getElementById('selectedClass');
var selectedInstructorEL = document.getElementById('selectedInstructor');
var selectedRoomEL = document.getElementById('selectedRoom');

var editingClassFlag = false;
var orderBy = 'batch_start_date';
var ascOrDesc = 'ASC';

/****************Functions****************/

// Update time table on change of batch
function updateBatchList() {
  console.log('batch list updating...');

  editingClassFlag = false;

  // load content from database
  var xhttp1 = new XMLHttpRequest();
  xhttp1.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     timetableBatchList.innerHTML = this.responseText;
   } else {
     // console.log(this.readyState, this.status);
   }
  };
  xhttp1.open("GET", "batch_handler.php?action=updateBatchList&orderBy="+orderBy+"&ascOrDesc="+ascOrDesc, true);  // open(method, url, async)
  xhttp1.send();
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
        timetableBatchList.innerHTML = this.responseText;
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
       timetableBatchList.innerHTML = this.responseText;
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

    updateBatchList();
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
        timetableBatchList.innerHTML = this.responseText;
        editingClassFlag = false;
      }
    };
    xhttp5.open("POST", "timetable_handler.php", true);  // open(method, url, async)
    xhttp5.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp5.send("action=submitClass&batchCode="+batchCode+"&batchTemplate="+batchTemplate+"&orderBy="+orderBy+
    "&ascOrDesc="+ascOrDesc+"&date="+date+"&classCode="+classCode+"&instructorCode="+instructorCode+
    "&startTime="+startTime+"&endTime="+endTime+"&roomCode="+roomCode+"&submitId="+submitClassId);
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

  updateBatchList();
}

// run on page laod
function init() {
  updateBatchList();
};
init();

/****************Events****************/
addBatchBtn.addEventListener('click', addClass, false);
timetableBatchList.addEventListener('click', individualClassEdit, false);
for(var i = 0; i < orderByItems.length; i++) {
  orderByItems[i].addEventListener('click', orderClassBy, false);
}
