/*****************************************/
//            variables
/*****************************************/

var todaysQuoteSection = document.getElementById('todaysQuoteSection');


/*****************************************/
//            events
/*****************************************/


/*****************************************/
//            functions
/*****************************************/

// run on page laod
function init() {
  getTodaysQuote();
};
init();

// get today's quote
function getTodaysQuote() {
  console.log('getting todays quote...');

  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "queryError") {
        showStatusModal('Can\'t fetch today\'s quote!', 'alert alert-danger');
      } else {
        todaysQuoteSection.querySelector('.content').innerHTML = this.responseText;
      }
    } else {
      // console.log(this.readyState, this.status);
    }
  };
  xhttp.open("GET", "handler.php?action=getTodaysQuote", true);
  xhttp.send();
}

setInterval(() => { getTodaysQuote(); }, 15000)