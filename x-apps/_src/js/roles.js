/*****************************************/
//            variables
/*****************************************/

var list = document.getElementById('list');
var addBtn = document.getElementById('addBtn');

var orderListBy = document.querySelectorAll('[data-order-by]');

var statusModalBtn = document.getElementById('statusModalBtn');
var statusModalAlert = document.getElementById('statusModalAlert');

var codeInput = document.getElementById('codeInput');
var roleInput = document.getElementById('roleInput');

var orderBy = 'role_name';
var ascOrDesc = 'ASC';


/*****************************************/
//            events
/*****************************************/

addBtn.addEventListener('click', add, false);

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

  updateList();
};
init();


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
  xhttp.open("GET", "roles-handler.php?action=updateList" +
    "&orderBy=" + orderBy +
    "&ascOrDesc=" + ascOrDesc, true);
  xhttp.send();
}

// add on `Add` button click
function add() {
  console.log('adding...');

  var codeInputValue = codeInput.value;
  var roleInputValue = roleInput.value;

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
        // clearning fileds after successful addtion
        codeInput.value = roleInput.value = '';
        showStatusModal('Successfully Added!', 'alert alert-success');
      }
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("POST", "roles-handler.php", true); // open(method, url, async)
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("action=add" +
    "&codeInputValue=" + codeInputValue +
    "&roleInputValue=" + roleInputValue +
    "&orderBy=" + orderBy +
    "&ascOrDesc=" + ascOrDesc);
}

// list buttons → edit, delete, set, update, cancel 
var rowEl, roleEl, roleElValue, codeEl, codeElValue;

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
        } else if (this.responseText == "cantDelete") {
          showStatusModal('Can\'t Delete default Category!', 'alert alert-danger');
        } else if (this.responseText == "isUsedAtOtherPlace") {
          showStatusModal('Can\'t Delete, Role is in Used!', 'alert alert-danger');
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
      xhttp.open("POST", "roles-handler.php", true); // open(method, url, async)
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
      codeEl.innerHTML = codeElValue;
      oldRowEl.classList.remove('editing');
    }

    roleEl = rowEl.querySelector('[data-column="role"]');
    codeEl = rowEl.querySelector('[data-column="code"]');
    roleElValue = roleEl.innerHTML;
    codeElValue = codeEl.innerHTML;

    rowEl.classList.add('editing');

    roleEl.innerHTML = '<input type="text" class="form-control"  value="' + roleElValue + '">';
    codeEl.innerHTML = '<input type="text" class="form-control"  value="' + codeElValue + '">';
    roleEl.querySelector('input').focus();

    var roleInputEl = roleEl.querySelector('input');
    var codeInputEl = codeEl.querySelector('input');

    // attach keyboard events on `enter` button for `submit`
    // and `esc` btn for `cancel`
    var cancelBtn = rowEl.querySelector('[data-action="cancel"');
    var submitBtn = rowEl.querySelector('[data-action="submit"');
    roleInputEl.addEventListener('keyup', function (e) {
      keyUpFunc(e, cancelBtn, submitBtn);
    })
    codeInputEl.addEventListener('keyup', function (e) {
      keyUpFunc(e, cancelBtn, submitBtn);
    })

  } else if (action == "cancel") {
    console.log('canceling...', id);

    roleEl.innerHTML = roleElValue;
    codeEl.innerHTML = codeElValue;

    rowEl.classList.remove('editing');
    // updateList();
  } else if (action == "submit") {
    console.log('submiting...', id);

    var roleInputValue = roleEl.querySelector('input').value;
    var codeInputValue = codeEl.querySelector('input').value;

    // update changes to database if there is a change
    if (roleInputValue == "" || codeInputValue == "") {
      showStatusModal('one ore more fields are empty!', 'alert alert-danger');
    } else if (roleInputValue == roleElValue && codeInputValue == codeElValue) {
      roleEl.innerHTML = roleInputValue;
      codeEl.innerHTML = codeInputValue;
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
      xhttp.open("POST", "roles-handler.php", true); // open(method, url, async)
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("action=submit" +
        "&orderBy=" + orderBy +
        "&ascOrDesc=" + ascOrDesc +
        "&roleInputValue=" + roleInputValue +
        "&codeInputValue=" + codeInputValue +
        "&id=" + id);
    }
  }
}
