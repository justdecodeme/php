/****************Variables****************/

// var timetableOuter = document.getElementById('timetableOuter');
// var selectedDateOuter = document.getElementById('selectedDateOuter');
// var selectedBatchOuter = document.getElementById('selectedBatchOuter');
var orderByItems = document.querySelectorAll('[data-order-by]');
// var filterStartDate = document.getElementById('filterStartDate');
// var filterEndDate = document.getElementById('filterEndDate');
//
var selectedTotal = document.getElementById('selectedTotal');
var selectedBatch = document.getElementById('selectedBatch');
var selectedRole = document.getElementById('selectedRole');
var selectedGender = document.getElementById('selectedGender');
var selectedDOJ = document.getElementById('selectedDOJ');
var selectedSearch = document.getElementById('selectedSearch');
//
// var addClassBtn = document.getElementById('addClassBtn');
//
var usersResultList = document.getElementById('usersResultList');
//
// var selectedClassEl = document.getElementById('selectedClass');
// var selectedInstructorEL = document.getElementById('selectedInstructor');
// var selectedRoomEL = document.getElementById('selectedRoom');
//
var editingUserFlag = false;
var batchCode = role = gender = null;
// var layout = 'list';
var orderBy = 'doj';
var ascOrDesc = 'ASC';

/****************Functions****************/

// Update users list
function updateUsersList() {
  console.log('users list updating...');

  editingUserFlag = false;

  // check which batch is selected in dropdown
  batchCode = selectedBatch.value;
  role = selectedRole.value;
  gender = selectedGender.value;
  doj = selectedDOJ.value;
  search = selectedSearch.value;

  // load content from database
  var xhttp1 = new XMLHttpRequest();
  xhttp1.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     usersResultList.innerHTML = this.responseText;
     // count the total number of rows return
     selectedTotal.value = usersResultList.getElementsByTagName('tr').length;
   } else {
     // console.log(this.readyState, this.status);
   }
  };
  xhttp1.open("GET", "users_handler.php?action=updateUsersList&batchCode="+batchCode+
    "&role="+role+
    "&gender="+gender+
    "&orderBy="+orderBy+
    "&doj="+doj+
    "&search="+search+
    "&ascOrDesc="+ascOrDesc, true);
  xhttp1.send();
}

// Edit -> Delete -> Cancel -> Submit users fuctions
function individualEdit(e) {
  e.stopPropagation();
  // delete class -> only if not editing any class
  if(e.target.id == 'delete' && !editingUserFlag) {
    var deleteId = e.target.dataset.id;
    console.log('deleting: ' + deleteId);

    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       usersResultList.innerHTML = this.responseText;
      }
    };

    var deleteConfirmation = confirm("Want to delete?");
    if (deleteConfirmation) {
      //Logic to delete the item
      xhttp2.open("POST", "users_handler.php", true);  // open(method, url, async)
      xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp2.send("action=delete&batchCode="+batchCode+
        "&role="+role+
        "&gender="+gender+
        "&doj="+doj+
        "&deleteId="+deleteId+
        "&search="+search+
        "&orderBy="+orderBy+
        "&ascOrDesc="+ascOrDesc, true);
    } else {
      console.log('Deletion is stopped!');
    }
  }
  // edit class -> only if not editing any class
  else if(e.target.id == 'editUser' && !editingUserFlag) {
    var editClassId = e.target.dataset.classId;
    console.log('editing: ' + editClassId);

    editingUserFlag = true;

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
  else if(e.target.id == 'cancelUser' && editingUserFlag) {
    var cancelClassId = e.target.dataset.classId;
    console.log('cancelling: ' + cancelClassId);

    updateTimeTableList();
  }
  // submit class -> if editing any class
  else if(e.target.id == 'submitUser' && editingUserFlag) {
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
        usersResultList.innerHTML = this.responseText;
        editingUserFlag = false;
      }
    };
    xhttp5.open("POST", "users_handler.php", true);  // open(method, url, async)
    xhttp5.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp5.send("action=submitClass&batchCode="+batchCode+"&batchTemplate="+batchTemplate+"&orderBy="+orderBy+
    "&ascOrDesc="+ascOrDesc+"&date="+date+"&classCode="+classCode+"&instructorCode="+instructorCode+
    "&startTime="+startTime+"&endTime="+endTime+"&roomCode="+roomCode+"&submitId="+submitClassId);

    // updateTimeTableList();
  }
}

// function to order tables on click
function orderUsersBy(e) {
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

  updateUsersList();
}


// run on page laod
function init() {
  updateUsersList();
};
init();

/****************Events****************/
selectedBatch.addEventListener('change', updateUsersList, false);
selectedRole.addEventListener('change', updateUsersList, false);
selectedGender.addEventListener('change', updateUsersList, false);
selectedDOJ.addEventListener('change', updateUsersList, false);
selectedSearch.addEventListener('keyup', updateUsersList, false);
usersResultList.addEventListener('click', individualEdit, false);
for(var i = 0; i < orderByItems.length; i++) {
  orderByItems[i].addEventListener('click', orderUsersBy, false);
}
