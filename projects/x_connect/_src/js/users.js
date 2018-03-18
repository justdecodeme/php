/****************Variables****************/

// var timetableOuter = document.getElementById('timetableOuter');
// var selectedDateOuter = document.getElementById('selectedDateOuter');
// var selectedBatchOuter = document.getElementById('selectedBatchOuter');
var orderByItems = document.querySelectorAll('[data-order-by]');
// var filterStartDate = document.getElementById('filterStartDate');
// var filterEndDate = document.getElementById('filterEndDate');
//
var selectedBatch = document.getElementById('selectedBatch');
var selectedRole = document.getElementById('selectedRole');
var selectedGender = document.getElementById('selectedGender');
var selectedDOJ = document.getElementById('selectedDOJ');
var selectedSearch = document.getElementById('selectedSearch');
//
// var addClassBtn = document.getElementById('addClassBtn');
//
// var timetableResultList = document.getElementById('timetableResultList');
// var timetableResultGrid_A = document.getElementById('timetableResultGrid_A');
// var timetableResultGrid_B = document.getElementById('timetableResultGrid_B');
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
selectedSearch.addEventListener('change', updateUsersList, false);
for(var i = 0; i < orderByItems.length; i++) {
  orderByItems[i].addEventListener('click', orderUsersBy, false);
}
