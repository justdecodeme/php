/*****************************************/
//            variables
/*****************************************/

var list = document.getElementById('list');

var orderListBy = document.querySelectorAll('[data-order-by]');

var statusModalBtn = document.getElementById('statusModalBtn');
var statusModalAlert = document.getElementById('statusModalAlert');

var roleSelect = document.getElementById('roleSelect');
var genderSelect = document.getElementById('genderSelect');
var searchSelect = document.getElementById('searchSelect');

var orderBy = 'user_name';
var ascOrDesc = 'ASC';


/*****************************************/
//            events
/*****************************************/

roleSelect.addEventListener('change', updateList, false);
genderSelect.addEventListener('change', updateList, false);
searchSelect.addEventListener('keyup', updateList, false);

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
  
  fetchRolesForUsers();
  updateList();
};
init();

// fetch the categories list
function fetchRolesForUsers() {
  console.log('fetching roles for users list...');

  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      roleSelect.innerHTML = this.responseText;
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("GET", "handler.php?action=fetchRolesForUsers", true); // open(method, url, async)
  xhttp.send();
}


// update list
function updateList() {
  console.log('list updating...');

  // check what value is selected in dropdown
  roleValue = roleSelect.value;
  genderValue = genderSelect.value;
  searchValue = searchSelect.value;

  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      list.innerHTML = this.responseText;
      totalInput.value = list.getElementsByTagName('tr').length;
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("GET", "handler.php?action=updateList" +
    "&roleValue=" + roleValue +
    "&genderValue=" + genderValue +
    "&searchValue=" + searchValue +
    "&orderBy=" + orderBy +
    "&ascOrDesc=" + ascOrDesc, true);
  xhttp.send();
}

// list buttons → edit, delete, set, update, cancel 
var rowEl, roleEl, roleElValue, roleCode;

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
    roleCode = roleEl.dataset.code;

    roleElValue = roleEl.innerHTML;

    rowEl.classList.add('editing');

    // copy and insert category list
    roleEl.innerHTML = '';
    var clone = roleSelect.cloneNode(true);
    roleEl.appendChild(clone);
    roleEl.querySelector('select option:first-child').remove();
    // update category as as original
    roleEl.querySelector('select').value = roleCode;

    roleEl.querySelector('select').focus();

    var roleInputEl = roleEl.querySelector('select');

    // attach keyboard events on `enter` button for `submit`
    // and `esc` btn for `cancel`
    var cancelBtn = rowEl.querySelector('[data-action="cancel"');
    var submitBtn = rowEl.querySelector('[data-action="submit"');
    roleInputEl.addEventListener('keyup', function (e) {
      e.preventDefault();
      keyUpFunc(e, cancelBtn, submitBtn);
    })
  } else if (action == "cancel") {
    console.log('canceling...', id);

    roleEl.innerHTML = roleElValue; 

    rowEl.classList.remove('editing');
    // updateList();
  } else if (action == "submit") {
    console.log('submiting...', id);

    var roleInputValue = roleEl.querySelector('select').value;

    // update changes to database if there is a change
    if (roleInputValue == "") {
      showStatusModal('one ore more fields are empty!', 'alert alert-danger');
    } else if (roleInputValue == roleElValue) {
      roleEl.innerHTML = roleElValue;
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
        "&roleInputValue=" + roleInputValue +
        "&id=" + id);
    }
  }
}
