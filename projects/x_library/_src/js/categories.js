var xhttp = null;
var isEditing = false;

// Edit -> Delete -> Cancel -> Submit functions
function individualOperations(e) {
  e.stopPropagation();
  // delete -> only if not editing any other
  if(e.target.id == 'deleteBtn' && !isEditing) {
    var deleteId = e.target.dataset.id;
    console.log('deleting: ' + deleteId);

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       categoriesListContainer.innerHTML = this.responseText;
     } else {
       // console.log(this.readyState, this.status);
     }
    };

    var deleteConfirmation = confirm("Want to delete?");
    if (deleteConfirmation) {
        //Logic to delete the item
        xhttp.open("POST", "categories_handler.php", true);  // open(method, url, async)
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("action=delete&deleteId="+deleteId);
    } else {
      console.log('Deletion is stopped!');
    }
  }
  // edit class -> only if not editing any class
  else if(e.target.id == 'editBtn' && !isEditing) {
    isEditing = true;
    var editId = e.target.dataset.id;
    console.log('editing: ' + editId);

    var parent = e.target.parentNode.parentNode;
    var code = parent.querySelector('.code');
    var name = parent.querySelector('.name');
    var codeValue = code.innerHTML;
    var nameValue = name.innerHTML;

    parent.classList.add('editing-class');
    code.innerHTML = '<input type="text" class="form-control" id="newCode" value="'+codeValue+'">';
    name.innerHTML = '<input type="text" class="form-control" id="newName" value="'+nameValue+'">';
  }
  // cancel class -> if editing any class
  else if(e.target.id == 'cancelBtn' && isEditing) {
    isEditing = false;
    var cancelId = e.target.dataset.id;
    console.log('cancelling: ' + cancelId);

    fetchCategories();
  }
  // submit class -> if editing any class
  else if(e.target.id == 'submitClass' && isEditing) {
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
        isEditing = false;
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

// fetch the categories list
function fetchCategories() {
  console.log('fetching categories list...');
  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     categoriesListContainer.innerHTML = this.responseText;
   } else {
     // console.log(this.readyState, this.status);
   }
  };
  xhttp.open("GET", "categories_handler.php?action=fetchCategories", true);  // open(method, url, async)
  xhttp.send();
  xhttp = null;
}

// run on page laod
function init() {
  fetchCategories();
};
init();

categoriesListContainer.addEventListener('click', individualOperations, false);
