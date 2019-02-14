/*****************************************/
//            variables
/*****************************************/

var list = document.getElementById('list');
var addBtn = document.getElementById('addBtn');
var toggleTodaysQuoteBtn = document.getElementById('toggleTodaysQuoteBtn');
var todaysQuoteSection = document.getElementById('todaysQuoteSection');

var statusModalBtn = document.getElementById('statusModalBtn');
var statusModalAlert = document.getElementById('statusModalAlert');

var orderBy = 'id';
var ascOrDesc = 'DESC';


/*****************************************/
//            events
/*****************************************/

addBtn.addEventListener('click', add, false);

toggleTodaysQuoteBtn.addEventListener('click', () => {
  todaysQuoteSection.classList.toggle('d-none');
}, false);

list.addEventListener('click', remove, false); // can't use 'delete' as a func name 


/*****************************************/
//            functions
/*****************************************/

// run on page laod
function init() {
  updateList();
};
init();

// one modal for different status (add, delete, error, update, edit)
function showStatusModal(text, type) {
  statusModalAlert.innerHTML = text;
  statusModalAlert.setAttribute('class', type);
  statusModalBtn.click();
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
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("GET", "x-quote-handler.php?action=updateList"+
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
        if (this.responseText == "alreadyExist") {
          showStatusModal('Already Exist', 'alert alert-warning');
        } else if (this.responseText == "queryError") {
          showStatusModal('Query Error!', 'alert alert-error');
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
    xhttp.open("POST", "x-quote-handler.php", true); // open(method, url, async)
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=add"+
      "&quoteInputValue=" + quoteInputValue +
      "&authorInputValue=" + authorInputValue +
      "&orderBy=" + orderBy +
      "&ascOrDesc=" + ascOrDesc);
}

// delete on `Delete` button click
function remove(e) {
  
  var action = e.target.dataset.action;
  var id = e.target.closest('tr').dataset.id;
  
  if (action == "delete") {
    console.log('deleting...', id);

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "queryError") {
          queryErrorBtn.click();
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
      xhttp.open("POST", "x-quote-handler.php", true); // open(method, url, async)
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("action=delete" +
        "&id=" + id +
        "&orderBy=" + orderBy +
        "&ascOrDesc=" + ascOrDesc);
    } else {
      console.log('Deletion is stopped!');
    }
  }

}

