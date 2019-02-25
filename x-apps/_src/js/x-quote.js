/*****************************************/
//            variables
/*****************************************/

var todaysQuoteSection = document.getElementById('todaysQuoteSection');
// var timestamp = null;


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
  xhttp.open("GET", "x-quote-handler.php?action=getTodaysQuote", true);
  xhttp.send();

  // $.ajax({
  //   type: "GET",
  //   url: "x-quote-handler.php?action=getTodaysQuote&timestamp=" + timestamp,
  //   async: true,
  //   cache: false,
  //   success: function (data) {
  //     var json = eval('(' + data + ')');
  //     todaysQuoteSection.querySelector('.content').innerHTML = json['msg'];
  //     timestamp = json["timestamp"];
  //     setTimeout("getTodaysQuote()", 1000);
  //   },
  //   error: function (XMLHttpRequest, textStatus, errorThrown) {
  //     alert("error: "+textStatus + " "+ errorThrown );
  //     setTimeout("getTodaysQuote()", 15000);
  //   }
  // });

}

// // var url = 'wss://echo.websocket.org';
// var url = 'ws://weball.io:3306/websocket';

// // Create WebSocket connection.
// const ws = new WebSocket(url);

// // Connection opened
// ws.addEventListener('open', function (event) {
//   ws.send('Hello Server!');
// });

// // Listen for messages
// ws.addEventListener('message', function (event) {
//   console.log('Message from server ', event.data);
// });