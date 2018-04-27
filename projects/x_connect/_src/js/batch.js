/****************Variables****************/

var selectedDateOuter = document.getElementById('selectedDateOuter');
var orderByItems = document.querySelectorAll('[data-order-by]');

var selectedBatchCode = document.getElementById('selectedBatchCode');
var selectedBatchName = document.getElementById('selectedBatchName');
var selectedBatchStartDate = document.getElementById('selectedBatchStartDate');
var selectedBatchEndDate = document.getElementById('selectedBatchEndDate');

var addBatchBtn = document.getElementById('addBatchBtn');

var timetableBatchList = document.getElementById('timetableBatchList');

var editingBatchFlag = false;
var orderBy = 'batch_name';
var ascOrDesc = 'ASC';

/****************Functions****************/

// Update time table on change of batch
function updateBatchList() {
  console.log('batch list updating...');

  editingBatchFlag = false;

  // load content from database
  var xhttp1 = new XMLHttpRequest();
  xhttp1.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     timetableBatchList.innerHTML = this.responseText;
     // clearning+updating fileds after successful addtion of batch
     selectedBatchCode.value = selectedBatchName.value = '';
   } else {
     // console.log(this.readyState, this.status);
   }
  };
  xhttp1.open("GET", "batch_handler.php?action=updateBatchList&orderBy="+orderBy+"&ascOrDesc="+ascOrDesc, true);  // open(method, url, async)
  xhttp1.send();
}

// Add class on Submit btn click
function addBatch() {
  if(!editingBatchFlag) {
    console.log('adding batch...');

    var batchCode = selectedBatchCode.value;
    var batchName = selectedBatchName.value;
    var batchStartDate = currentDate();
    var batchEndDate = currentDate();
    // console.log(batchCode, batchName, batchStartDate, batchEndDate, batchStuents);

    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // update batch list
        timetableBatchList.innerHTML = this.responseText;
      }
    };
    xhttp2.open("POST", "batch_handler.php", true);  // open(method, url, async)
    xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp2.send("action=addBatch&orderBy=" + orderBy +
      "&ascOrDesc=" + ascOrDesc +
      "&batchCode=" + batchCode +
      "&batchName=" + batchName +
      "&batchStartDate=" + batchStartDate +
      "&batchEndDate=" + batchEndDate
    );
  }
}

// Edit -> Delete -> Cancel -> Submit class fuctions
function individualBatchEdit(e) {
  e.stopPropagation();
  // delete batch -> only if not editing any batch
  if(e.target.id == 'deleteBatch' && !editingBatchFlag) {
    var deleteBatchId = e.target.dataset.batchId;
    console.log('deleting: ' + deleteBatchId);

    var xhttp3 = new XMLHttpRequest();
    xhttp3.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       timetableBatchList.innerHTML = this.responseText;
      }
    };

    var deleteConfirmation = confirm("Want to delete?");
    if (deleteConfirmation) {
        //Logic to delete the item
        xhttp3.open("POST", "batch_handler.php", true);  // open(method, url, async)
        xhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp3.send("action=deleteBatch&orderBy="+orderBy+"&ascOrDesc="+ascOrDesc+"&deleteId="+deleteBatchId);
    } else {
      console.log('Deletion is stopped!');
    }
  }
  // edit batch -> only if not editing any batch
  else if(e.target.id == 'editBatch' && !editingBatchFlag) {
    var editBatchId = e.target.dataset.batchId;
    console.log('editing: ' + editBatchId);

    editingBatchFlag = true;

    var elementEditing = document.getElementById('editBatch_'+editBatchId);
    var elementEditingCode = elementEditing.querySelector('.edit-batch-code');
    var elementEditingName = elementEditing.querySelector('.edit-batch-name');
    var elementEditingStartDate = elementEditing.querySelector('.edit-batch-start-date');
    var elementEditingEndDate = elementEditing.querySelector('.edit-batch-end-date');
    var elementEditingStudents = elementEditing.querySelector('.edit-batch-students');

    elementEditing.classList.add('editing-class');
    elementEditingCode.innerHTML = '<input type="text" class="form-control" id="editingCode" value="'+elementEditingCode.dataset.batchCode+'">';
    elementEditingName.innerHTML = '<input type="text" class="form-control" id="editingName" value="'+elementEditingName.dataset.batchName+'">';
    elementEditingStartDate.innerHTML = '<input type="date" class="form-control" id="editingStartDate" value="'+elementEditingStartDate.dataset.batchStartDate+'">';
    elementEditingEndDate.innerHTML = '<input type="date" class="form-control" id="editingEndDate" value="'+elementEditingEndDate.dataset.batchEndDate+'">';
    elementEditingStudents.innerHTML = '<input type="number" class="form-control" id="editingStudents" value="'+elementEditingStudents.dataset.batchStudents+'">';
  }
  // cancel batch -> if editing any batch
  else if(e.target.id == 'cancelBatch' && editingBatchFlag) {
    var cancelBatchId = e.target.dataset.batchId;
    console.log('cancelling: ' + cancelBatchId);
    updateBatchList();
  }
  // submit batch -> if editing any batch
  else if(e.target.id == 'submitBatch' && editingBatchFlag) {
    var submitBatchId = e.target.dataset.batchId;
    console.log('submitting: ' + submitBatchId);

    var batchCode = document.getElementById('editingCode').value;
    var batchName = document.getElementById('editingName').value;
    var batchStartDate = document.getElementById('editingStartDate').value;
    var batchEndDate = document.getElementById('editingEndDate').value;
    var batchStuents = document.getElementById('editingStudents').value;
    // console.log(batchCode, batchName, batchStartDate, batchEndDate, batchStuents);

    var xhttp4 = new XMLHttpRequest();
    xhttp4.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        timetableBatchList.innerHTML = this.responseText;
        editingBatchFlag = false;
      }
    };
    xhttp4.open("POST", "batch_handler.php", true);  // open(method, url, async)
    xhttp4.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp4.send("action=submitBatch&orderBy="+orderBy+"&ascOrDesc="+ascOrDesc+"&batchCode="+batchCode+
    "&batchName="+batchName+"&batchStartDate="+batchStartDate+"&batchEndDate="+batchEndDate+
    "&batchStuents="+batchStuents+"&submitId="+submitBatchId);
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
addBatchBtn.addEventListener('click', addBatch, false);
timetableBatchList.addEventListener('click', individualBatchEdit, false);
for(var i = 0; i < orderByItems.length; i++) {
  orderByItems[i].addEventListener('click', orderClassBy, false);
}
