/*****************************************/
//            variables
/*****************************************/

var list = document.getElementById('list');
var addBtn = document.getElementById('addBtn');
var toggleTodaysQuoteBtn = document.getElementById('toggleTodaysQuoteBtn');
var todaysQuoteSection = document.getElementById('todaysQuoteSection');

var querySuccessBtn = document.getElementById('querySuccessBtn');
var alreadyExistModalBtn = document.getElementById('alreadyExistModalBtn');
var queryErrorBtn = document.getElementById('queryErrorBtn');

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
          alreadyExistModalBtn.click();
        } else if (this.responseText == "queryError") {
          queryErrorBtn.click();
        } else {
          // update quotes list
          list.innerHTML = this.responseText;
          // clearning fileds after successful addtion of batch
          quoteInput.value = authorInput.value = '';
          querySuccessBtn.click();
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
  }

  // xhttp = new XMLHttpRequest();
  // xhttp.onreadystatechange = function () {
  //   if (this.readyState == 4 && this.status == 200) {
  //     if (this.responseText == "alreadyExist") {
  //       alreadyExistModalBtn.click();
  //     } else if (this.responseText == "queryError") {
  //       queryErrorBtn.click();
  //     } else {
  //       // update quotes list
  //       quotesList.innerHTML = this.responseText;
  //       // clearning fileds after successful addtion of batch
  //       quoteInput.value = authorInput.value = '';
  //       querySuccessBtn.click();
  //     }
  //   } else {
  //     // console.log(this.readyState, this.status);
  //   }
  // };
  // xhttp.open("POST", "x-quote-handler.php", true); // open(method, url, async)
  // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  // xhttp.send("action=add" +
  //   "&quoteInputValue=" + quoteInputValue +
  //   "&authorInputValue=" + authorInputValue +
  //   "&orderBy=" + orderBy +
  //   "&ascOrDesc=" + ascOrDesc);
}

