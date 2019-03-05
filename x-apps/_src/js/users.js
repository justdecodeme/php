/*****************************************/
//            variables
/*****************************************/

var list = document.getElementById('list');

var orderListBy = document.querySelectorAll('[data-order-by]');

var statusModalBtn = document.getElementById('statusModalBtn');
var statusModalAlert = document.getElementById('statusModalAlert');

// var titleInput = document.getElementById('titleInput');
// var authorInput = document.getElementById('authorInput');
// var stockInput = document.getElementById('stockInput');
// var categoryInput = document.getElementById('categoryInput');

var orderBy = 'user_name';
var ascOrDesc = 'ASC';


/*****************************************/
//            events
/*****************************************/

list.addEventListener('click', listBtnFunction, false);

for (var i = 0; i < orderListBy.length; i++) {
  orderListBy[i].addEventListener('click', orderList, false);
}

/*****************************************/
//            functions
/*****************************************/

// run on page laod
function init() {
  // fetchCategoriesForBooks();
  updateList();
};
init();

// fetch the categories list
function fetchCategoriesForBooks() {
  console.log('fetching categories for books list...');

  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      categoryInput.innerHTML = this.responseText;
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("GET", "books-handler.php?action=fetchCategoriesForBooks", true); // open(method, url, async)
  xhttp.send();
}


// update list
function updateList() {
  console.log('list updating...');

  // editingUserFlag = false;

  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      list.innerHTML = this.responseText;
      $('[data-toggle="tooltip"]').tooltip();
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("GET", "handler.php?action=updateList" +
    "&orderBy=" + orderBy +
    "&ascOrDesc=" + ascOrDesc, true);
  xhttp.send();
}

// list buttons → edit, delete, set, update, cancel 
var rowEl, roleEl, roleElValue;

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
    console.log('editing...', id);

    // remove editing class from already editing row if any
    var oldRowEl = document.querySelector('#list tr.editing');
    if (oldRowEl) {
      roleEl.innerHTML = roleElValue;
      oldRowEl.classList.remove('editing');
    }

    roleEl = rowEl.querySelector('[data-column="role"]');

    roleElValue = roleEl.innerHTML;

    rowEl.classList.add('editing');

    roleEl.innerHTML = `
      <select class="custom-select my-1">
        <option value="admin">Admin</option>
        <option value="instructor">Instructor</option>
        <option value="student">Student</option>
        <option value="subscriber" selected>Subscriber</option>
      </select>`;

    roleEl.querySelector('select').focus();

    var roleInputEl = roleEl.querySelector('select');
  } else if (action == "cancel") {
    console.log('canceling...', id);

    roleEl.innerHTML = roleElValue; 

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
