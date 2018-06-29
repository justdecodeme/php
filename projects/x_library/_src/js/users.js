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
  // delete user -> only if not editing any user
  if(e.target.id == 'delete' && !editingUserFlag) {
    var deleteId = e.target.dataset.id;
    console.log('deleting: ' + deleteId);

    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       usersResultList.innerHTML = this.responseText;
       // count the total number of rows return
       selectedTotal.value = usersResultList.getElementsByTagName('tr').length;
     } else {
       console.log(this.status);
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
  else if(e.target.id == 'edit' && !editingUserFlag) {
    var editId = e.target.dataset.id;
    console.log('editing: ' + editId);

    editingUserFlag = true;

    var elementEditing = document.getElementById('edit_'+editId);
    var elementEditingRole = elementEditing.querySelector('.edit-role');
    var elementEditingStudentCode = elementEditing.querySelector('.edit-student-code');

    elementEditing.classList.add('editing-class');
    elementEditingStudentCode.innerHTML = '<input type="text" class="form-control" id="editingStudentCode" value="'+elementEditingStudentCode.dataset.studentCode+'">';

    elementEditingRole.innerHTML = `
      <select class="custom-select my-1" id="editingRole">
        <option value="instructor">Instructor</option>
        <option value="student">Students</option>
        <option value="subscriber" selected>Subscriber</option>
      </select>`;
  }
  // cancel user -> if editing any user
  else if(e.target.id == 'cancel' && editingUserFlag) {
    var cancelId = e.target.dataset.id;
    console.log('cancelling: ' + cancelId);

    updateUsersList();
  }
  // submit class -> if editing any class
  else if(e.target.id == 'submit' && editingUserFlag) {
    var submitId = e.target.dataset.id;
    console.log('submitting: ' + submitId);

    var role = document.getElementById('editingRole').value;
    var studentCode = document.getElementById('editingStudentCode').value;
    // console.log(batchCode, batchTemplate, role, studentCode);

    var xhttp3 = new XMLHttpRequest();
    xhttp3.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        usersResultList.innerHTML = this.responseText;
        editingUserFlag = false;
      }
    };
    xhttp3.open("POST", "users_handler.php", true);  // open(method, url, async)
    xhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp3.send("action=submitClass&batchCode="+batchCode+"&batchTemplate="+batchTemplate+"&orderBy="+orderBy+
    "&ascOrDesc="+ascOrDesc+"&date="+date+"&classCode="+classCode+"&instructorCode="+instructorCode+
    "&startTime="+startTime+"&endTime="+endTime+"&roomCode="+roomCode+"&submitId="+submitId);

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
