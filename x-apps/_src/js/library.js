/*****************************************/
//            variables
/*****************************************/

var list = document.getElementById('list');
var addBtn = document.getElementById('addBtn');

var orderListBy = document.querySelectorAll('[data-order-by]');

var statusModalBtn = document.getElementById('statusModalBtn');
var statusModalAlert = document.getElementById('statusModalAlert');

var borrowerSelect = document.getElementById('borrowerSelect');
var bookCategorySelect = document.getElementById('bookCategorySelect');
var bookSelect = document.getElementById('bookSelect');
var approvedBySelect = document.getElementById('approvedBySelect');
var issueDateInput = document.getElementById('issueDateInput');
var dueDateInput = document.getElementById('dueDateInput');
// var returnedDateInput = document.getElementById('returnedDateInput');
// var ConfirmedBySelect = document.getElementById('ConfirmedBySelect');

var orderBy = 'issue_date';
var ascOrDesc = 'ASC';
const numberOfDaysToAdd = 7;
const undef = undefined;

/*****************************************/
//            events
/*****************************************/

addBtn.addEventListener('click', add, false);
bookCategorySelect.addEventListener('change', (e) => {
  fetchBooksList(e, 'bookSelect', undef);
}, false);

list.addEventListener('click', listBtnFunction, false);

for (var i = 0; i < orderListBy.length; i++) {
  orderListBy[i].addEventListener('click', orderList, false);
}

/*****************************************/
//            functions
/*****************************************/

// run on page laod
function init() {
  // add `active-ASC` class to predefined element
  document.querySelector('[data-order-by="' + orderBy + '"]').classList.add('active-ASC');

  // fetch all the data required for assigning new books
  fetchBorrowersList('borrowerSelect', undef);
  fetchBooksList(undef, 'bookSelect', undef);
  fetchBookCategoriesList('bookCategorySelect', undef);
  fetchAdminsList('approvedBySelect', undef);
  fetchDates();

  updateList();
};
init();

function fetchBorrowersList(elId, value) {
  console.log('fetching borrowers list...');

  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById(elId).innerHTML = this.responseText;
      if(value !== undefined) {
        document.getElementById(elId).value = value;
      }
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("GET", "handler.php?action=fetchBorrowersList", true); // open(method, url, async)
  xhttp.send();
}
function fetchBooksList(e, elId, value) {
  var book_category_id = '';
  if (e) {
    var book_category_id = e;
    if (e.type == "change") {
      book_category_id = e.target.value;
    }
  }
  console.log('fetching books list...');

  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "NA") {
        document.getElementById(elId).innerHTML = "<option value=''>None</option>";
        document.getElementById(elId).setAttribute('disabled', 'true');
      } else {
        document.getElementById(elId).innerHTML = this.responseText;
        if (value !== undefined) {
          document.getElementById(elId).value = value;
        }
        document.getElementById(elId).removeAttribute('disabled');
      }
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("GET", "handler.php?action=fetchBooksList&book_category_id=" + book_category_id, true); // open(method, url, async)
  xhttp.send();
}
function fetchBookCategoriesList(elId, value) {
  console.log('fetching book categories list...');

  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById(elId).innerHTML = this.responseText;
      if (value !== undefined) {
        document.getElementById(elId).value = value;
      }
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("GET", "handler.php?action=fetchBookCategoriesList", true); // open(method, url, async)
  xhttp.send();
}
function fetchAdminsList(elId, value) {
  console.log('fetching admins list...');

  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById(elId).innerHTML = this.responseText;
      if (value !== undefined) {
        document.getElementById(elId).value = value;
      }
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("GET", "handler.php?action=fetchAdminsList", true); // open(method, url, async)
  xhttp.send();
}
function fetchDates() {
  console.log('fetching dates...');

  issueDateInput.value = getTodaysDate();
  dueDateInput.value = getDateAfterDays(numberOfDaysToAdd);
}

// update list
function updateList() {
  console.log('list updating...');

  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      list.innerHTML = this.responseText;
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("GET", "handler.php?action=updateList" +
    "&orderBy=" + orderBy +
    "&ascOrDesc=" + ascOrDesc, true);
  xhttp.send();
}

// add on `Add` button click
function add() {
  console.log('adding...');

  var borrowerSelectValue = borrowerSelect.value;
  var bookSelectValue = bookSelect.value;
  var issueDateInputValue = issueDateInput.value;
  var dueDateInputValue = dueDateInput.value;
  var approvedBySelectValue = approvedBySelect.value;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "emptyFields") {
        showStatusModal('one ore more fields are empty!', 'alert alert-danger');
      } else if (this.responseText == "alreadyExist") {
        showStatusModal('Already Exist', 'alert alert-warning');
      } else if (this.responseText == "queryError") {
        showStatusModal('Query Error!', 'alert alert-danger');
      } else {
        // update list
        list.innerHTML = this.responseText;
        showStatusModal('Successfully Approved!', 'alert alert-success');
      }
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("POST", "handler.php", true); // open(method, url, async)
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("action=add" +
    "&borrowerSelectValue=" + borrowerSelectValue +
    "&bookSelectValue=" + bookSelectValue +
    "&issueDateInputValue=" + issueDateInputValue +
    "&dueDateInputValue=" + dueDateInputValue +
    "&approvedBySelectValue=" + approvedBySelectValue +
    "&orderBy=" + orderBy +
    "&ascOrDesc=" + ascOrDesc);
}

// list buttons → edit, delete, set, update, cancel, confirm 
var clone, rowEl, 
  borrowEl, borrowElValue, 
  bookEl, bookElValue,
  categoryEl, categoryElValue,
  issueDateEl, issueDateElValue,
  dueDateEl, dueDateElValue,
  approveEl, approveElValue,
  returnDateEl,
  confirmEl;
function listBtnFunction(e) {
  
  rowEl = e.target.closest('tr');
  var id = rowEl.dataset.id;
  var action = e.target.dataset.action;

  if(action == "confirm") {
    console.log('confirming...', id);

    returnDateEl = rowEl.querySelector('[data-column="return_date"]');
    confirmEl = rowEl.querySelector('[data-column="confirm"]');

    var returnDateInputValue = returnDateEl.querySelector('input').value;
    var confirmSelectValue = confirmEl.querySelector('select').value;

    // update changes to database if there is a change
    if (returnDateInputValue == "") {
      showStatusModal('one ore more fields are empty!', 'alert alert-danger');
    } else {
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText == "queryError") {
            showStatusModal('Query Error!', 'alert alert-danger');
          } else {
            list.innerHTML = this.responseText;
            showStatusModal('Successfully Confirmed!', 'alert alert-success');
          }
        }
      };
      xhttp.open("POST", "handler.php", true); // open(method, url, async)
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("action=confirm" +
        "&orderBy=" + orderBy +
        "&ascOrDesc=" + ascOrDesc +
        "&returnDateInputValue=" + returnDateInputValue +
        "&confirmSelectValue=" + confirmSelectValue +
        "&id=" + id);
    }
  } else if (action == "delete") {
    console.log('deleting...', id);

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "queryError") {
          showStatusModal('Query Error!', 'alert alert-danger');
        } else {
          // update list
          list.innerHTML = this.responseText;
          showStatusModal('Successfully Deleted!', 'alert alert-success');
        }
      } else {
        // console.log(this.readyState, this.status);
      }
    };

    var deleteConfirmation = confirm("Want to delete?");
    if (deleteConfirmation) {
      //Logic to delete the item
      xhttp.open("POST", "handler.php", true); // open(method, url, async)
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("action=delete" +
        "&id=" + id +
        "&orderBy=" + orderBy +
        "&ascOrDesc=" + ascOrDesc);
    } else {
      console.log('Deletion is stopped!');
    }
  } else if (action == "edit") {
    // remove editing class from already editing row if any
    var oldRowEl = document.querySelector('#list tr.editing');
    if (oldRowEl) {
      borrowEl.innerHTML = borrowElHTML;
      bookEl.innerHTML = bookElHTML;
      categoryEl.innerHTML = categoryElHTML;
      approveEl.innerHTML = approveElHTML;
      issueDateEl.innerHTML = issueDateElHTML;
      dueDateEl.innerHTML = dueDateElHTML;
      console.log('canceling...', oldRowEl.dataset.id);
      oldRowEl.classList.remove('editing');
    }
    
    console.log('editing...', id);

    borrowEl = rowEl.querySelector('[data-column="borrow"]');
    bookEl = rowEl.querySelector('[data-column="book"]');
    categoryEl = rowEl.querySelector('[data-column="category"]');
    approveEl = rowEl.querySelector('[data-column="approve"]');
    issueDateEl = rowEl.querySelector('[data-column="issue_date"]');
    dueDateEl = rowEl.querySelector('[data-column="due_date"]');

    borrowElValue = borrowEl.dataset.value;
    bookElValue = bookEl.dataset.value;
    categoryElValue = categoryEl.dataset.value;
    approveElValue = approveEl.dataset.value;
    issueDateElValue = issueDateEl.dataset.value;
    dueDateElValue = dueDateEl.dataset.value;

    borrowElHTML = borrowEl.innerHTML;
    bookElHTML = bookEl.innerHTML;
    categoryElHTML = categoryEl.innerHTML;
    issueDateElHTML = issueDateEl.innerHTML;
    dueDateElHTML = dueDateEl.innerHTML;
    approveElHTML = approveEl.innerHTML;
  
    rowEl.classList.add('editing');

    issueDateEl.innerHTML = '<input type="date" class="form-control"  value="' + issueDateElValue + '">';
    dueDateEl.innerHTML = '<input type="date" class="form-control"  value="' + dueDateElValue + '">';
    borrowEl.innerHTML = '<select class="custom-select my-1" id="borrowerSelectEditing"></select>'
    bookEl.innerHTML = '<select class="custom-select my-1" id="bookSelectEditing"></select>'
    categoryEl.innerHTML = '<select class="custom-select my-1" id="bookCategorySelectEditing"></select>'
    approveEl.innerHTML = '<select class="custom-select my-1" id="approvedBySelectEditing"></select>'
    
    
    fetchBorrowersList('borrowerSelectEditing', borrowElValue);
    fetchBooksList(categoryElValue, 'bookSelectEditing', bookElValue);
    fetchBookCategoriesList('bookCategorySelectEditing', categoryElValue);
    fetchAdminsList('approvedBySelectEditing', approveElValue);
    
    borrowEl.querySelector('select').focus();

    var borrowSelectEl = borrowEl.querySelector('select');
    var bookSelectEl = bookEl.querySelector('select');
    var categorySelectEl = categoryEl.querySelector('select');
    var approveSelectEl = approveEl.querySelector('select');
    var issueDateInputEl = issueDateEl.querySelector('input');
    var dueDateInputEl = dueDateEl.querySelector('input');

    categorySelectEl.addEventListener('change', (e) => {
      fetchBooksList(e, 'bookSelectEditing', undef);
    }, false);

    
    // attach keyboard events on `enter` button for `submit`
    // and `esc` btn for `cancel`
    var cancelBtn = rowEl.querySelector('[data-action="cancel"');
    var submitBtn = rowEl.querySelector('[data-action="submit"');
    borrowSelectEl.addEventListener('keyup', function (e) { keyUpFunc(e, cancelBtn, submitBtn); })
    bookSelectEl.addEventListener('keyup', function (e) { keyUpFunc(e, cancelBtn, submitBtn); })
    categorySelectEl.addEventListener('keyup', function (e) { keyUpFunc(e, cancelBtn, submitBtn); })
    approveSelectEl.addEventListener('keyup', function (e) { keyUpFunc(e, cancelBtn, submitBtn); })
    issueDateInputEl.addEventListener('keyup', function (e) { keyUpFunc(e, cancelBtn, submitBtn); })
    dueDateInputEl.addEventListener('keyup', function (e) { keyUpFunc(e, cancelBtn, submitBtn); })

  } else if (action == "cancel") {
    console.log('canceling...', id);

    borrowEl.innerHTML = borrowElHTML;
    bookEl.innerHTML = bookElHTML;
    categoryEl.innerHTML = categoryElHTML;
    issueDateEl.innerHTML = issueDateElHTML;
    dueDateEl.innerHTML = dueDateElHTML;
    approveEl.innerHTML = approveElHTML;

    rowEl.classList.remove('editing');
    // updateList();
  } else if (action == "submit") {
    console.log('submiting...', id);

    var borrowSelectValue = borrowEl.querySelector('select').value;
    var bookSelectValue = bookEl.querySelector('select').value;
    var approveSelectValue = approveEl.querySelector('select').value;
    var issueDateInputValue = issueDateEl.querySelector('input').value;
    var dueDateInputValue = dueDateEl.querySelector('input').value;

    // update changes to database if there is a change
    if (bookSelectValue == "" || issueDateInputValue == "" || dueDateInputValue == "") {
      showStatusModal('one ore more fields are empty!', 'alert alert-danger');
    } else if (borrowSelectValue == borrowElValue && bookSelectValue == bookElValue && approveSelectValue == approveElValue && issueDateInputValue == issueDateElValue && dueDateInputValue == dueDateElValue) {
      borrowEl.innerHTML = borrowElHTML;
      bookEl.innerHTML = bookElHTML;
      categoryEl.innerHTML = categoryElHTML;
      approveEl.innerHTML = approveElHTML;
      issueDateEl.innerHTML = issueDateElHTML;
      dueDateEl.innerHTML = dueDateElHTML;
      rowEl.classList.remove('editing');
      showStatusModal('Nothing changed!', 'alert alert-warning');
    } else {
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText == "queryError") {
            showStatusModal('Query Error!', 'alert alert-danger');
          } else {
            list.innerHTML = this.responseText;
            showStatusModal('Successfully Updated!', 'alert alert-success');
          }
        }
      };
      xhttp.open("POST", "handler.php", true); // open(method, url, async)
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("action=submit" +
        "&orderBy=" + orderBy +
        "&ascOrDesc=" + ascOrDesc +
        "&borrowElValue=" + borrowSelectValue +
        "&bookElValue=" + bookSelectValue +
        "&approveElValue=" + approveSelectValue +
        "&issueDateElValue=" + issueDateInputValue +
        "&dueDateElValue=" + dueDateInputValue +
        "&id=" + id);
    }
  }
}
