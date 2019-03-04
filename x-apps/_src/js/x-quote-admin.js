/*****************************************/
//            variables
/*****************************************/

var list = document.getElementById('list');
var addBtn = document.getElementById('addBtn');

var orderListBy = document.querySelectorAll('[data-order-by]');

var statusModalBtn = document.getElementById('statusModalBtn');
var statusModalAlert = document.getElementById('statusModalAlert');

var quoteInput = document.getElementById('quoteInput');
var authorInput = document.getElementById('authorInput');

var orderBy = 'quote';
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
  xhttp.open("GET", "handler.php?action=updateList"+
    "&orderBy=" + orderBy +
    "&ascOrDesc=" + ascOrDesc, true);
  xhttp.send();
}

// add on `Add` button click
function add() {
    console.log('adding...');

    var quoteInputValue = quoteInput.value;
    var authorInputValue = authorInput.value;

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
          quoteInput.value = authorInput.value = '';
          showStatusModal('Successfully Added!', 'alert alert-success');
        }
      } else {
        // console.log(this.readyState, this.status);
      }
    };
    xhttp.open("POST", "handler.php", true); // open(method, url, async)
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=add"+
      "&quoteInputValue=" + quoteInputValue +
      "&authorInputValue=" + authorInputValue +
      "&orderBy=" + orderBy +
      "&ascOrDesc=" + ascOrDesc);
}

// list buttons → edit, delete, set, update, cancel 
var rowEl, quoteEl, authorEl, quoteElValue, authorElValue;
function listBtnFunction(e) {
  
  rowEl = e.target.closest('tr');
  var id = rowEl.dataset.id;
  var action = e.target.dataset.action;
  
  if (action == "set") {
    console.log('setting today\'s quote...', id);

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "queryError") {
          showStatusModal('Query Error!', 'alert alert-danger');
        } else {
          getTodaysQuote();
          var oldRowEl = document.querySelector('#list tr.table-active');
          if(oldRowEl) {
            oldRowEl.classList.remove('table-active');
          }
          rowEl.classList.add('table-active');
          showStatusModal('Today\'s quote udpated!', 'alert alert-success');
        }
      } else {
        // console.log(this.readyState, this.status);
      }
    };

    xhttp.open("POST", "handler.php", true); // open(method, url, async)
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=setTodaysQuote&id=" + id);
  } else if(action == "delete") {
    console.log('deleting...', id);

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "queryError") {
          showStatusModal('Query Error!', 'alert alert-danger');
        } else if(this.responseText == "cantDelete") {
          showStatusModal('Can\'t Delete Current Quote!', 'alert alert-danger');
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
  } else if(action == "edit") {
    console.log('editing...', id);

    // remove editing class from already editing row if any
    var oldRowEl = document.querySelector('#list tr.editing');
    if (oldRowEl) {
      quoteEl.innerHTML = quoteElValue;
      authorEl.innerHTML = authorElValue;
      oldRowEl.classList.remove('editing');
    }

    quoteEl = rowEl.querySelector('[data-column="quote"]');
    authorEl = rowEl.querySelector('[data-column="author"]');
    quoteElValue = quoteEl.innerHTML;
    authorElValue = authorEl.innerHTML;
    
    rowEl.classList.add('editing');
    
    quoteEl.innerHTML = '<input type="text" class="form-control"  value="' + quoteElValue + '">';
    authorEl.innerHTML = '<input type="text" class="form-control" value="' + authorElValue + '">';
    quoteEl.querySelector('input').focus();

    var quoteInputEl = quoteEl.querySelector('input');
    var authorInputEl = authorEl.querySelector('input');

    // attach keyboard events on `enter` button for `submit`
    // and `esc` btn for `cancel`
    var cancelBtn = rowEl.querySelector('[data-action="cancel"');
    var submitBtn = rowEl.querySelector('[data-action="submit"');
    quoteInputEl.addEventListener('keyup', function (e) {
      keyUpFunc(e, cancelBtn, submitBtn);
    })
    authorInputEl.addEventListener('keyup', function (e) {
      keyUpFunc(e, cancelBtn, submitBtn);
    })
    
  } else if(action == "cancel") {
    console.log('canceling...', id);

    quoteEl.innerHTML = quoteElValue;
    authorEl.innerHTML = authorElValue;
    
    rowEl.classList.remove('editing');
    // updateList();
  } else if(action == "submit") {
    console.log('submiting...', id);

    var quoteInputValue = quoteEl.querySelector('input').value;
    var authorInputValue = authorEl.querySelector('input').value;

    // update changes to database if there is a change
    if (quoteInputValue == "" || authorInputValue == "") {
      showStatusModal('one ore more fields are empty!', 'alert alert-danger');
    } else if (quoteInputValue == quoteElValue && authorInputValue == authorElValue) {
      quoteEl.innerHTML = quoteInputValue;
      authorEl.innerHTML = authorInputValue;
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
            getTodaysQuote();
            showStatusModal('Successfully Updated!', 'alert alert-success');
          }
        }
      };
      xhttp.open("POST", "handler.php", true); // open(method, url, async)
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("action=submit" +
        "&orderBy=" + orderBy +
        "&ascOrDesc=" + ascOrDesc +
        "&quoteInputValue=" + quoteInputValue +
        "&authorInputValue=" + authorInputValue +
        "&id=" + id);
    }
  }
}