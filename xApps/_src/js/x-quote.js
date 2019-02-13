/*****************************************/
//            variables
/*****************************************/

var quotesList = document.getElementById('quotesList');
var addQuoteBtn = document.getElementById('addQuoteBtn');

var orderBy = 'quote';
var ascOrDesc = 'ASC';


/*****************************************/
//            functions
/*****************************************/

// run on page laod
function init() {
  updateQuotesList();
};
init();

// update quotes list
function updateQuotesList() {
  console.log('quotes list updating...');

  // editingUserFlag = false;

  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      quotesList.innerHTML = this.responseText;
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("GET", "x-quote-admin-handler.php?action=updateQuotesList"+
    "&orderBy=" + orderBy +
    "&ascOrDesc=" + ascOrDesc, true);
  xhttp.send();
}

// add quote on `Add Quote` button click
function addQuote() {
    console.log('adding quote...');

    var quoteInputValue = quoteInput.value;
    var authorInputValue = authorInput.value;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // update quotes list
        quotesList.innerHTML = this.responseText;
        // clearning fileds after successful addtion of batch
        quoteInput.value = authorInput.value = '';
      } else {
        // console.log(this.readyState, this.status);
      }
    };
    xhttp.open("POST", "x-quote-admin-handler.php", true); // open(method, url, async)
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=addQuote"+
      "&quoteInputValue=" + quoteInputValue +
      "&authorInputValue=" + authorInputValue +
      "&orderBy=" + orderBy +
      "&ascOrDesc=" + ascOrDesc);
}


/*****************************************/
//            events
/*****************************************/
addQuoteBtn.addEventListener('click', addQuote, false);