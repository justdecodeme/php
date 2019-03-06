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

var orderBy = 'lid';
var ascOrDesc = 'ASC';
const numberOfDaysToAdd = 7;

/*****************************************/
//            events
/*****************************************/

addBtn.addEventListener('click', add, false);
bookCategorySelect.addEventListener('change', fetchBooksList, false);

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
  fetchBorrowersList();
  fetchAdminsList();
  fetchBookCategoriesList();
  fetchBooksList();
  fetchDates();

  updateList();
};
init();

function fetchBorrowersList() {
  console.log('fetching borrowers list...');

  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      borrowerSelect.innerHTML = this.responseText;
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("GET", "handler.php?action=fetchBorrowersList", true); // open(method, url, async)
  xhttp.send();
}
function fetchAdminsList() {
  console.log('fetching admins list...');

  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      approvedBySelect.innerHTML = this.responseText;
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("GET", "handler.php?action=fetchAdminsList", true); // open(method, url, async)
  xhttp.send();
}
function fetchBookCategoriesList() {
  console.log('fetching book categories list...');

  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      bookCategorySelect.innerHTML = this.responseText;
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("GET", "handler.php?action=fetchBookCategoriesList", true); // open(method, url, async)
  xhttp.send();
}
function fetchBooksList(e) {
  var book_category_id = '';
  if(e) {
    book_category_id = e.target.value;
  }
  console.log('fetching books list...');

  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if(this.responseText == "NA") {
        bookSelect.innerHTML = "<option value=''>None</option>";
        bookSelect.setAttribute('disabled', 'true');
      } else {
        bookSelect.innerHTML = this.responseText;
        bookSelect.removeAttribute('disabled');
      }
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("GET", "handler.php?action=fetchBooksList&book_category_id=" + book_category_id, true); // open(method, url, async)
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
        showStatusModal('Successfully Added!', 'alert alert-success');
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

// list buttons → edit, delete, set, update, cancel 
var rowEl, titleEl, titleElValue, authorEl, authorElValue, stockEl, stockElValue, categoryEl, categoryElValue, categoryId;

function listBtnFunction(e) {

  rowEl = e.target.closest('tr');
  var id = rowEl.dataset.id;
  var action = e.target.dataset.action;

  if (action == "delete") {
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
      xhttp.open("POST", "books-handler.php", true); // open(method, url, async)
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("action=delete" +
        "&id=" + id +
        "&orderBy=" + orderBy +
        "&ascOrDesc=" + ascOrDesc);
    } else {
      console.log('Deletion is stopped!');
    }
  } else if (action == "edit") {
    console.log('editing...', id);

    // remove editing class from already editing row if any
    var oldRowEl = document.querySelector('#list tr.editing');
    if (oldRowEl) {
      titleEl.innerHTML = titleElValue;
      authorEl.innerHTML = authorElValue;
      stockEl.innerHTML = stockElValue;
      categoryEl.innerHTML = categoryElValue;
      oldRowEl.classList.remove('editing');
    }

    titleEl = rowEl.querySelector('[data-column="title"]');
    authorEl = rowEl.querySelector('[data-column="author"]');
    stockEl = rowEl.querySelector('[data-column="stock"]');
    categoryEl = rowEl.querySelector('[data-column="category"]');
    categoryId = categoryEl.dataset.id;

    titleElValue = titleEl.innerHTML;
    authorElValue = authorEl.innerHTML;
    stockElValue = stockEl.innerHTML;
    categoryElValue = categoryEl.innerHTML;

    rowEl.classList.add('editing');

    titleEl.innerHTML = '<input type="text" class="form-control"  value="' + titleElValue + '">';
    authorEl.innerHTML = '<input type="text" class="form-control"  value="' + authorElValue + '">';
    stockEl.innerHTML = '<input type="number" class="form-control"  value="' + stockElValue + '">';
    // categoryEl.innerHTML = '<input type="text" class="form-control"  value="' + categoryElValue + '">';
    titleEl.querySelector('input').focus();

    // copy and insert category list
    categoryEl.innerHTML = '';
    var clone = categoryInput.cloneNode(true);
    categoryEl.appendChild(clone);
    // update category as as original
    categoryEl.querySelector('select').value = categoryId;


    var titleInputEl = titleEl.querySelector('input');
    var authorInputEl = authorEl.querySelector('input');
    var stockInputEl = stockEl.querySelector('input');

    // attach keyboard events on `enter` button for `submit`
    // and `esc` btn for `cancel`
    var cancelBtn = rowEl.querySelector('[data-action="cancel"');
    var submitBtn = rowEl.querySelector('[data-action="submit"');
    titleInputEl.addEventListener('keyup', function (e) {
      keyUpFunc(e, cancelBtn, submitBtn);
    })
    authorInputEl.addEventListener('keyup', function (e) {
      keyUpFunc(e, cancelBtn, submitBtn);
    })
    stockInputEl.addEventListener('keyup', function (e) {
      keyUpFunc(e, cancelBtn, submitBtn);
    })

  } else if (action == "cancel") {
    console.log('canceling...', id);

    titleEl.innerHTML = titleElValue;
    authorEl.innerHTML = authorElValue;
    stockEl.innerHTML = stockElValue;
    categoryEl.innerHTML = categoryElValue;

    rowEl.classList.remove('editing');
    // updateList();
  } else if (action == "submit") {
    console.log('submiting...', id);

    var titleInputValue = titleEl.querySelector('input').value;
    var authorInputValue = authorEl.querySelector('input').value;
    var stockInputValue = stockEl.querySelector('input').value;
    var categoryInputValue = categoryEl.querySelector('select').value;

    // update changes to database if there is a change
    if (titleInputValue == "" || authorInputValue == "" || stockInputValue == "") {
      showStatusModal('one ore more fields are empty!', 'alert alert-danger');
    } else if (titleInputValue == titleElValue && authorInputValue == authorElValue && stockInputValue == stockElValue && categoryInputValue == categoryId) {
      titleEl.innerHTML = titleInputValue;
      authorEl.innerHTML = authorInputValue;
      stockEl.innerHTML = stockInputValue;
      categoryEl.innerHTML = categoryElValue;
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
      xhttp.open("POST", "books-handler.php", true); // open(method, url, async)
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("action=submit" +
        "&orderBy=" + orderBy +
        "&ascOrDesc=" + ascOrDesc +
        "&titleInputValue=" + titleInputValue +
        "&authorInputValue=" + authorInputValue +
        "&stockInputValue=" + stockInputValue +
        "&categoryInputValue=" + categoryInputValue +
        "&id=" + id);
    }
  }
}
