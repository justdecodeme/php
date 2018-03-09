console.log('js is working');
var selectBatch = document.getElementById('selectBatch');
var timetableResult = document.getElementById('timetableResult');
var xhttp = new XMLHttpRequest();

function updateTimeTable(e) {
  console.log(e.target.value);
  var batchCode = e.target.value;
  xhttp.onreadystatechange = function() {
    // When readyState is 4 and status is 200, the response is ready.
    if (this.readyState == 4 && this.status == 200) {
     timetableResult.innerHTML = this.responseText;
    }
  };
  // To send a request to a server, we use the open() and send() methods
  xhttp.open("GET", "demo.php?batchId="+batchCode, true);  // open(method, url, async)
  xhttp.send();
}

selectBatch.addEventListener('change', updateTimeTable, false);
